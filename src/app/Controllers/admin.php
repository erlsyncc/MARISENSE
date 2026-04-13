<?php

namespace App\Controllers;

use App\Models\BookingModel;
use CodeIgniter\HTTP\RedirectResponse;

class Admin extends BaseController
{
    // ─────────────────────────────────────────────
    //  MIDDLEWARE CHECK — restrict to admin group
    // ─────────────────────────────────────────────
    protected function requireAdmin(): ?RedirectResponse
    {
        if (! auth()->user() || ! auth()->user()->inGroup('admin')) {
            return redirect()->to('/login')->with('error', 'Admin access only.');
        }
        return null;
    }

    // =========================================================
    //  DASHBOARD
    // =========================================================
    public function index()
    {
        if ($r = $this->requireAdmin()) return $r;

        $db = \Config\Database::connect();

        $totalBookings   = $db->table('bookings')->countAllResults();
        $pendingBookings = $db->table('bookings')->where('status', 'pending')->countAllResults();
        $totalUsers      = $db->table('users')->countAllResults();

        // Recent 5 bookings joined with username
        $recentBookings = $db->table('bookings b')
            ->select('b.*, u.username')
            ->join('users u', 'u.id = b.user_id', 'left')
            ->orderBy('b.created_at', 'DESC')
            ->limit(5)
            ->get()->getResultArray();

        // Latest sea condition
        $latestSea = $db->table('sea_conditions')
            ->orderBy('recorded_at', 'DESC')
            ->limit(1)
            ->get()->getRowArray();

        return view('admin/dashboard', [
            'totalBookings'   => $totalBookings,
            'pendingBookings' => $pendingBookings,
            'totalUsers'      => $totalUsers,
            'recentBookings'  => $recentBookings,
            'latestSea'       => $latestSea,
        ]);
    }

    // =========================================================
    //  BOOKINGS
    // =========================================================
    public function bookings()
    {
        if ($r = $this->requireAdmin()) return $r;

        $db = \Config\Database::connect();

        $bookings = $db->table('bookings b')
            ->select('b.*, u.username')
            ->join('users u', 'u.id = b.user_id', 'left')
            ->orderBy('b.created_at', 'DESC')
            ->get()->getResultArray();

        $pendingCount = $db->table('bookings')->where('status', 'pending')->countAllResults();

        return view('admin/bookings', [
            'bookings'     => $bookings,
            'pendingCount' => $pendingCount,
        ]);
    }

    public function updateBookingStatus()
    {
        if ($r = $this->requireAdmin()) return $r;

        $id     = (int) $this->request->getPost('id');
        $status = $this->request->getPost('status');

        $allowed = ['confirmed', 'completed', 'cancelled'];
        if (! $id || ! in_array($status, $allowed)) {
            return redirect()->back()->with('error', 'Invalid request.');
        }

        $db = \Config\Database::connect();
        $db->table('bookings')->where('id', $id)->update(['status' => $status]);

        return redirect()->to(base_url('admin/bookings'))
                         ->with('success', 'Booking status updated to ' . ucfirst($status) . '.');
    }

