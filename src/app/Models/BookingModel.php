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
        'activity_name',
        'date',
        'time',
        'participants',
        'special_requests',
        'total_amount',
        'status',
        'payment_status',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Activity pricing
    public static array $pricing = [
        'Jet Ski'       => 2500,
        'Banana Boat'   => 500,
        'Kayaking'      => 300,
        'Flying Saucer' => 600,
    ];

    // Activity max riders
    public static array $maxRiders = [
        'Jet Ski'       => 2,
        'Banana Boat'   => 12,
        'Kayaking'      => 2,
        'Flying Saucer' => 10,
    ];

    // Activity durations (minutes)
    public static array $durations = [
        'Jet Ski'       => 15,
        'Banana Boat'   => 10,
        'Kayaking'      => 30,
        'Flying Saucer' => 10,
    ];

    /**
     * Generate a unique booking code
     */
    public function generateBookingCode(): string
    {
        do {
            $code = 'WWS-' . strtoupper(substr(md5(uniqid(rand(), true)), 0, 8));
        } while ($this->where('booking_code', $code)->countAllResults() > 0);

        return $code;
    }

    /**
     * Get all bookings for a specific user
     */
    public function getByUser(int $userId): array
    {
        return $this->where('user_id', $userId)
                    ->orderBy('date', 'DESC')
                    ->orderBy('time', 'DESC')
                    ->findAll();
    }

    /**
     * Get a single booking by ID and ensure it belongs to the user
     */
    public function getByIdAndUser(int $id, int $userId): ?array
    {
        return $this->where('id', $id)
                    ->where('user_id', $userId)
                    ->first();
    }

    /**
     * Get booked dates for a specific activity (fully booked = 5+ bookings that day)
     */
    public function getBookedDates(string $activity): array
    {
        $results = $this->select('date, COUNT(*) as booking_count')
                        ->where('activity_name', $activity)
                        ->whereNotIn('status', ['cancelled'])
                        ->groupBy('date')
                        ->having('booking_count >=', 5)
                        ->findAll();

        return array_column($results, 'date');
    }

    /**
     * Get booked time slots for a specific activity and date
     */
    public function getBookedSlots(string $activity, string $date): array
    {
        $results = $this->select('time')
                        ->where('activity_name', $activity)
                        ->where('date', $date)
                        ->whereNotIn('status', ['cancelled'])
                        ->findAll();

        return array_column($results, 'time');
    }

    /**
     * Calculate total amount based on activity and participants
     */
    public static function calculateTotal(string $activity, int $participants): float
    {
        $basePrice = self::$pricing[$activity] ?? 0;
        // Per-person activities
        $perPerson = ['Banana Boat', 'Flying Saucer'];
        if (in_array($activity, $perPerson)) {
            return $basePrice * $participants;
        }
        return $basePrice; // flat rate for Jet Ski, Kayaking
    }
}