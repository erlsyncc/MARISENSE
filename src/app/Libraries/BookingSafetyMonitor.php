<?php

namespace App\Libraries;

use App\Models\BuoyDataModel;
use App\Models\SeaSafetyEventModel;
use App\Models\SeaSafetyStateModel;

class BookingSafetyMonitor
{
    private const WAVE_DANGER_THRESHOLD = 1.2;
    private const WIND_DANGER_THRESHOLD = 20.0;

    private const UNSAFE_CONSECUTIVE_PACKETS = 5;
    private const UNSAFE_MIN_DURATION_SECONDS = 240;

    private const RECOVERY_CONSECUTIVE_PACKETS = 5;
    private const RECOVERY_MIN_DURATION_SECONDS = 240;

    private const AUTO_CANCEL_WINDOW_HOURS = 2;
    private const AUTO_CANCEL_REASON = 'Unsafe Maritime Conditions';

    private BuoyDataModel $buoyDataModel;
    private SeaSafetyStateModel $stateModel;
    private SeaSafetyEventModel $eventModel;

    public function __construct()
    {
        $this->buoyDataModel = new BuoyDataModel();
        $this->stateModel    = new SeaSafetyStateModel();
        $this->eventModel    = new SeaSafetyEventModel();
    }

    public function processLatestReading(): void
    {
        $recentReadings = $this->buoyDataModel->getRecentReadings(
            max(self::UNSAFE_CONSECUTIVE_PACKETS, self::RECOVERY_CONSECUTIVE_PACKETS)
        );
        if ($recentReadings === []) {
            return;
        }

        $latestReading = $recentReadings[0];
        $state         = $this->stateModel->getCurrentState();
        $isUnsafeNow   = ($state['status'] ?? 'safe') === 'unsafe';

        $unsafeEvaluation = $this->evaluateSustainedCondition(
            $recentReadings,
            self::UNSAFE_CONSECUTIVE_PACKETS,
            self::UNSAFE_MIN_DURATION_SECONDS,
            fn(array $row): bool => $this->extractWaveHeight($row) >= self::WAVE_DANGER_THRESHOLD
                && $this->extractWindSpeed($row) >= self::WIND_DANGER_THRESHOLD
        );

        $safeEvaluation = $this->evaluateSustainedCondition(
            $recentReadings,
            self::RECOVERY_CONSECUTIVE_PACKETS,
            self::RECOVERY_MIN_DURATION_SECONDS,
            fn(array $row): bool => $this->extractWaveHeight($row) < self::WAVE_DANGER_THRESHOLD
                && $this->extractWindSpeed($row) < self::WIND_DANGER_THRESHOLD
        );

        if ($isUnsafeNow) {
            if ($safeEvaluation['matched']) {
                $this->markSafe($latestReading, $safeEvaluation);
                return;
            }

            $this->cancelUpcomingBookingsAndNotify($latestReading);
            return;
        }

        if ($unsafeEvaluation['matched']) {
            $this->markUnsafe($latestReading, $unsafeEvaluation);
            $this->cancelUpcomingBookingsAndNotify($latestReading);
        }
    }

    public function isBookingBlocked(): bool
    {
        $state = $this->stateModel->getCurrentState();
        return (int) ($state['booking_blocked'] ?? 0) === 1 || ($state['status'] ?? 'safe') === 'unsafe';
    }

    public function getBookingBlockedMessage(): string
    {
        return 'New bookings are temporarily paused due to unsafe maritime conditions. Refunds or rescheduling options for affected bookings are being processed.';
    }

    private function markUnsafe(array $latestReading, array $evaluation): void
    {
        $now  = date('Y-m-d H:i:s');
        $wave = $this->extractWaveHeight($latestReading);
        $wind = $this->extractWindSpeed($latestReading);

        $this->stateModel->update(1, [
            'status'                   => 'unsafe',
            'booking_blocked'          => 1,
            'last_unsafe_confirmed_at' => $now,
            'last_wave_height'         => $wave,
            'last_wind_speed'          => $wind,
        ]);

        $this->logEvent(
            'unsafe_confirmed',
            'Unsafe sea conditions confirmed from sustained buoy readings.',
            $wave,
            $wind,
            $evaluation['packets'],
            $evaluation['duration_seconds'],
            0
        );
    }