    // =========================================================
    //  USERS
    // =========================================================
    public function users()
    {
        if ($r = $this->requireAdmin()) return $r;

        $db = \Config\Database::connect();

        // Combine users + their email (from auth_identities) + role (from auth_groups_users)
        // + booking count
        $users = $db->table('users u')
            ->select('
                u.id,
                u.username,
                u.created_at,
                u.last_active,
                ai.secret   AS email,
                ag.group    AS role,
                COUNT(b.id) AS booking_count
            ')
            ->join('auth_identities ai',    'ai.user_id = u.id AND ai.type = "email_password"', 'left')
            ->join('auth_groups_users ag',  'ag.user_id = u.id', 'left')
            ->join('bookings b',            'b.user_id  = u.id', 'left')
            ->groupBy('u.id')
            ->orderBy('u.created_at', 'ASC')
            ->get()->getResultArray();

        return view('admin/users', ['users' => $users]);
    }

    // =========================================================
    //  SEA CONDITIONS
    // =========================================================
    public function seaConditions()
    {
        if ($r = $this->requireAdmin()) return $r;

        $db = \Config\Database::connect();

        $latestSea  = $db->table('sea_conditions')
            ->orderBy('recorded_at', 'DESC')
            ->limit(1)
            ->get()->getRowArray();

        $seaHistory = $db->table('sea_conditions sc')
            ->select('sc.*, u.username AS admin_username')
            ->join('users u', 'u.id = sc.updated_by', 'left')
            ->orderBy('sc.recorded_at', 'DESC')
            ->limit(20)
            ->get()->getResultArray();

        return view('admin/sea_conditions', [
            'latestSea'  => $latestSea,
            'seaHistory' => $seaHistory,
        ]);
    }

    public function updateSeaConditions()
    {
        if ($r = $this->requireAdmin()) return $r;

        $rules = [
            'wind_speed'    => 'required|numeric',
            'wave_height'   => 'required|numeric',
            'wave_period'   => 'required|numeric',
            'wind_direction'=> 'required|string',
            'safety_status' => 'required|in_list[safe,moderate,unsafe]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                             ->withInput()
                             ->with('error', implode(' ', $this->validator->getErrors()));
        }

        $data = [
            'wind_speed'     => $this->request->getPost('wind_speed'),
            'wind_direction' => $this->request->getPost('wind_direction'),
            'wave_height'    => $this->request->getPost('wave_height'),
            'wave_period'    => $this->request->getPost('wave_period'),
            'temperature'    => $this->request->getPost('temperature') ?: null,
            'safety_status'  => $this->request->getPost('safety_status'),
            'notes'          => $this->request->getPost('notes') ?: null,
            'updated_by'     => auth()->id(),
            'recorded_at'    => date('Y-m-d H:i:s'),
        ];

        \Config\Database::connect()->table('sea_conditions')->insert($data);

        return redirect()->to(base_url('admin/sea-conditions'))
                         ->with('success', 'Sea conditions updated successfully.');
    }

    // =========================================================
    //  REVIEWS
    // =========================================================
    public function reviews()
    {
        if ($r = $this->requireAdmin()) return $r;

        $db = \Config\Database::connect();

        $reviews = $db->table('reviews r')
            ->select('r.*, u.username')
            ->join('users u', 'u.id = r.user_id', 'left')
            ->orderBy('r.created_at', 'DESC')
            ->get()->getResultArray();

        $safeCount     = count(array_filter($reviews, fn($r) => strtolower($r['safe_feel'] ?? '') === 'yes'));
        $moderateCount = count(array_filter($reviews, fn($r) => strtolower($r['safe_feel'] ?? '') !== 'yes'));

        // Fix para sa Avg Rating calculation
        $avgRating = 0;
        if (count($reviews) > 0) {
            $totalStars = array_sum(array_column($reviews, 'rating'));
            $avgRating = round($totalStars / count($reviews), 1);
        }

        return view('admin/reviews', [
            'reviews'       => $reviews,
            'safeCount'     => $safeCount,
            'moderateCount' => $moderateCount,
            'avgRating'     => $avgRating, // I-pass ang computed rating
        ]);
    }

    public function deleteReview()
    {
        if ($r = $this->requireAdmin()) return $r;

        $id = (int) $this->request->getPost('id');
        if (! $id) {
            return redirect()->back()->with('error', 'Invalid review ID.');
        }

        \Config\Database::connect()->table('reviews')->where('id', $id)->delete();

        return redirect()->to(base_url('admin/reviews'))
                         ->with('success', 'Review deleted.');
    }

    // =========================================================
    //  ACTIVITIES
    // =========================================================
    public function activitiesPage()
    {
        if ($r = $this->requireAdmin()) return $r;

        $db = \Config\Database::connect();

        // Check if custom activities table exists; fall back to empty array if not
        try {
            $activities = $db->table('activities')
                ->orderBy('name', 'ASC')
                ->get()->getResultArray();
        } catch (\Exception $e) {
            $activities = [];
        }

        return view('admin/activities', ['activities' => $activities]);
    }

    public function saveActivity()
    {
        if ($r = $this->requireAdmin()) return $r;

        $rules = [
            'name'  => 'required|string|max_length[100]',
            'price' => 'required|numeric',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                             ->withInput()
                             ->with('error', implode(' ', $this->validator->getErrors()));
        }

        // Handle image upload
        $imgName = null;
        $imgFile = $this->request->getFile('image');
        if ($imgFile && $imgFile->isValid() && ! $imgFile->hasMoved()) {
            $imgName = $imgFile->getRandomName();
            $imgFile->move(ROOTPATH . 'public/images', $imgName);
        }

        $activityId = (int) $this->request->getPost('activity_id');

        $data = [
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description') ?: null,
            'price'       => (float) $this->request->getPost('price'),
            'duration'    => $this->request->getPost('duration') ?: null,
            'max_riders'  => $this->request->getPost('max_riders') ?: null,
            'difficulty'  => $this->request->getPost('difficulty') ?: 'Moderate',
            'status'      => $this->request->getPost('status') ?: 'active',
        ];

        if ($imgName) {
            $data['image'] = $imgName;
        }

        $db = \Config\Database::connect();

        if ($activityId) {
            // UPDATE existing
            $db->table('activities')->where('id', $activityId)->update($data);
            $msg = 'Activity updated successfully.';
        } else {
            // INSERT new
            $db->table('activities')->insert($data);
            $msg = 'Activity added successfully.';
        }

        return redirect()->to(base_url('admin/activities'))
                         ->with('success', $msg);
         }
            public function sales()
        {
            if ($r = $this->requireAdmin()) return $r;
            return view('admin/sales');
        }
}