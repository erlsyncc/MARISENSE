<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table            = 'bookings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields = [
        'user_id',
        'booking_code',
        'activity_id',
        'activity_name',
        'all_activities',
        'date',
        'time',
        'participants',
        'contact_number',
        'special_requests',
        'booking_type',
        'total_amount',
        'down_payment',
        'down_payment_status',
        'down_payment_paid_at',
        'status',
        'payment_status',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // ----------------------------------------------------------------
    // Static arrays kept for backward-compatibility with any code that
    // still references BookingModel::$pricing directly.
    // These are populated lazily via loadFromDB().
    // ----------------------------------------------------------------
    public static array $pricing   = [];
    public static array $maxRiders = [];
    public static array $durations = [];

    /** Call once to fill the static arrays from the activities table. */
    public static function loadFromDB(): void
    {
        // Already loaded — skip
        if (! empty(self::$pricing)) {
            return;
        }

        $db         = \Config\Database::connect();
        $activities = $db->table('activities')
                         ->where('status', 'active')
                         ->orderBy('name', 'ASC')
                         ->get()
                         ->getResultArray();

        foreach ($activities as $act) {
            $name = $act['name'];

            self::$pricing[$name]   = (float) $act['price'];
            self::$durations[$name] = (int)   ($act['duration'] ?? 0);

            // Extract numeric max from strings like "1–2 persons", "Up to 12", "12"
            preg_match('/(\d+)\s*(?:persons?)?$/u', $act['max_riders'] ?? '', $m);
            self::$maxRiders[$name] = isset($m[1]) ? (int) $m[1] : 1;
        }
    }

    // ----------------------------------------------------------------
    // Helpers that guarantee the arrays are loaded
    // ----------------------------------------------------------------
    public static function getPricing(): array
    {
        self::loadFromDB();
        return self::$pricing;
    }

    public static function getMaxRiders(): array
    {
        self::loadFromDB();
        return self::$maxRiders;
    }

    public static function getDurations(): array
    {
        self::loadFromDB();
        return self::$durations;
    }

    // ----------------------------------------------------------------
    // Generate a unique booking code
    // ----------------------------------------------------------------
    public function generateBookingCode(): string
    {
        do {
            $code = 'WWS-' . strtoupper(substr(md5(uniqid(rand(), true)), 0, 8));
        } while ($this->where('booking_code', $code)->countAllResults() > 0);

        return $code;
    }

    // ----------------------------------------------------------------
    // Get all bookings for a specific user
    // ----------------------------------------------------------------
    public function getByUser(int $userId): array
    {
        return $this->where('user_id', $userId)
                    ->orderBy('date', 'DESC')
                    ->orderBy('time', 'DESC')
                    ->findAll();
    }

    // ----------------------------------------------------------------
    // Get a single booking by ID and ensure it belongs to the user
    // ----------------------------------------------------------------
    public function getByIdAndUser(int $id, int $userId): ?array
    {
        return $this->where('id', $id)
                    ->where('user_id', $userId)
                    ->first();
    }

    // ----------------------------------------------------------------
    // Get booked dates for a specific activity
    // A date is "fully booked" when 6+ active bookings exist that day
    // (matches the 6-slot setup in bookingSlots())
    // ----------------------------------------------------------------
    public function getBookedDates(string $activity): array
    {
        $results = $this->select('date, COUNT(*) as booking_count')
                        ->where('activity_name', $activity)
                        ->whereNotIn('status', ['cancelled'])
                        ->groupBy('date')
                        ->having('booking_count >=', 6)
                        ->findAll();

        return array_column($results, 'date');
    }

    // ----------------------------------------------------------------
    // Get booked time slots for a specific activity and date
    // ----------------------------------------------------------------
    public function getBookedSlots(string $activity, string $date): array
    {
        $results = $this->select('time')
                        ->where('activity_name', $activity)
                        ->where('date', $date)
                        ->whereNotIn('status', ['cancelled'])
                        ->findAll();

        return array_column($results, 'time');
    }

    // ----------------------------------------------------------------
    // Calculate total amount based on activity and participants
    // Falls back to static arrays if DB hasn't been loaded yet
    // ----------------------------------------------------------------
    public static function calculateTotal(string $activity, int $participants): float
    {
        self::loadFromDB();

        $basePrice = self::$pricing[$activity] ?? 0;

        // Per-person activities
        $perPerson = ['Banana Boat', 'Flying Saucer'];
        if (in_array($activity, $perPerson)) {
            return $basePrice * $participants;
        }

        return $basePrice; // flat rate for Jet Ski, Kayaking, etc.
    }
}