<?php

namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\BuoyDataModel;
use CodeIgniter\HTTP\RedirectResponse;

class Admin extends BaseController
{
    protected function requireAdmin(): ?RedirectResponse
    {
        if (! auth()->user() || ! auth()->user()->inGroup('admin')) {
            return redirect()->to('/login')->with('error', 'Admin access only.');
        }
        return null;
    }

    // =========================================================
    //  DASHBOARD  — shows only the 5 most recent bookings
    // =========================================================
    public function index()
    {
        if ($r = $this->requireAdmin()) return $r;

        $db = \Config\Database::connect();

        $totalBookings   = $db->table('bookings')->countAllResults();
        $pendingBookings = $db->table('bookings')->where('status', 'pending')->countAllResults();
        $totalUsers      = $db->table('users')->countAllResults();

        $recentBookings = $db->table('bookings b')
            ->select('b.*, u.username')
            ->join('users u', 'u.id = b.user_id', 'left')
            ->orderBy('b.created_at', 'DESC')
            ->limit(5)
            ->get()->getResultArray();

        $buoyModel = new BuoyDataModel();
        $buoyData  = $buoyModel->getLatestReading();

        return view('admin/dashboard', [
            'totalBookings'   => $totalBookings,
            'pendingBookings' => $pendingBookings,
            'totalUsers'      => $totalUsers,
            'recentBookings'  => $recentBookings,
            'buoyData'        => $buoyData,
        ]);
    }