    private function markSafe(array $latestReading, array $evaluation): void
    {
        $now  = date('Y-m-d H:i:s');
        $wave = $this->extractWaveHeight($latestReading);
        $wind = $this->extractWindSpeed($latestReading);

        $this->stateModel->update(1, [
            'status'                 => 'safe',
            'booking_blocked'        => 0,
            'last_safe_confirmed_at' => $now,
            'last_wave_height'       => $wave,
            'last_wind_speed'        => $wind,
        ]);

        $this->logEvent(
            'safe_recovered',
            'Sea conditions recovered consistently. Booking acceptance resumed.',
            $wave,
            $wind,
            $evaluation['packets'],
            $evaluation['duration_seconds'],
            0
        );
    }

    private function cancelUpcomingBookingsAndNotify(array $latestReading): int
    {
        $db        = \Config\Database::connect();
        $now       = date('Y-m-d H:i:s');
        $windowEnd = date('Y-m-d H:i:s', strtotime('+' . self::AUTO_CANCEL_WINDOW_HOURS . ' hours'));

        $sql = <<<SQL
            SELECT b.id, b.booking_code, b.user_id, b.date, b.time, u.username, ai.secret AS email
            FROM bookings b
            LEFT JOIN users u ON u.id = b.user_id
            LEFT JOIN auth_identities ai ON ai.user_id = b.user_id AND ai.type = 'email_password'
            WHERE b.status IN ('pending', 'confirmed')
              AND TIMESTAMP(b.date, b.time) BETWEEN ? AND ?
            ORDER BY b.date ASC, b.time ASC
        SQL;

        $bookings = $db->query($sql, [$now, $windowEnd])->getResultArray();
        if ($bookings === []) {
            return 0;
        }

        $wave           = $this->extractWaveHeight($latestReading);
        $wind           = $this->extractWindSpeed($latestReading);
        $cancelledCount = 0;
        $updatedAt      = date('Y-m-d H:i:s');

        foreach ($bookings as $booking) {
            $db->table('bookings')
                ->where('id', (int) $booking['id'])
                ->update([
                    'status'        => 'cancelled',
                    'cancel_reason' => self::AUTO_CANCEL_REASON,
                    'updated_at'    => $updatedAt,
                ]);

            $cancelledCount++;

            $scheduledAt = trim((string) ($booking['date'] ?? '') . ' ' . (string) ($booking['time'] ?? ''));
            $this->logEvent(
                'booking_auto_cancelled',
                sprintf(
                    'Booking %s was automatically cancelled due to unsafe maritime conditions.',
                    (string) ($booking['booking_code'] ?? '#' . $booking['id'])
                ),
                $wave,
                $wind,
                0,
                0,
                1,
                [
                    'booking_id'        => (int) $booking['id'],
                    'booking_code'      => (string) ($booking['booking_code'] ?? ''),
                    'user_id'           => (int) ($booking['user_id'] ?? 0),
                    'scheduled_at'      => $scheduledAt,
                    'cancellation_note' => self::AUTO_CANCEL_REASON,
                ]
            );

            $this->sendUnsafeCancellationEmail($booking, $scheduledAt, $wave, $wind);
        }

        return $cancelledCount;
    }

