<?php

namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\BuoyDataModel;

class User extends BaseController
{
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

        $seaCondition = $db->table('sea_conditions')
                           ->orderBy('recorded_at', 'DESC')
                           ->limit(1)
                           ->get()
                           ->getRowArray();

        // Get latest buoy data
        $buoyModel = new BuoyDataModel();
        $buoyData = $buoyModel->getLatestReading();

        return view('user/home', [
            'reviews'      => $reviews,
            'seaCondition' => $seaCondition,
            'buoyData'     => $buoyData,
        ]);
    }

    // -----------------------------------------------------------------------
    // ACTIVITIES — now reads from DB (only active ones)
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
        $db = \Config\Database::connect();

        $seaCondition = $db->table('sea_conditions')
                           ->orderBy('recorded_at', 'DESC')
                           ->limit(1)
                           ->get()
                           ->getRowArray();

        return view('user/safety', ['seaCondition' => $seaCondition]);
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
    // BOOKING FORM — pricing/maxRiders/durations now come from DB
    // -----------------------------------------------------------------------

    public function booking()
    {
        $bookingModel = new BookingModel();

        // Load dynamic data from DB into static arrays
        BookingModel::loadFromDB();

        $pricing   = BookingModel::getPricing();
        $maxRiders = BookingModel::getMaxRiders();
        $durations = BookingModel::getDurations();

        // Also pass the full activity rows so the picker can be rendered dynamically
        $db         = \Config\Database::connect();
        $activities = $db->table('activities')
                         ->where('status', 'active')
                         ->orderBy('name', 'ASC')
                         ->get()
                         ->getResultArray();

        // Validate selected activity against what's actually in the DB
        $activity = $this->request->getGet('activity') ?? '';
        if (empty($activity) || ! array_key_exists($activity, $pricing)) {
            // Fall back to first active activity (or empty string if none)
            $activity = ! empty($activities) ? $activities[0]['name'] : '';
        }

        $seaCondition = $db->table('sea_conditions')
                           ->orderBy('recorded_at', 'DESC')
                           ->limit(1)
                           ->get()
                           ->getRowArray();

        return view('user/booking', [
            'selectedActivity' => $activity,
            'pricing'          => $pricing,
            'maxRiders'        => $maxRiders,
            'durations'        => $durations,
            'activities'       => $activities,   // for dynamic activity picker
            'bookedDates'      => $activity ? $bookingModel->getBookedDates($activity) : [],
            'seaCondition'     => $seaCondition,
        ]);
    }

    // -----------------------------------------------------------------------
    // STORE BOOKING (POST)
    // -----------------------------------------------------------------------

    public function storeBooking()
    {
        $bookingModel = new BookingModel();
        BookingModel::loadFromDB();

        $pricing   = BookingModel::getPricing();
        $maxRiders = BookingModel::getMaxRiders();

        $activity = $this->request->getPost('activity') ?? '';

        // Validate activity exists in DB
        if (empty($activity) || ! array_key_exists($activity, $pricing)) {
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Invalid activity selected.');
        }

        $rules = [
            'date'           => 'required|valid_date[Y-m-d]',
            'time'           => 'required',
            'participants'   => 'required|integer|greater_than[0]',
            'contact_number' => 'required',
            'guidelines'     => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                             ->withInput()
                             ->with('errors', $this->validator->getErrors());
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
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Please select a future date.');
        }

        if ($date === $today) {
            $selectedTimestamp = strtotime($date . ' ' . $time);
            if ($selectedTimestamp <= time()) {
                return redirect()->back()
                                 ->withInput()
                                 ->with('error', 'The selected time has already passed. Please choose a future time slot.');
            }
        }

        // Participants cap (single-activity bookings)
        $allActivities = array_filter(array_map('trim', explode(',', $allActivitiesRaw)));
        if (empty($allActivities)) {
            $allActivities = [$activity];
        }

        if (count($allActivities) === 1) {
            $max = $maxRiders[$activity] ?? 1;
            if ($participants > $max) {
                return redirect()->back()
                                 ->withInput()
                                 ->with('error', "Maximum {$max} rider(s) allowed for {$activity}.");
            }
        }

        // Time slot conflict check
        $normalizedTime = date('H:i:s', strtotime($time));
        $bookedSlots    = $bookingModel->getBookedSlots($activity, $date);
        if (in_array($normalizedTime, $bookedSlots)) {
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'That time slot is already taken. Please choose another.');
        }

        // Resolve activity_id
        $db      = \Config\Database::connect();
        $actRow  = $db->table('activities')->where('name', $activity)->get()->getRowArray();
        $actId   = $actRow['id'] ?? null;

        $userId      = auth()->user()->id;
        $bookingCode = $bookingModel->generateBookingCode();
        $total       = BookingModel::calculateTotal($activity, $participants);

        $saved = $bookingModel->insert([
            'user_id'          => $userId,
            'booking_code'     => $bookingCode,
            'activity_id'      => $actId,
            'activity_name'    => $activity,
            'all_activities'   => implode(',', $allActivities),
            'date'             => $date,
            'time'             => $normalizedTime,
            'participants'     => $participants,
            'contact_number'   => $contactNumber,
            'special_requests' => $special,
            'booking_type'     => 'booking',
            'total_amount'     => $total,
            'down_payment'     => 0,
            'status'           => 'pending',
            'payment_status'   => 'unpaid',
        ]);

        if (! $saved) {
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Booking failed. Please try again.');
        }

        $newId = $bookingModel->getInsertID();

        return redirect()->to(base_url("user/booking-details/{$newId}"))
                         ->with('success', "Booking confirmed! Your booking code is {$bookingCode}.");
    }

    // -----------------------------------------------------------------------
    // MY BOOKINGS
    // -----------------------------------------------------------------------

    public function my_bookings()
    {
        $bookingModel = new BookingModel();
        $userId       = auth()->user()->id;
        $bookings     = $bookingModel->getByUser($userId);

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
            return redirect()->to(base_url('user/my-bookings'))
                             ->with('error', 'Booking not found.');
        }

        return view('user/booking_details', ['booking' => $booking]);
    }

    // -----------------------------------------------------------------------
    // CANCEL BOOKING (POST)
    // -----------------------------------------------------------------------

    public function cancelBooking($id)
    {
        $bookingModel = new BookingModel();
        $userId       = auth()->user()->id;
        $booking      = $bookingModel->getByIdAndUser((int) $id, $userId);

        if (! $booking) {
            return redirect()->to(base_url('user/my-bookings'))
                             ->with('error', 'Booking not found.');
        }

        if (! in_array($booking['status'], ['pending', 'confirmed'])) {
            return redirect()->to(base_url('user/my-bookings'))
                             ->with('error', 'This booking cannot be cancelled.');
        }

        $bookingModel->update((int) $id, ['status' => 'cancelled']);

        return redirect()->to(base_url('user/my-bookings'))
                         ->with('success', 'Booking cancelled successfully.');
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
            '07:00:00', '08:00:00', '09:00:00', '10:00:00',
            '11:00:00', '12:00:00', '13:00:00', '14:00:00',
            '15:00:00', '16:00:00',
        ];

        $bookedSlots = $bookingModel->getBookedSlots($activity, $date);

        $now   = time();
        $today = date('Y-m-d');

        $result = array_map(function ($slot) use ($bookedSlots, $date, $today, $now) {
            $isBooked = in_array($slot, $bookedSlots);
            $isPast   = false;

            if ($date === $today) {
                $isPast = strtotime($date . ' ' . $slot) <= $now;
            }

            return [
                'time'      => date('h:i A', strtotime($slot)),
                'value'     => $slot,
                'available' => ! $isBooked && ! $isPast,
            ];
        }, $allSlots);

        return $this->response->setJSON(['slots' => $result]);
    }

    // -----------------------------------------------------------------------
    // AJAX — Booked Dates (for calendar)
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
            return redirect()->back()
                             ->withInput()
                             ->with('errors', $this->validator->getErrors());
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
            return redirect()->to(base_url('user/reviews'))
                             ->with('success', 'Thank you for sharing your adventure!');
        }

        return redirect()->back()
                         ->withInput()
                         ->with('error', 'Failed to post review.');
    }
}