    // =========================================================
    //  BOOKINGS — paginated full list with receipt merge
    // =========================================================
    public function bookings()
    {
        if ($r = $this->requireAdmin()) return $r;

        $db      = \Config\Database::connect();
        $perPage = 15;
        $page    = max(1, (int)($this->request->getGet('page') ?? 1));
        $offset  = ($page - 1) * $perPage;

        // Active filter & search
        $statusFilter = $this->request->getGet('status') ?? 'all';
        $search       = trim($this->request->getGet('search') ?? '');

        // Base builder
        $builder = $db->table('bookings b')
            ->select('b.*, u.username')
            ->join('users u', 'u.id = b.user_id', 'left');

        if ($statusFilter !== 'all') {
            $builder->where('b.status', $statusFilter);
        }
        if ($search !== '') {
            $builder->groupStart()
                ->like('u.username', $search)
                ->orLike('b.booking_code', $search)
                ->groupEnd();
        }

        $totalBookings = $builder->countAllResults(false); // false = don't reset
        $totalPages    = (int)ceil($totalBookings / $perPage);

        $bookings = $builder
            ->orderBy('b.created_at', 'DESC')
            ->limit($perPage, $offset)
            ->get()->getResultArray();

        // ── Merge latest payment_history receipt data into each booking ──
        foreach ($bookings as &$b) {
            $ph = $db->table('payment_history')
                ->where('booking_id', $b['id'])
                ->orderBy('created_at', 'DESC')
                ->limit(1)
                ->get()->getRowArray();

            $b['latest_payment'] = $ph ?: null;

            if (empty($b['gcash_receipt']) && !empty($ph['gcash_receipt'])) {
                $b['gcash_receipt']      = $ph['gcash_receipt'];
                $b['gcash_ref']          = $ph['gcash_ref'] ?? null;
                $b['gcash_submitted_at'] = $ph['created_at'] ?? null;
            }

            $b['gcash_receipt_path'] = $b['gcash_receipt']      ?? null;
            $b['gcash_ref_no']       = $b['gcash_ref']          ?? null;
            $b['gcash_submitted_at'] = $b['gcash_submitted_at'] ?? $ph['created_at'] ?? null;
        }
        unset($b);

        // ── Pre-compute line items server-side ──
        foreach ($bookings as &$b) {
            $actNames = array_values(array_filter(array_map('trim', explode(',', $b['all_activities'] ?? $b['activity_name'] ?? ''))));
            $ppaMap   = [];
            if (!empty($b['participants_per_activity'])) {
                $dec = json_decode($b['participants_per_activity'], true);
                if (is_array($dec)) $ppaMap = $dec;
            }
            if (empty($ppaMap)) {
                $tot = (int)($b['participants'] ?? 1);
                $per = (int)floor($tot / max(count($actNames), 1));
                $rem = $tot % max(count($actNames), 1);
                foreach ($actNames as $idx => $an) {
                    $ppaMap[$an] = $per + ($idx === 0 ? $rem : 0);
                }
            }
            $lineItems = [];
            foreach ($actNames as $an) {
                $an    = trim($an);
                $pax   = (int)($ppaMap[$an] ?? 0);
                $row   = $db->table('activities')->where('name', $an)->get()->getRowArray();
                $price = $row ? (float)$row['price'] : 0;
                $type  = $row ? ($row['price_type'] ?? 'flat') : 'flat';
                $lineT = ($type === 'per_person') ? $price * $pax : $price;
                $lineItems[$an] = ['price' => $price, 'price_type' => $type, 'pax' => $pax, 'line_total' => $lineT];
            }
            $b['_line_items'] = $lineItems;
        }
        unset($b);

        $pendingCount       = $db->table('bookings')->where('status', 'pending')->countAllResults();
        $pendingVerifyCount = $db->table('payment_history')
            ->where('is_verified', 0)
            ->where('gcash_receipt IS NOT NULL', null, false)
            ->countAllResults();

        return view('admin/bookings', [
            'bookings'           => $bookings,
            'pendingCount'       => $pendingCount,
            'pendingVerifyCount' => $pendingVerifyCount,
            'totalBookings'      => $totalBookings,
            'totalPages'         => $totalPages,
            'currentPage'        => $page,
            'perPage'            => $perPage,
            'statusFilter'       => $statusFilter,
            'search'             => $search,
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
    //  UPDATE PAYMENT (mark down / full paid / reject receipt)
    // =========================================================
    public function updatePayment()
    {
        if ($r = $this->requireAdmin()) return $r;

        $bookingId     = (int) $this->request->getPost('booking_id');
        $paymentAction = $this->request->getPost('payment_action');

        if (! $bookingId || ! in_array($paymentAction, ['down_paid', 'full_paid', 'reject_receipt'])) {
            return redirect()->back()->with('error', 'Invalid payment request.');
        }

        $db = \Config\Database::connect();

        if ($paymentAction === 'down_paid') {
            $db->table('bookings')->where('id', $bookingId)->update([
                'down_payment_status'  => 'paid',
                'down_payment_paid_at' => date('Y-m-d H:i:s'),
                'updated_at'           => date('Y-m-d H:i:s'),
            ]);
            $ph = $db->table('payment_history')
                ->where('booking_id', $bookingId)
                ->orderBy('created_at', 'DESC')
                ->limit(1)->get()->getRowArray();
            if ($ph) {
                $db->table('payment_history')->where('id', $ph['id'])->update([
                    'is_verified' => 1,
                    'verified_by' => auth()->id(),
                    'verified_at' => date('Y-m-d H:i:s'),
                ]);
            }
            return redirect()->to(base_url('admin/bookings'))->with('success', '50% down payment marked as confirmed.');

        } elseif ($paymentAction === 'full_paid') {
            $db->table('bookings')->where('id', $bookingId)->update([
                'payment_status' => 'paid',
                'updated_at'     => date('Y-m-d H:i:s'),
            ]);
            $ph = $db->table('payment_history')
                ->where('booking_id', $bookingId)
                ->orderBy('created_at', 'DESC')
                ->limit(1)->get()->getRowArray();
            if ($ph) {
                $db->table('payment_history')->where('id', $ph['id'])->update([
                    'is_verified' => 1,
                    'verified_by' => auth()->id(),
                    'verified_at' => date('Y-m-d H:i:s'),
                ]);
            }
            return redirect()->to(base_url('admin/bookings'))->with('success', 'Booking marked as fully paid.');

        } elseif ($paymentAction === 'reject_receipt') {
            $db->table('payment_history')->where('booking_id', $bookingId)->delete();
            $db->table('bookings')->where('id', $bookingId)->update([
                'gcash_receipt' => null,
                'gcash_ref'     => null,
                'updated_at'    => date('Y-m-d H:i:s'),
            ]);
            return redirect()->to(base_url('admin/bookings'))->with('success', 'Receipt rejected. User can now re-upload.');
        }

        return redirect()->back()->with('error', 'Unknown action.');
    }

    // =========================================================
    //  VERIFY PAYMENT (legacy — kept for backward compat)
    // =========================================================
    public function verifyPayment()
    {
        if ($r = $this->requireAdmin()) return $r;

        $paymentId = (int) $this->request->getPost('payment_id');
        $bookingId = (int) $this->request->getPost('booking_id');
        $action    = $this->request->getPost('action');

        if (! $paymentId || ! $bookingId || ! in_array($action, ['approve', 'reject'])) {
            return redirect()->back()->with('error', 'Invalid verification request.');
        }

        $db = \Config\Database::connect();

        if ($action === 'approve') {
            $db->table('payment_history')->where('id', $paymentId)->update([
                'is_verified' => 1,
                'verified_by' => auth()->id(),
                'verified_at' => date('Y-m-d H:i:s'),
            ]);

            $ph = $db->table('payment_history')->where('id', $paymentId)->get()->getRowArray();

            if ($ph) {
                if ($ph['payment_type'] === 'full_payment') {
                    $db->table('bookings')->where('id', $bookingId)->update([
                        'payment_status' => 'paid',
                        'updated_at'     => date('Y-m-d H:i:s'),
                    ]);
                } elseif ($ph['payment_type'] === 'down_payment') {
                    $db->table('bookings')->where('id', $bookingId)->update([
                        'down_payment'         => $ph['amount'],
                        'down_payment_status'  => 'paid',
                        'down_payment_paid_at' => date('Y-m-d H:i:s'),
                        'updated_at'           => date('Y-m-d H:i:s'),
                    ]);
                }
            }

            return redirect()->to(base_url('admin/bookings'))->with('success', 'Payment approved and booking updated.');
        } else {
            $db->table('payment_history')->where('id', $paymentId)->delete();
            return redirect()->to(base_url('admin/bookings'))->with('success', 'Payment rejected.');
        }
    }

    // =========================================================
    //  USERS
    // =========================================================
    public function users()
    {
        if ($r = $this->requireAdmin()) return $r;

        $db      = \Config\Database::connect();
        $perPage = 12;
        $page    = (int)($this->request->getGet('page') ?? 1);
        $offset  = ($page - 1) * $perPage;

        $totalUsers = $db->table('users')->countAllResults();
        $totalPages = (int)ceil($totalUsers / $perPage);

        $users = $db->table('users u')
            ->select('
                u.id,
                u.username,
                u.created_at,
                u.last_active,
                MAX(ai.secret) AS email,
                MAX(ai.extra)  AS auth_extra,
                MAX(ag.group)  AS role,
                COUNT(b.id)    AS booking_count
            ')
            ->join('auth_identities ai',   'ai.user_id = u.id AND ai.type = "email_password"', 'left')
            ->join('auth_groups_users ag', 'ag.user_id = u.id', 'left')
            ->join('bookings b',           'b.user_id  = u.id', 'left')
            ->groupBy(['u.id', 'u.username', 'u.created_at', 'u.last_active'])
            ->orderBy('booking_count', 'DESC')
            ->orderBy('u.created_at', 'DESC')
            ->limit($perPage, $offset)
            ->get()->getResultArray();

        foreach ($users as &$user) {
            $extra = json_decode($user['auth_extra'] ?? '{}', true);
            $user['email_verified'] = $extra['email_verified'] ?? false;
        }

        return view('admin/users', [
            'users'      => $users,
            'totalUsers' => $totalUsers,
            'totalPages' => $totalPages,
            'currentPage'=> $page,
            'perPage'    => $perPage,
        ]);
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
            'wind_speed'     => 'required|numeric',
            'wave_height'    => 'required|numeric',
            'wave_period'    => 'required|numeric',
            'wind_direction' => 'required|string',
            'safety_status'  => 'required|in_list[safe,moderate,unsafe]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()
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

        return redirect()->to(base_url('admin/sea-conditions'))->with('success', 'Sea conditions updated successfully.');
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

        $avgRating = 0;
        if (count($reviews) > 0) {
            $avgRating = round(array_sum(array_column($reviews, 'rating')) / count($reviews), 1);
        }

        return view('admin/reviews', [
            'reviews'       => $reviews,
            'safeCount'     => $safeCount,
            'moderateCount' => $moderateCount,
            'avgRating'     => $avgRating,
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

        return redirect()->to(base_url('admin/reviews'))->with('success', 'Review deleted.');
    }

    // =========================================================
    //  ACTIVITIES
    // =========================================================
    public function activitiesPage()
    {
        if ($r = $this->requireAdmin()) return $r;

        $db = \Config\Database::connect();

        try {
            $activities = $db->table('activities')->orderBy('name', 'ASC')->get()->getResultArray();
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
            return redirect()->back()->withInput()
                             ->with('error', implode(' ', $this->validator->getErrors()));
        }

        $activityId = (int) $this->request->getPost('activity_id');

        $uploadedImages = [];
        $files = $this->request->getFiles();
        $imageFiles = $files['images'] ?? [];

        foreach ($imageFiles as $imgFile) {
            if ($imgFile && $imgFile->isValid() && ! $imgFile->hasMoved()) {
                $newName = $imgFile->getRandomName();
                $imgFile->move(ROOTPATH . 'public/images', $newName);
                $uploadedImages[] = $newName;
            }
        }

        $data = [
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description') ?: null,
            'price'       => (float) $this->request->getPost('price'),
            'duration'    => $this->request->getPost('duration') ?: null,
            'max_riders'  => $this->request->getPost('max_riders') ?: null,
            'difficulty'  => $this->request->getPost('difficulty') ?: 'Moderate',
            'gear'        => $this->request->getPost('gear') ?: null,
            'status'      => $this->request->getPost('status') ?: 'active',
            'price_type'  => $this->request->getPost('price_type') ?: 'flat',
            'updated_at'  => date('Y-m-d H:i:s'),
        ];

        $db = \Config\Database::connect();

        if ($activityId) {
            if (! empty($uploadedImages)) {
                $data['image']  = $uploadedImages[0];
                $data['images'] = json_encode(array_slice($uploadedImages, 1));
            }
            $db->table('activities')->where('id', $activityId)->update($data);
            $msg = 'Activity updated successfully.';
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            if (! empty($uploadedImages)) {
                $data['image']  = $uploadedImages[0];
                $data['images'] = json_encode(array_slice($uploadedImages, 1));
            }
            $db->table('activities')->insert($data);
            $msg = 'Activity added successfully.';
        }

        return redirect()->to(base_url('admin/activities'))->with('success', $msg);
    }

    public function deleteActivity()
    {
        if ($r = $this->requireAdmin()) return $r;

        $id = (int) $this->request->getPost('activity_id');
        if (! $id) {
            return redirect()->back()->with('error', 'Invalid activity.');
        }

        \Config\Database::connect()->table('activities')->where('id', $id)->delete();

        return redirect()->to(base_url('admin/activities'))->with('success', 'Activity deleted successfully.');
    }

    // =========================================================
    //  SALES
    // =========================================================
    public function sales()
    {
        if ($r = $this->requireAdmin()) return $r;

        $db = \Config\Database::connect();

        $sales = $db->table('bookings b')
            ->select('b.*, u.username')
            ->join('users u', 'u.id = b.user_id', 'left')
            ->whereIn('b.status', ['confirmed', 'completed'])
            ->orderBy('b.created_at', 'DESC')
            ->get()->getResultArray();

        $totalRevenue = array_sum(array_column($sales, 'total_amount'));

        return view('admin/sales', [
            'sales'        => $sales,
            'totalRevenue' => $totalRevenue,
        ]);
    }
}