    private function sendUnsafeCancellationEmail(array $booking, string $scheduledAt, float $wave, float $wind): void
    {
        $to = trim((string) ($booking['email'] ?? ''));
        if ($to === '') {
            $this->logEvent(
                'booking_notification_failed',
                sprintf('No email address found for booking %s.', (string) ($booking['booking_code'] ?? '#' . $booking['id'])),
                $wave,
                $wind,
                0,
                0,
                1,
                [
                    'booking_id'   => (int) $booking['id'],
                    'booking_code' => (string) ($booking['booking_code'] ?? ''),
                    'reason'       => 'missing_email',
                ]
            );
            return;
        }

        $email = \Config\Services::email();
        $email->clear(true);
        $email->setTo($to)
            ->setFrom(env('MAIL_FROM_ADDRESS', 'admin@marisense.networq.online'), 'Waves Water Sports')
            ->setSubject('Booking Cancelled: Unsafe Maritime Conditions')
            ->setMessage(view('emails/unsafe_booking_cancellation', [
                'username'    => $booking['username'] ?? 'Guest',
                'bookingCode' => $booking['booking_code'] ?? '',
                'scheduledAt' => $scheduledAt,
            ]));

        $sent = false;
        try {
            $sent = $email->send();
        } catch (\Exception $e) {
            log_message('error', 'Unsafe-cancellation email exception for booking {booking_id}: {message}', [
                'booking_id' => $booking['id'] ?? null,
                'message'    => $e->getMessage(),
            ]);
        }

        if (! $sent) {
            log_message('error', 'Unsafe-cancellation email failed for booking {booking_id}', [
                'booking_id' => $booking['id'] ?? null,
            ]);

            $this->logEvent(
                'booking_notification_failed',
                sprintf('Failed to send unsafe-condition cancellation email for booking %s.', (string) ($booking['booking_code'] ?? '#' . $booking['id'])),
                $wave,
                $wind,
                0,
                0,
                1,
                [
                    'booking_id'   => (int) $booking['id'],
                    'booking_code' => (string) ($booking['booking_code'] ?? ''),
                    'email'        => $to,
                ]
            );
            return;
        }

        $this->logEvent(
            'booking_notification_sent',
            sprintf('Unsafe-condition cancellation email sent for booking %s.', (string) ($booking['booking_code'] ?? '#' . $booking['id'])),
            $wave,
            $wind,
            0,
            0,
            1,
            [
                'booking_id'   => (int) $booking['id'],
                'booking_code' => (string) ($booking['booking_code'] ?? ''),
                'email'        => $to,
            ]
        );
    }

    private function evaluateSustainedCondition(
        array $recentReadings,
        int $requiredPackets,
        int $minimumDurationSeconds,
        callable $predicate
    ): array {
        if (count($recentReadings) < $requiredPackets) {
            return ['matched' => false, 'packets' => 0, 'duration_seconds' => 0];
        }

        $sample = array_slice($recentReadings, 0, $requiredPackets);
        foreach ($sample as $reading) {
            if (! $predicate($reading)) {
                return ['matched' => false, 'packets' => 0, 'duration_seconds' => 0];
            }
        }

        $newestAt = strtotime((string) ($sample[0]['recorded_at'] ?? ''));
        $oldestAt = strtotime((string) ($sample[array_key_last($sample)]['recorded_at'] ?? ''));
        if ($newestAt === false || $oldestAt === false) {
            return ['matched' => false, 'packets' => 0, 'duration_seconds' => 0];
        }

        $duration = max(0, $newestAt - $oldestAt);
        if ($duration < $minimumDurationSeconds) {
            return ['matched' => false, 'packets' => 0, 'duration_seconds' => $duration];
        }

        return ['matched' => true, 'packets' => $requiredPackets, 'duration_seconds' => $duration];
    }

    private function logEvent(
        string $eventType,
        string $message,
        ?float $waveHeight,
        ?float $windSpeed,
        int $consecutivePackets,
        int $durationSeconds,
        int $affectedBookings,
        array $details = []
    ): void {
        $this->eventModel->insert([
            'event_type'            => $eventType,
            'message'               => $message,
            'wave_height'           => $waveHeight,
            'wind_speed'            => $windSpeed,
            'threshold_wave_height' => self::WAVE_DANGER_THRESHOLD,
            'threshold_wind_speed'  => self::WIND_DANGER_THRESHOLD,
            'consecutive_packets'   => max(0, $consecutivePackets),
            'duration_seconds'      => max(0, $durationSeconds),
            'affected_bookings'     => max(0, $affectedBookings),
            'details'               => $details === [] ? null : json_encode($details, JSON_UNESCAPED_SLASHES),
            'created_at'            => date('Y-m-d H:i:s'),
        ]);
    }

    private function extractWaveHeight(array $reading): float
    {
        return (float) ($reading['avg_wave_height'] ?? 0.0);
    }

    private function extractWindSpeed(array $reading): float
    {
        return (float) ($reading['avg_wind_speed'] ?? 0.0);
    }
}
