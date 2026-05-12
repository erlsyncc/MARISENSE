<?php

namespace App\Controllers;

use App\Libraries\BookingSafetyMonitor;
use App\Models\BookingModel;
use App\Models\BuoyDataModel;

class User extends BaseController
{
    private function sendBookingActionNotification(
        int $bookingId,
        string $subject,
        string $headline,
        string $message,
        array $extraDetails = []
    ): void {
        log_message('info', '[BOOKING-EMAIL] START: Attempting to send "{subject}" for booking {booking_id}', [
            'subject'    => $subject,
            'booking_id' => $bookingId,
        ]);

        if ($bookingId <= 0) {
            log_message('warning', '[BOOKING-EMAIL] SKIPPED: Invalid booking ID {booking_id}', ['booking_id' => $bookingId]);
            return;
        }

        try {
            $db = \Config\Database::connect();
            log_message('debug', '[BOOKING-EMAIL] DB connected for booking {booking_id}', ['booking_id' => $bookingId]);

            $booking = $db->table('bookings b')
                ->select('
                    b.id,
                    b.booking_code,
                    b.date,
                    b.time,
                    b.status,
                    b.payment_status,
                    b.down_payment_status,
                    b.down_payment,
                    b.total_amount,
                    b.cancel_reason,
                    u.username,
                    ai.secret AS email
                ')
                ->join('users u', 'u.id = b.user_id', 'left')
                ->join('auth_identities ai', 'ai.user_id = b.user_id AND ai.type = "email_password"', 'left')
                ->where('b.id', $bookingId)
                ->get()
                ->getRowArray();

            if (! $booking) {
                log_message('warning', '[BOOKING-EMAIL] SKIPPED: Booking {booking_id} not found in database', ['booking_id' => $bookingId]);
                return;
            }

            log_message('debug', '[BOOKING-EMAIL] Booking {booking_id} fetched: code={code}, user_id={user_id}', [
                'booking_id' => $bookingId,
                'code'       => $booking['booking_code'] ?? 'N/A',
                'user_id'    => $booking['user_id'] ?? 'N/A',
            ]);

            $to = trim((string) ($booking['email'] ?? ''));
            if ($to === '') {
                log_message('warning', '[BOOKING-EMAIL] SKIPPED: No email found for booking {booking_id}', ['booking_id' => $bookingId]);
                return;
            }

            log_message('info', '[BOOKING-EMAIL] Email target: {email} for booking {booking_id}', [
                'email'      => $to,
                'booking_id' => $bookingId,
            ]);

            $scheduleDate = ! empty($booking['date']) ? date('M d, Y', strtotime((string) $booking['date'])) : 'N/A';
            $scheduleTime = ! empty($booking['time']) ? date('h:i A', strtotime((string) $booking['time'])) : 'N/A';
            $guestName    = trim((string) ($booking['username'] ?? 'Guest'));

            $details = [
                'Booking Code'        => (string) ($booking['booking_code'] ?? ('#' . $bookingId)),
                'Schedule'            => $scheduleDate . ' at ' . $scheduleTime,
                'Booking Status'      => ucfirst((string) ($booking['status'] ?? 'pending')),
                'Payment Status'      => ucfirst((string) ($booking['payment_status'] ?? 'pending')),
                'Down Payment Status' => ucfirst((string) ($booking['down_payment_status'] ?? 'pending')),
            ];

            if (! empty($booking['cancel_reason'])) {
                $details['Cancellation Reason'] = (string) $booking['cancel_reason'];
            }

            foreach ($extraDetails as $label => $value) {
                if ($value === null || $value === '') {
                    continue;
                }
                $details[(string) $label] = (string) $value;
            }

            $detailHtml = '';
            foreach ($details as $label => $value) {
                $detailHtml .= '<tr>'
                    . '<td style="padding:8px 10px;border:1px solid #dbe7ef;background:#f8fbfd;font-weight:600;">' . esc($label) . '</td>'
                    . '<td style="padding:8px 10px;border:1px solid #dbe7ef;">' . esc($value) . '</td>'
                    . '</tr>';
            }

            $emailBody = '
                <div style="font-family:Arial,Helvetica,sans-serif;line-height:1.6;color:#163447;">
                    <h2 style="margin:0 0 12px;color:#0a5872;">' . esc($headline) . '</h2>
                    <p style="margin:0 0 12px;">Hi ' . esc($guestName) . ',</p>
                    <p style="margin:0 0 16px;">' . esc($message) . '</p>
                    <table style="border-collapse:collapse;width:100%;max-width:700px;margin:0 0 16px;">' . $detailHtml . '</table>
                    <p style="margin:0;">Thank you,<br>Waves Water Sports</p>
                </div>
            ';

            log_message('debug', '[BOOKING-EMAIL] Email body composed for booking {booking_id}. To: {email}', [
                'booking_id' => $bookingId,
                'email'      => $to,
            ]);

            $email = \Config\Services::email();
            $email->setTo($to)
                ->setFrom(env('MAIL_FROM_ADDRESS', 'admin@marisense.networq.online'), 'Waves Water Sports')
                ->setSubject($subject)
                ->setMessage($emailBody);

            log_message('debug', '[BOOKING-EMAIL] Calling email->send() for booking {booking_id}', ['booking_id' => $bookingId]);

            $sent = false;
            try {
                $sent = $email->send();
            } catch (\Exception $e) {
                log_message('error', '[BOOKING-EMAIL] EXCEPTION during email->send() for booking {booking_id}: {message}', [
                    'booking_id' => $bookingId,
                    'message'    => $e->getMessage(),
                    'exception'  => get_class($e),
                ]);
                $debugger = $email->printDebugger(['headers', 'subject', 'body']);
                log_message('error', '[BOOKING-EMAIL] DEBUGGER OUTPUT: {debugger}', ['debugger' => $debugger]);
            }

            if ($sent) {
                log_message('info', '[BOOKING-EMAIL] SUCCESS: Email sent for booking {booking_id} to {email}', [
                    'booking_id' => $bookingId,
                    'email'      => $to,
                    'subject'    => $subject,
                ]);
            } else {
                log_message('error', '[BOOKING-EMAIL] FAILED: Email not sent for booking {booking_id} to {email}', [
                    'booking_id' => $bookingId,
                    'email'      => $to,
                ]);
                $debugger = $email->printDebugger(['headers', 'subject', 'body']);
                log_message('error', '[BOOKING-EMAIL] DEBUGGER OUTPUT: {debugger}', ['debugger' => $debugger]);
            }
        } catch (\Exception $e) {
            log_message('error', '[BOOKING-EMAIL] FATAL ERROR for booking {booking_id}: {message}', [
                'booking_id' => $bookingId,
                'message'    => $e->getMessage(),
                'exception'  => get_class($e),
                'file'       => $e->getFile(),
                'line'       => $e->getLine(),
            ]);
        }
    }

    // -----------------------------------------------------------------------
    // HOME
    // -----------------------------------------------------------------------

    public function index()
    {
        $db = \Config\Database::connect();

        $reviews = $db->table('reviews')
                      ->select('reviews.*, users.username')
                      ->join('users', 'users.id = reviews.user_id', 'left')
                      ->orderBy('reviews.created_at', 'DESC')
                      ->limit(3)
                      ->get()
                      ->getResultArray();

        $buoyModel = new BuoyDataModel();
        $buoyData  = $buoyModel->getLatestReading();

        return view('user/home', [
            'reviews'  => $reviews,
            'buoyData' => $buoyData,
        ]);
    }

    // -----------------------------------------------------------------------
    // ACTIVITIES
    // -----------------------------------------------------------------------

    public function activities()
    {
        $db         = \Config\Database::connect();
        $activities = $db->table('activities')
                         ->where('status', 'active')
                         ->orderBy('name', 'ASC')
                         ->get()
                         ->getResultArray();

        return view('user/activities', ['activities' => $activities]);
    }

    // -----------------------------------------------------------------------
    // SAFETY
    // -----------------------------------------------------------------------

    public function safety()
    {
        $buoyModel = new BuoyDataModel();
        $buoyData  = $buoyModel->getLatestReading();

        return view('user/safety', [
            'buoyData' => $buoyData,
        ]);
    }

    // -----------------------------------------------------------------------
    // REVIEWS
    // -----------------------------------------------------------------------

    public function reviews()
    {
        $db = \Config\Database::connect();

        $reviews = $db->table('reviews')
                      ->select('reviews.*, users.username')
                      ->join('users', 'users.id = reviews.user_id', 'left')
                      ->orderBy('reviews.created_at', 'DESC')
                      ->get()
                      ->getResultArray();

        $avgResult = $db->table('reviews')->selectAvg('rating', 'avg_rating')->get()->getRowArray();
        $avgRating = $avgResult ? round($avgResult['avg_rating'], 1) : 0;

        return view('user/reviews', [
            'reviews'   => $reviews,
            'avgRating' => $avgRating,
        ]);
    }

    // -----------------------------------------------------------------------
    // BOOKING FORM
    // -----------------------------------------------------------------------

    public function booking()
    {
        $bookingModel = new BookingModel();
        BookingModel::loadFromDB();
        $safetyMonitor      = new BookingSafetyMonitor();
        $bookingBlocked     = $safetyMonitor->isBookingBlocked();
        $bookingAllowedFrom = $safetyMonitor->getUnsafeBookingAllowedFromDate();

        $pricing   = BookingModel::getPricing();
        $maxRiders = BookingModel::getMaxRiders();
        $durations = BookingModel::getDurations();

        $db         = \Config\Database::connect();
        $activities = $db->table('activities')
                         ->where('status', 'active')
                         ->orderBy('name', 'ASC')
                         ->get()
                         ->getResultArray();

        $activity = $this->request->getGet('activity') ?? '';
        if (empty($activity) || ! array_key_exists($activity, $pricing)) {
            $activity = ! empty($activities) ? $activities[0]['name'] : '';
        }

        return view('user/booking', [
            'selectedActivity' => $activity,
            'pricing'          => $pricing,
            'maxRiders'        => $maxRiders,
            'durations'        => $durations,
            'activities'       => $activities,
            'bookedDates'      => $activity ? $bookingModel->getBookedDates($activity) : [],
            'bookingBlocked'   => $bookingBlocked,
            'bookingAllowedFrom' => $bookingAllowedFrom,
            'bookingBlockedMessage' => $bookingBlocked
                ? 'Unsafe sea conditions are active. Reservations for today are paused. You can still reserve from ' . $bookingAllowedFrom . ' onward.'
                : '',
        ]);
    }

    // -----------------------------------------------------------------------
    // STORE BOOKING (POST)
    // -----------------------------------------------------------------------

    public function storeBooking()
    {
        $safetyMonitor = new BookingSafetyMonitor();

        $bookingModel = new BookingModel();
        BookingModel::loadFromDB();

        $maxRiders = BookingModel::getMaxRiders();

        $activity = $this->request->getPost('activity') ?? '';

        $db         = \Config\Database::connect();
        $activities = $db->table('activities')
                         ->where('status', 'active')
                         ->get()
                         ->getResultArray();
        $activityNames = array_column($activities, 'name');

        if (empty($activity) || ! in_array($activity, $activityNames)) {
            return redirect()->back()->withInput()->with('error', 'Invalid activity selected.');
        }

        $rules = [
            'date'           => 'required|valid_date[Y-m-d]',
            'time'           => 'required',
            'participants'   => 'required|integer|greater_than[0]',
            'contact_number' => 'required',
            'guidelines'     => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $date          = $this->request->getPost('date');
        $time          = $this->request->getPost('time');
        $participants  = (int) $this->request->getPost('participants');
        $special       = $this->request->getPost('special_requests') ?? '';
        $contactNumber = $this->request->getPost('contact_number') ?? '';
        $allActivitiesRaw = $this->request->getPost('all_activities') ?? $activity;

        // Date validation
        $today = date('Y-m-d');
        if ($date < $today) {
            return redirect()->back()->withInput()->with('error', 'Please select a future date.');
        }

        if ($date === $today) {
            $selectedTimestamp = strtotime($date . ' ' . $time);
            if ($selectedTimestamp <= time()) {
                return redirect()->back()->withInput()->with('error', 'The selected time has already passed. Please choose a future time slot.');
            }
        }

        if (! $safetyMonitor->canBookForDate($date)) {
            return redirect()->back()->withInput()
                ->with('error', 'Unsafe sea conditions are active. Reservations for today are paused. You can still reserve from ' . $safetyMonitor->getUnsafeBookingAllowedFromDate() . ' onward.');
        }

        $allActivities = array_values(array_filter(array_map('trim', explode(',', $allActivitiesRaw))));
        if (empty($allActivities)) {
            $allActivities = [$activity];
        }

        if (count($allActivities) === 1) {
            $max = $maxRiders[$activity] ?? 1;
            if ($participants > $max) {
                return redirect()->back()->withInput()->with('error', "Maximum {$max} rider(s) allowed for {$activity}.");
            }
        }

        // Build per-activity participants from POST
        $participantsPerActivity = [];
        $rawPpa = $this->request->getPost('participants_per_activity') ?? [];
        if (is_array($rawPpa) && ! empty($rawPpa)) {
            foreach ($allActivities as $actName) {
                $actName = trim($actName);
                $participantsPerActivity[$actName] = (int)($rawPpa[$actName] ?? $participants);
            }
        } else {
            foreach ($allActivities as $actName) {
                $participantsPerActivity[trim($actName)] = $participants;
            }
        }

        // Time slot conflict check
        $normalizedTime = date('H:i:s', strtotime($time));
        $bookedSlots    = $bookingModel->getBookedSlots($activity, $date);
        if (in_array($normalizedTime, $bookedSlots)) {
            return redirect()->back()->withInput()->with('error', 'That time slot is already taken. Please choose another.');
        }

        // ── CORRECT TOTAL: sum price × pax per activity ──────────────────
        $total   = 0.0;
        $actId   = null;

        foreach ($allActivities as $actName) {
            $actName = trim($actName);
            $actRow  = $db->table('activities')->where('name', $actName)->get()->getRowArray();
            if (! $actRow) {
                continue;
            }

            // Capture the ID of the primary (first) activity
            if ($actId === null) {
                $actId = $actRow['id'];
            }

            $price     = (float)($actRow['price'] ?? 0);
            $priceType = $actRow['price_type'] ?? 'flat';
            $pax       = $participantsPerActivity[$actName] ?? $participants;

            $total += ($priceType === 'per_person') ? $price * $pax : $price;
        }
        // ─────────────────────────────────────────────────────────────────

        $userId      = auth()->user()->id;
        $bookingCode = $bookingModel->generateBookingCode();

        $saved = $bookingModel->insert([
            'user_id'                   => $userId,
            'booking_code'              => $bookingCode,
            'activity_id'               => $actId,
            'activity_name'             => $activity,
            'all_activities'            => implode(',', $allActivities),
            'participants_per_activity' => json_encode($participantsPerActivity),
            'date'                      => $date,
            'time'                      => $normalizedTime,
            'participants'              => $participants,
            'contact_number'            => $contactNumber,
            'special_requests'          => $special,
            'booking_type'              => 'booking',
            'total_amount'              => $total,
            'down_payment'              => 0,
            'status'                    => 'pending',
            'payment_status'            => 'unpaid',
        ]);

        if (! $saved) {
            return redirect()->back()->withInput()->with('error', 'Booking failed. Please try again.');
        }

        $newId = $bookingModel->getInsertID();

        $this->sendBookingActionNotification(
            (int) $newId,
            'Booking Request Received',
            'Your booking request was received',
            'We received your booking request. Our admin team will review and update your booking status shortly.',
            [
                'Total Amount' => 'PHP ' . number_format((float) $total, 2),
                'Selected Activities' => implode(', ', $allActivities),
            ]
        );

        return redirect()->to(base_url("user/booking-details/{$newId}"))
                         ->with('success', "Booking confirmed! Your booking code is {$bookingCode}.");
    }

    // -----------------------------------------------------------------------
    // MY BOOKINGS — latest booked first, with refund data for cancelled paid bookings
    // -----------------------------------------------------------------------

    public function my_bookings()
    {
        $bookingModel = new BookingModel();
        $userId       = auth()->user()->id;
        $bookings     = $bookingModel->where('user_id', $userId)
                                     ->orderBy('created_at', 'DESC')
                                     ->findAll();

        // ── Attach refund record to any cancelled booking that was paid ──
        $db = \Config\Database::connect();
        foreach ($bookings as &$booking) {
            $booking['refund'] = null;

            $statusRaw = strtolower($booking['status'] ?? '');
            $wasPaid   = ($booking['payment_status'] ?? '') === 'paid'
                      || ($booking['down_payment_status'] ?? '') === 'paid';

            if ($statusRaw === 'cancelled' && $wasPaid) {
                try {
                    $refund = $db->table('booking_refunds')
                        ->where('booking_id', $booking['id'])
                        ->orderBy('created_at', 'DESC')
                        ->limit(1)
                        ->get()->getRowArray();
                    $booking['refund'] = $refund ?: null;
                } catch (\Exception $e) {
                    $booking['refund'] = null;
                }
            }
        }
        unset($booking);

        return view('user/my_bookings', ['bookings' => $bookings]);
    }

    // -----------------------------------------------------------------------
    // BOOKING DETAILS
    // -----------------------------------------------------------------------

    public function bookingDetails($id)
    {
        $bookingModel = new BookingModel();
        $userId       = auth()->user()->id;
        $booking      = $bookingModel->getByIdAndUser((int) $id, $userId);

        if (! $booking) {
            return redirect()->to(base_url('user/my-bookings'))->with('error', 'Booking not found.');
        }

        return view('user/booking_details', ['booking' => $booking]);
    }

    // -----------------------------------------------------------------------
    // CANCEL BOOKING (POST)
    // ── If the user already paid, auto-create a pending refund record ──
    // -----------------------------------------------------------------------

    public function cancelBooking($id)
    {
        $bookingModel = new BookingModel();
        $userId       = auth()->user()->id;
        $booking      = $bookingModel->getByIdAndUser((int) $id, $userId);

        if (! $booking) {
            return redirect()->to(base_url('user/my-bookings'))->with('error', 'Booking not found.');
        }

        if (! in_array($booking['status'], ['pending', 'confirmed'])) {
            return redirect()->to(base_url('user/my-bookings'))->with('error', 'This booking cannot be cancelled.');
        }

        // Mark booking as cancelled
        $bookingModel->update((int) $id, [
            'status'        => 'cancelled',
            'cancel_reason' => 'Cancelled by guest',
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        // ── Auto-create refund record if booking had a payment ──
        $wasPaid = ($booking['payment_status'] ?? '') === 'paid'
                || ($booking['down_payment_status'] ?? '') === 'paid';

        if ($wasPaid) {
            $db = \Config\Database::connect();
            try {
                $existing = $db->table('booking_refunds')
                    ->where('booking_id', (int) $id)
                    ->get()->getRowArray();

                if (! $existing) {
                    $refundAmount = ($booking['payment_status'] === 'paid')
                        ? (float)($booking['total_amount'] ?? 0)
                        : (float)($booking['down_payment'] ?? round((float)($booking['total_amount'] ?? 0) * 0.5, 2));

                    $db->table('booking_refunds')->insert([
                        'booking_id'    => (int) $id,
                        'refund_amount' => $refundAmount,
                        'refund_status' => 'pending',
                        'refund_note'   => 'Cancelled by guest. Admin will process GCash refund.',
                        'created_by'    => $userId,
                        'created_at'    => date('Y-m-d H:i:s'),
                        'updated_at'    => date('Y-m-d H:i:s'),
                    ]);
                }
            } catch (\Exception $e) {
                log_message('error', 'booking_refunds insert failed (user cancel): ' . $e->getMessage());
            }

            $this->sendBookingActionNotification(
                (int) $id,
                'Booking Cancelled',
                'Your booking has been cancelled',
                'You cancelled this booking successfully. Your refund request is now pending admin processing.',
                ['Refund Status' => 'Pending']
            );

            return redirect()->to(base_url('user/my-bookings'))
                ->with('success', 'Booking cancelled. Since you had already paid, your refund is being processed. You will see the GCash proof here once the admin sends it back.');
        }

        $this->sendBookingActionNotification(
            (int) $id,
            'Booking Cancelled',
            'Your booking has been cancelled',
            'You cancelled this booking successfully.'
        );

        return redirect()->to(base_url('user/my-bookings'))->with('success', 'Booking cancelled successfully.');
    }

    // -----------------------------------------------------------------------
    // PAY BOOKING (POST) — GCash upload
    // -----------------------------------------------------------------------

    public function payBooking()
    {
        $bookingId   = (int) $this->request->getPost('booking_id');
        $paymentType = $this->request->getPost('payment_type'); // 'half' or 'full'
        $gcashRef    = $this->request->getPost('gcash_ref') ?? '';

        if (! $bookingId || ! in_array($paymentType, ['half', 'full'])) {
            return redirect()->to(base_url('user/my-bookings'))->with('error', 'Invalid payment request.');
        }

        $bookingModel = new BookingModel();
        $userId       = auth()->user()->id;
        $booking      = $bookingModel->getByIdAndUser($bookingId, $userId);

        if (! $booking) {
            return redirect()->to(base_url('user/my-bookings'))->with('error', 'Booking not found.');
        }

        if ($booking['payment_status'] === 'paid') {
            return redirect()->to(base_url('user/my-bookings'))->with('error', 'This booking is already fully paid.');
        }

        // Handle file upload
        $file = $this->request->getFile('gcash_receipt');
        if (! $file || ! $file->isValid() || $file->hasMoved()) {
            return redirect()->back()->withInput()->with('error', 'Please upload your GCash receipt screenshot.');
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (! in_array($file->getMimeType(), $allowedTypes)) {
            return redirect()->back()->withInput()->with('error', 'Invalid file type. Please upload a JPG or PNG image.');
        }

        $receiptName = $file->getRandomName();
        $file->move(FCPATH . 'uploads/gcash_receipts', $receiptName);

        $totalAmount = (float) $booking['total_amount'];
        $halfAmount  = round($totalAmount / 2, 2);

        $amountPaid = ($paymentType === 'full') ? $totalAmount : $halfAmount;
        $payTypeKey = ($paymentType === 'full') ? 'full_payment' : 'down_payment';

        $db = \Config\Database::connect();

        // Insert into payment_history
        $db->table('payment_history')->insert([
            'booking_id'     => $bookingId,
            'user_id'        => $userId,
            'amount'         => $amountPaid,
            'payment_type'   => $payTypeKey,
            'payment_method' => 'gcash',
            'gcash_receipt'  => $receiptName,
            'gcash_ref'      => $gcashRef ?: null,
            'is_verified'    => 0,
            'notes'          => 'Pending admin verification',
            'created_at'     => date('Y-m-d H:i:s'),
        ]);

        // Update booking payment fields
        if ($paymentType === 'full') {
            $bookingModel->update($bookingId, [
                'payment_status' => 'paid',
                'updated_at'     => date('Y-m-d H:i:s'),
            ]);
        } else {
            $bookingModel->update($bookingId, [
                'down_payment'         => $halfAmount,
                'down_payment_status'  => 'paid',
                'down_payment_paid_at' => date('Y-m-d H:i:s'),
                'updated_at'           => date('Y-m-d H:i:s'),
            ]);
        }

        $this->sendBookingActionNotification(
            $bookingId,
            'Payment Submitted',
            'Your payment submission was received',
            'We received your payment receipt. Our admin team will verify it and send another email once reviewed.',
            [
                'Payment Type' => $paymentType === 'full' ? 'Full Payment' : 'Down Payment (50%)',
                'Amount Submitted' => 'PHP ' . number_format((float) $amountPaid, 2),
                'GCash Reference' => $gcashRef ?: null,
                'Verification Status' => 'Pending Admin Verification',
            ]
        );

        return redirect()->to(base_url('user/my-bookings'))
                         ->with('success', 'Payment submitted! Please wait for admin verification.');
    }

    // -----------------------------------------------------------------------
    // AJAX — Time Slots
    // -----------------------------------------------------------------------

    public function bookingSlots()
    {
        $bookingModel = new BookingModel();
        $activity     = $this->request->getGet('activity') ?? '';
        $date         = $this->request->getGet('date')     ?? date('Y-m-d');

        $allSlots = [
            '07:00:00','08:00:00','09:00:00','10:00:00',
            '11:00:00','12:00:00','13:00:00','14:00:00','15:00:00','16:00:00',
        ];

        $bookedSlots = $bookingModel->getBookedSlots($activity, $date);

        $now   = time();
        $today = date('Y-m-d');

        $result = array_map(function ($slot) use ($bookedSlots, $date, $today, $now) {
            $isBooked = in_array($slot, $bookedSlots);
            $isPast   = ($date === $today) && strtotime($date . ' ' . $slot) <= $now;
            return [
                'time'      => date('h:i A', strtotime($slot)),
                'value'     => $slot,
                'available' => ! $isBooked && ! $isPast,
            ];
        }, $allSlots);

        return $this->response->setJSON(['slots' => $result]);
    }

    // -----------------------------------------------------------------------
    // AJAX — Booked Dates
    // -----------------------------------------------------------------------

    public function bookedDates()
    {
        $bookingModel = new BookingModel();
        $activity     = $this->request->getGet('activity') ?? '';
        $bookedDates  = $activity ? $bookingModel->getBookedDates($activity) : [];

        return $this->response->setJSON(['bookedDates' => $bookedDates]);
    }

    // -----------------------------------------------------------------------
    // POST REVIEW
    // -----------------------------------------------------------------------

    public function postReview()
    {
        $rules = [
            'activity'  => 'required',
            'stars'     => 'required|integer|greater_than[0]|less_than[6]',
            'comment'   => 'required|min_length[5]',
            'safe_feel' => 'required|in_list[Yes,No]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $photoName = null;
        $file = $this->request->getFile('review_photo');

        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $photoName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/reviews', $photoName);
        }

        $db      = \Config\Database::connect();
        $builder = $db->table('reviews');

        $data = [
            'user_id'     => auth()->user()->id,
            'activity'    => $this->request->getPost('activity'),
            'rating'      => $this->request->getPost('stars'),
            'review_text' => $this->request->getPost('comment'),
            'safe_feel'   => strtolower($this->request->getPost('safe_feel')),
            'photo'       => $photoName,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ];

        if ($builder->insert($data)) {
            return redirect()->to(base_url('user/reviews'))->with('success', 'Thank you for sharing your adventure!');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to post review.');
    }
}
