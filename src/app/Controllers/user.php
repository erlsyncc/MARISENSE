<?php

namespace App\Controllers;

use App\Models\BookingModel;

class User extends BaseController
{
    // -----------------------------------------------------------------------
    // PAGES
    // -----------------------------------------------------------------------

    public function index()
    {
        $db = \Config\Database::connect();

        // Latest 3 approved reviews for home page
        $reviews = $db->table('reviews')
                      ->select('reviews.*, users.username')
                      ->join('users', 'users.id = reviews.user_id', 'left')
                      ->orderBy('reviews.created_at', 'DESC')
                      ->limit(3)
                      ->get()
                      ->getResultArray();

        // Latest sea condition
        $seaCondition = $db->table('sea_conditions')
                           ->orderBy('recorded_at', 'DESC')
                           ->limit(1)
                           ->get()
                           ->getRowArray();

        return view('user/home', [
            'reviews'      => $reviews,
            'seaCondition' => $seaCondition,
        ]);
    }

    public function activities()
    {
        return view('user/activities');
    }

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

    public function reviews()
    {
        $db = \Config\Database::connect();

        $reviews = $db->table('reviews')
                      ->select('reviews.*, users.username')
                      ->join('users', 'users.id = reviews.user_id', 'left')
                      ->orderBy('reviews.created_at', 'DESC')
                      ->get()
                      ->getResultArray();

        // Average rating
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

        $activity = $this->request->getGet('activity') ?? 'Jet Ski';

        $validActivities = array_keys(BookingModel::$pricing);
        if (!in_array($activity, $validActivities)) {
            $activity = 'Jet Ski';
        }

        $db = \Config\Database::connect();
        $seaCondition = $db->table('sea_conditions')
                           ->orderBy('recorded_at', 'DESC')
                           ->limit(1)
                           ->get()
                           ->getRowArray();

        $data = [
            'selectedActivity' => $activity,
            'pricing'          => BookingModel::$pricing,
            'maxRiders'        => BookingModel::$maxRiders,
            'durations'        => BookingModel::$durations,
            'bookedDates'      => $bookingModel->getBookedDates($activity),
            'seaCondition'     => $seaCondition,
        ];

        return view('user/booking', $data);
    }

    // -----------------------------------------------------------------------
    // STORE BOOKING (POST)
    // -----------------------------------------------------------------------

    public function storeBooking()
    {
        $bookingModel = new BookingModel();

        $rules = [
            'activity'     => 'required|in_list[Jet Ski,Banana Boat,Kayaking,Flying Saucer]',
            'date'         => 'required|valid_date[Y-m-d]',
            'time'         => 'required',
            'participants' => 'required|integer|greater_than[0]',
            'guidelines'   => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                             ->withInput()
                             ->with('errors', $this->validator->getErrors());
        }

        $activity     = $this->request->getPost('activity');
        $date         = $this->request->getPost('date');
        $time         = $this->request->getPost('time');
        $participants = (int) $this->request->getPost('participants');
        $special      = $this->request->getPost('special_requests') ?? '';

        // Must be a future date
        if (strtotime($date) < strtotime(date('Y-m-d'))) {
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Please select a future date.');
        }

        // Check max riders
        $maxRiders = BookingModel::$maxRiders[$activity] ?? 1;
        if ($participants > $maxRiders) {
            return redirect()->back()
                             ->withInput()
                             ->with('error', "Maximum {$maxRiders} riders allowed for {$activity}.");
        }

        // Check if time slot is already taken
        $normalizedTime = date('H:i:s', strtotime($time));
        $bookedSlots    = $bookingModel->getBookedSlots($activity, $date);
        if (in_array($normalizedTime, $bookedSlots)) {
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'That time slot is already taken. Please choose another.');
        }

        $userId      = auth()->user()->id;
        $bookingCode = $bookingModel->generateBookingCode();
        $total       = BookingModel::calculateTotal($activity, $participants);

        $saved = $bookingModel->insert([
            'user_id'          => $userId,
            'booking_code'     => $bookingCode,
            'activity_name'    => $activity,
            'date'             => $date,
            'time'             => $normalizedTime,
            'participants'     => $participants,
            'special_requests' => $special,
            'total_amount'     => $total,
            'status'           => 'pending',
            'payment_status'   => 'unpaid',
        ]);

        if (!$saved) {
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
        $booking      = $bookingModel->getByIdAndUser((int)$id, $userId);

        if (!$booking) {
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
        $booking      = $bookingModel->getByIdAndUser((int)$id, $userId);

        if (!$booking) {
            return redirect()->to(base_url('user/my-bookings'))
                             ->with('error', 'Booking not found.');
        }

        if (!in_array($booking['status'], ['pending', 'confirmed'])) {
            return redirect()->to(base_url('user/my-bookings'))
                             ->with('error', 'This booking cannot be cancelled.');
        }

        $bookingModel->update((int)$id, ['status' => 'cancelled']);

        return redirect()->to(base_url('user/my-bookings'))
                         ->with('success', 'Booking cancelled successfully.');
    }

    // -----------------------------------------------------------------------
    // AJAX — Time Slots
    // -----------------------------------------------------------------------

    public function bookingSlots()
    {
        $bookingModel = new BookingModel();
        $activity     = $this->request->getGet('activity') ?? 'Jet Ski';
        $date         = $this->request->getGet('date') ?? date('Y-m-d');

        $allSlots = [
            '09:00:00', '10:00:00', '11:00:00',
            '13:00:00', '14:00:00', '15:00:00',
        ];

        $bookedSlots = $bookingModel->getBookedSlots($activity, $date);

        $result = array_map(function ($slot) use ($bookedSlots) {
            return [
                'time'      => date('h:i A', strtotime($slot)),
                'value'     => $slot,
                'available' => !in_array($slot, $bookedSlots),
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
        $activity     = $this->request->getGet('activity') ?? 'Jet Ski';
        $bookedDates  = $bookingModel->getBookedDates($activity);

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

        if (!$this->validate($rules)) {
            return redirect()->back()
                             ->withInput()
                             ->with('errors', $this->validator->getErrors());
        }

        $photoName = null;
        $file = $this->request->getFile('review_photo');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $photoName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/reviews', $photoName);
        }

        $db      = \Config\Database::connect();
        $builder = $db->table('reviews');

        $safeFeel = strtolower($this->request->getPost('safe_feel')); // 'yes' or 'no'

        $data = [
            'user_id'     => auth()->user()->id,
            'activity'    => $this->request->getPost('activity'),
            'rating'      => $this->request->getPost('stars'),
            'review_text' => $this->request->getPost('comment'),
            'safe_feel'   => $safeFeel,
            'photo'       => $photoName,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ];

        if ($builder->insert($data)) {
            return redirect()->to(base_url('user/reviews'))
                             ->with('success', 'Thank you for sharing your adventure!');
        } else {
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Failed to post review.');
        }
    }
}