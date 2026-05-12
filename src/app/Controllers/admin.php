<?php

namespace App\Controllers;

use App\Models\BuoyDataModel;
use App\Libraries\BookingSafetyMonitor;
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

    private function sendBookingActionNotification(
        int $bookingId,
        string $subject,
        string $headline,
        string $message,
        array $extraDetails = [],
        bool $minimalDetails = false
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

            $baseDetails = [];
            
            if (! $minimalDetails) {
                $baseDetails = [
                    'Booking Code'        => (string) ($booking['booking_code'] ?? ('#' . $bookingId)),
                    'Schedule'            => $scheduleDate . ' at ' . $scheduleTime,
                    'Booking Status'      => ucfirst((string) ($booking['status'] ?? 'pending')),
                    'Payment Status'      => ucfirst((string) ($booking['payment_status'] ?? 'pending')),
                    'Down Payment Status' => ucfirst((string) ($booking['down_payment_status'] ?? 'pending')),
                ];

                if (! empty($booking['cancel_reason'])) {
                    $baseDetails['Cancellation Reason'] = (string) $booking['cancel_reason'];
                }
            } else {
                $baseDetails = [
                    'Booking Code' => (string) ($booking['booking_code'] ?? ('#' . $bookingId)),
                ];
            }

            foreach ($extraDetails as $label => $value) {
                if ($value === null || $value === '') {
                    continue;
                }
                $baseDetails[(string) $label] = (string) $value;
            }

            $detailHtml = '';
            foreach ($baseDetails as $label => $value) {
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

        $statusFilter = $this->request->getGet('status') ?? 'all';
        $search       = trim($this->request->getGet('search') ?? '');

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

        $totalBookings = $builder->countAllResults(false);
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

            if ($ph && !empty($ph['gcash_receipt'])) {
                $b['gcash_receipt']      = $ph['gcash_receipt'];
                $b['gcash_ref']          = $ph['gcash_ref'] ?? null;
                $b['gcash_submitted_at'] = $ph['created_at'] ?? null;
            } else {
                $b['gcash_receipt']      = null;
                $b['gcash_ref']          = null;
                $b['gcash_submitted_at'] = null;
            }

            $b['gcash_receipt_path'] = $b['gcash_receipt'] ?? null;
            $b['gcash_ref_no']       = $b['gcash_ref']     ?? null;

            // ── Fetch refund info for cancelled bookings that were paid ──
            $b['refund'] = null;
            $statusRaw   = strtolower($b['status'] ?? '');
            $wasPaid     = ($b['payment_status'] ?? '') === 'paid'
                        || ($b['down_payment_status'] ?? '') === 'paid';

            if ($statusRaw === 'cancelled' && $wasPaid) {
                try {
                    $refund = $db->table('booking_refunds')
                        ->where('booking_id', $b['id'])
                        ->orderBy('created_at', 'DESC')
                        ->limit(1)
                        ->get()->getRowArray();
                    $b['refund'] = $refund ?: null;
                } catch (\Exception $e) {
                    $b['refund'] = null;
                }
            }
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
                $dur   = $row ? (int)($row['duration'] ?? 60) : 60;
                $lineT = ($type === 'per_person') ? $price * $pax : $price;
                $lineItems[$an] = ['price' => $price, 'price_type' => $type, 'duration' => $dur, 'pax' => $pax, 'line_total' => $lineT];
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

    // =========================================================
    //  UPDATE BOOKING STATUS
    // =========================================================
    public function updateBookingStatus()
    {
        if ($r = $this->requireAdmin()) return $r;

        $id           = (int) $this->request->getPost('id');
        $status       = $this->request->getPost('status');
        $cancelReason = trim((string) ($this->request->getPost('cancel_reason') ?? ''));

        $allowed = ['confirmed', 'completed', 'cancelled'];
        if (! $id || ! in_array($status, $allowed)) {
            return redirect()->back()->with('error', 'Invalid request.');
        }

        $db = \Config\Database::connect();
        $updateData = [
            'status'     => $status,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Prevent marking as completed if the booking's scheduled datetime hasn't passed yet
        if ($status === 'completed') {
            $booking = $db->table('bookings')->where('id', $id)->get()->getRowArray();
            if ($booking) {
                $bookDt = strtotime(($booking['date'] ?? '') . ' ' . ($booking['time'] ?? ''));
                if ($bookDt === false || $bookDt > time()) {
                    return redirect()->back()->with('error', 'Cannot mark booking as completed before its scheduled date/time has passed.');
                }
            }
        }

        if ($status === 'cancelled') {
            $updateData['cancel_reason'] = $cancelReason !== '' ? $cancelReason : 'Cancelled by admin';
        } else {
            $updateData['cancel_reason'] = null;
        }

        $db->table('bookings')->where('id', $id)->update($updateData);

        // ── If cancelled and booking had any payment, create a pending refund record ──
        if ($status === 'cancelled') {
            $booking = $db->table('bookings')->where('id', $id)->get()->getRowArray();
            if ($booking) {
                $wasPaid = ($booking['payment_status'] ?? '') === 'paid'
                        || ($booking['down_payment_status'] ?? '') === 'paid';

                if ($wasPaid) {
                    try {
                        $existing = $db->table('booking_refunds')
                            ->where('booking_id', $id)
                            ->get()->getRowArray();

                        if (! $existing) {
                            // Use actual down_payment column value if set, else half of total
                            $downAmt = (float)($booking['down_payment'] ?? 0);
                            $refundAmount = ($booking['payment_status'] === 'paid')
                                ? (float)($booking['total_amount'] ?? 0)
                                : ($downAmt > 0
                                    ? $downAmt
                                    : round((float)($booking['total_amount'] ?? 0) * 0.5, 2));

                            $db->table('booking_refunds')->insert([
                                'booking_id'    => $id,
                                'refund_amount' => $refundAmount,
                                'refund_status' => 'pending',
                                'refund_note'   => 'Auto-created on cancellation. Admin must process and upload GCash proof.',
                                'created_by'    => auth()->id(),
                                'created_at'    => date('Y-m-d H:i:s'),
                                'updated_at'    => date('Y-m-d H:i:s'),
                            ]);
                        }
                    } catch (\Exception $e) {
                        log_message('error', 'booking_refunds insert failed: ' . $e->getMessage());
                    }
                }
            }
        }

        if ($status === 'confirmed') {
            $this->sendBookingActionNotification(
                $id,
                'Booking Confirmed by Admin',
                'Your booking has been confirmed',
                'Our admin team has confirmed your booking request. Please proceed with payment if still pending.'
            );
        } elseif ($status === 'completed') {
            $this->sendBookingActionNotification(
                $id,
                'Booking Completed',
                'Your booking is now marked completed',
                'Our admin team has marked your booking as completed. Thank you for choosing Waves Water Sports.'
            );
        } elseif ($status === 'cancelled') {
            $this->sendBookingActionNotification(
                $id,
                'Booking Cancelled by Admin',
                'Your booking has been cancelled',
                'Our admin team cancelled your booking. Please review the details below.',
                ['Cancellation Reason' => $cancelReason !== '' ? $cancelReason : 'Cancelled by admin']
            );
        }

        return redirect()->to(base_url('admin/bookings'))
                         ->with('success', 'Booking status updated to ' . ucfirst($status) . '.');
    }

    // =========================================================
    //  PROCESS REFUND — admin uploads GCash proof receipt
    // =========================================================
    public function processRefund()
    {
        if ($r = $this->requireAdmin()) return $r;

        $bookingId  = (int) $this->request->getPost('booking_id');
        $refundId   = (int) $this->request->getPost('refund_id'); // may be 0 if record was never created
        $gcashRef   = trim((string) ($this->request->getPost('gcash_ref') ?? ''));
        $refundNote = trim((string) ($this->request->getPost('refund_note') ?? ''));

        if (! $bookingId) {
            return redirect()->back()->with('error', 'Invalid refund request.');
        }

        $db = \Config\Database::connect();

        // ── Handle receipt upload ──
        $receiptFile     = $this->request->getFile('refund_receipt');
        $receiptFilename = null;

        if ($receiptFile && $receiptFile->isValid() && ! $receiptFile->hasMoved()) {
            $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if (! in_array($receiptFile->getMimeType(), $allowed)) {
                return redirect()->back()->with('error', 'Receipt must be an image file (JPG, PNG, GIF, WEBP).');
            }
            if ($receiptFile->getSize() > 5 * 1024 * 1024) {
                return redirect()->back()->with('error', 'Receipt image must be under 5MB.');
            }
            $newName = $receiptFile->getRandomName();
            $receiptFile->move(ROOTPATH . 'public/uploads/gcash_receipts', $newName);
            $receiptFilename = $newName;
        }

        if (! $receiptFilename) {
            return redirect()->back()->with('error', 'Please upload a GCash receipt screenshot.');
        }

        // ── Fetch booking to compute actual refund amount ──
        $booking = $db->table('bookings')->where('id', $bookingId)->get()->getRowArray();
        if (! $booking) {
            return redirect()->back()->with('error', 'Booking not found.');
        }

        // Refund = what was actually paid, not always the full total
        $downAmt = (float)($booking['down_payment'] ?? 0);
        $refundAmount = ($booking['payment_status'] === 'paid')
            ? (float)($booking['total_amount'] ?? 0)
            : ($downAmt > 0
                ? $downAmt
                : round((float)($booking['total_amount'] ?? 0) * 0.5, 2));

        // ── Upsert: try by refund_id first, then by booking_id, then create fresh ──
        $existingRefund = null;

        if ($refundId > 0) {
            $existingRefund = $db->table('booking_refunds')
                ->where('id', $refundId)
                ->where('booking_id', $bookingId)
                ->get()->getRowArray();
        }

        if (! $existingRefund) {
            $existingRefund = $db->table('booking_refunds')
                ->where('booking_id', $bookingId)
                ->orderBy('created_at', 'DESC')
                ->limit(1)
                ->get()->getRowArray();
        }

        $updateData = [
            'refund_status'  => 'processed',
            'refund_amount'  => $refundAmount,
            'gcash_ref'      => $gcashRef ?: null,
            'refund_note'    => $refundNote ?: null,
            'refund_receipt' => $receiptFilename,
            'processed_by'   => auth()->id(),
            'processed_at'   => date('Y-m-d H:i:s'),
            'updated_at'     => date('Y-m-d H:i:s'),
        ];

        if ($existingRefund) {
            $db->table('booking_refunds')
                ->where('id', $existingRefund['id'])
                ->update($updateData);
        } else {
            // No record exists at all — create it and mark as processed in one shot
            $db->table('booking_refunds')->insert(array_merge($updateData, [
                'booking_id' => $bookingId,
                'created_by' => auth()->id(),
                'created_at' => date('Y-m-d H:i:s'),
            ]));
        }

        $this->sendBookingActionNotification(
            $bookingId,
            'Refund Processed for Your Booking',
            'Your booking refund has been processed',
            'Our admin team has processed your refund and uploaded the GCash proof on your booking details.',
            [
                'Refund Amount' => 'PHP ' . number_format($refundAmount, 2),
                'GCash Reference' => $gcashRef ?: 'N/A',
                'Refund Note' => $refundNote ?: null,
            ],
            true
        );

        return redirect()->to(base_url('admin/bookings'))
            ->with('success', 'Refund marked as processed. GCash proof has been saved and the guest can now view it.');
    }

    // =========================================================
    //  UPDATE PAYMENT
    //  Actions: down_paid | half_paid | full_paid | reject_receipt
    // =========================================================
    public function updatePayment()
    {
        if ($r = $this->requireAdmin()) return $r;

        $isAjax       = $this->request->isAJAX();
        $bookingId     = (int) $this->request->getPost('booking_id');
        $paymentAction = $this->request->getPost('payment_action');

        $allowedActions = ['down_paid', 'half_paid', 'full_paid', 'reject_receipt'];
        if (! $bookingId || ! in_array($paymentAction, $allowedActions)) {
            if ($isAjax) {
                return $this->response->setStatusCode(400)->setJSON([
                    'ok'         => false,
                    'message'    => 'Invalid payment request.',
                    'csrf_hash'  => csrf_hash(),
                    'csrf_token' => csrf_token(),
                ]);
            }

            return redirect()->back()->with('error', 'Invalid payment request.');
        }

        $db = \Config\Database::connect();

        // ── Mark 50% Down Paid (from receipt verification) ──
        if ($paymentAction === 'down_paid') {
            $booking = $db->table('bookings')->where('id', $bookingId)->get()->getRowArray();
            if (! $booking) {
                if ($isAjax) {
                    return $this->response->setStatusCode(404)->setJSON([
                        'ok'         => false,
                        'message'    => 'Booking not found.',
                        'csrf_hash'  => csrf_hash(),
                        'csrf_token' => csrf_token(),
                    ]);
                }

                return redirect()->back()->with('error', 'Booking not found.');
            }

            $halfAmount = round((float)($booking['total_amount'] ?? 0) / 2, 2);

            $db->table('bookings')->where('id', $bookingId)->update([
                'down_payment'         => $halfAmount,
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

            $this->sendBookingActionNotification(
                $bookingId,
                'Down Payment Confirmed',
                'Your down payment was confirmed',
                'Our admin team verified your receipt and confirmed your 50% down payment.'
            );

            if ($isAjax) {
                return $this->response->setJSON([
                    'ok'            => true,
                    'message'       => '50% down payment confirmed successfully.',
                    'booking_id'    => $bookingId,
                    'payment_action'=> $paymentAction,
                    'csrf_hash'     => csrf_hash(),
                    'csrf_token'    => csrf_token(),
                ]);
            }

            return redirect()->to(base_url('admin/bookings'))
                ->with('success', '50% down payment confirmed successfully.');

        // ── Mark as Half Paid (manual — admin override, no receipt required) ──
        } elseif ($paymentAction === 'half_paid') {
            $booking = $db->table('bookings')->where('id', $bookingId)->get()->getRowArray();
            if (! $booking) {
                if ($isAjax) {
                    return $this->response->setStatusCode(404)->setJSON([
                        'ok'         => false,
                        'message'    => 'Booking not found.',
                        'csrf_hash'  => csrf_hash(),
                        'csrf_token' => csrf_token(),
                    ]);
                }

                return redirect()->back()->with('error', 'Booking not found.');
            }

            // Prevent duplicate approval
            if ($booking['down_payment_status'] === 'paid') {
                if ($isAjax) {
                    return $this->response->setStatusCode(409)->setJSON([
                        'ok'         => false,
                        'message'    => 'This booking has already been approved as 50% paid.',
                        'csrf_hash'  => csrf_hash(),
                        'csrf_token' => csrf_token(),
                    ]);
                }

                return redirect()->to(base_url('admin/bookings'))
                    ->with('error', 'This booking has already been approved as 50% paid.');
            }

            $halfAmount = round((float)($booking['total_amount'] ?? 0) / 2, 2);

            $db->table('bookings')->where('id', $bookingId)->update([
                'down_payment'         => $halfAmount,
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
                    'amount'       => $halfAmount,
                    'payment_type' => 'down_payment',
                    'is_verified'  => 1,
                    'verified_by'  => auth()->id(),
                    'verified_at'  => date('Y-m-d H:i:s'),
                ]);
            } else {
                $db->table('payment_history')->insert([
                    'booking_id'   => $bookingId,
                    'amount'       => $halfAmount,
                    'payment_type' => 'down_payment',
                    'gcash_ref'    => 'MANUAL-ADMIN',
                    'is_verified'  => 1,
                    'verified_by'  => auth()->id(),
                    'verified_at'  => date('Y-m-d H:i:s'),
                    'created_at'   => date('Y-m-d H:i:s'),
                ]);
            }

            $this->sendBookingActionNotification(
                $bookingId,
                'Down Payment Marked as Paid',
                'Your booking payment was updated',
                'Our admin team marked your booking as 50% paid.'
            );

            if ($isAjax) {
                return $this->response->setJSON([
                    'ok'            => true,
                    'message'       => 'Booking marked as 50% (half) paid.',
                    'booking_id'    => $bookingId,
                    'payment_action'=> $paymentAction,
                    'csrf_hash'     => csrf_hash(),
                    'csrf_token'    => csrf_token(),
                ]);
            }

            return redirect()->to(base_url('admin/bookings'))
                ->with('success', 'Booking marked as 50% (half) paid.');

        // ── Mark as Fully Paid ──
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
                    'payment_type' => 'full_payment',
                    'is_verified'  => 1,
                    'verified_by'  => auth()->id(),
                    'verified_at'  => date('Y-m-d H:i:s'),
                ]);
            }

            $this->sendBookingActionNotification(
                $bookingId,
                'Booking Fully Paid',
                'Your booking is now fully paid',
                'Our admin team marked your booking payment as fully paid.'
            );

            if ($isAjax) {
                return $this->response->setJSON([
                    'ok'            => true,
                    'message'       => 'Booking marked as fully paid.',
                    'booking_id'    => $bookingId,
                    'payment_action'=> $paymentAction,
                    'csrf_hash'     => csrf_hash(),
                    'csrf_token'    => csrf_token(),
                ]);
            }

            return redirect()->to(base_url('admin/bookings'))
                ->with('success', 'Booking marked as fully paid.');

        // ── Reject Receipt ──
        } elseif ($paymentAction === 'reject_receipt') {
            $db->table('payment_history')->where('booking_id', $bookingId)->delete();

            $db->table('bookings')->where('id', $bookingId)->update([
                'payment_status'      => 'pending',
                'down_payment_status' => 'pending',
                'down_payment'        => 0,
                'updated_at'          => date('Y-m-d H:i:s'),
            ]);

            $this->sendBookingActionNotification(
                $bookingId,
                'Receipt Rejected by Admin',
                'Your payment receipt was rejected',
                'Our admin team rejected your submitted payment receipt. Please upload a valid GCash receipt for verification.'
            );

            if ($isAjax) {
                return $this->response->setJSON([
                    'ok'            => true,
                    'message'       => 'Receipt rejected. The guest may now re-upload a valid receipt.',
                    'booking_id'    => $bookingId,
                    'payment_action'=> $paymentAction,
                    'csrf_hash'     => csrf_hash(),
                    'csrf_token'    => csrf_token(),
                ]);
            }

            return redirect()->to(base_url('admin/bookings'))
                ->with('success', 'Receipt rejected. The guest may now re-upload a valid receipt.');
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
                    $halfAmount = round((float)($ph['amount'] ?? 0), 2);
                    $db->table('bookings')->where('id', $bookingId)->update([
                        'down_payment'         => $halfAmount,
                        'down_payment_status'  => 'paid',
                        'down_payment_paid_at' => date('Y-m-d H:i:s'),
                        'updated_at'           => date('Y-m-d H:i:s'),
                    ]);
                }
            }

            $this->sendBookingActionNotification(
                $bookingId,
                'Payment Approved by Admin',
                'Your payment has been approved',
                'Our admin team approved your payment and updated your booking payment records.'
            );

            return redirect()->to(base_url('admin/bookings'))->with('success', 'Payment approved and booking updated.');
        } else {
            $db->table('payment_history')->where('id', $paymentId)->delete();
            $this->sendBookingActionNotification(
                $bookingId,
                'Payment Rejected by Admin',
                'Your payment was rejected',
                'Our admin team rejected your payment record. Please resubmit a valid payment receipt.'
            );
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
            'users'       => $users,
            'totalUsers'  => $totalUsers,
            'totalPages'  => $totalPages,
            'currentPage' => $page,
            'perPage'     => $perPage,
        ]);
    }

    // =========================================================
    //  SEA CONDITIONS
    // =========================================================
    public function seaConditions()
    {
        if ($r = $this->requireAdmin()) return $r;

        $buoyModel   = new BuoyDataModel();
        $latestBuoy  = $buoyModel->getLatestReading();
        $buoyHistory = $buoyModel->getRecentReadings(40);
        if (! is_array($buoyHistory)) {
            $buoyHistory = [];
        }
        if (empty($latestBuoy) && ! empty($buoyHistory)) {
            $latestBuoy = $buoyHistory[0];
        }

        return view('admin/sea_conditions', [
            'latestBuoy'  => $latestBuoy,
            'buoyData'    => $latestBuoy,
            'buoyHistory' => $buoyHistory,
        ]);
    }

    public function updateSeaConditions()
    {
        if ($r = $this->requireAdmin()) return $r;
        return redirect()->to(base_url('admin/sea-conditions'))
            ->with('error', 'Manual sea condition updates are disabled. Live data now comes from buoy_data only.');
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
        $files          = $this->request->getFiles();
        $imageFiles     = $files['images'] ?? [];

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

    // =========================================================
    //  WALK-IN BOOKING
    // =========================================================
    public function checkBookingBlocked()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(400);
        }

        if (! auth()->user() || ! auth()->user()->inGroup('admin')) {
            return $this->response->setJSON(['blocked' => false]);
        }

        $safetyMonitor = new BookingSafetyMonitor();
        $requestedDate = trim((string) ($this->request->getGet('date') ?? ''));
        $isBlocked     = $safetyMonitor->isBookingBlocked();
        $allowedFrom   = $safetyMonitor->getUnsafeBookingAllowedFromDate();

        if ($isBlocked && $requestedDate !== '' && $safetyMonitor->canBookForDate($requestedDate)) {
            return $this->response->setJSON([
                'blocked'      => false,
                'message'      => '',
                'unsafe_now'   => true,
                'allowed_from' => $allowedFrom,
            ]);
        }

        return $this->response->setJSON([
            'blocked'      => $isBlocked,
            'message'      => $isBlocked
                ? 'Unsafe sea conditions are active. Bookings for today are paused. You can still create bookings from ' . $allowedFrom . ' onward.'
                : '',
            'unsafe_now'   => $isBlocked,
            'allowed_from' => $allowedFrom,
        ]);
    }

    public function createWalkInBooking()
    {
        if ($r = $this->requireAdmin()) return $r;

        $db            = \Config\Database::connect();
        $safetyMonitor = new BookingSafetyMonitor();

        $rules = [
            'activity_name'    => 'required|string',
            'date'             => 'required|valid_date[Y-m-d]',
            'time'             => 'required|regex_match[/^\d{2}:\d{2}$/]',
            'participants'     => 'required|integer|greater_than[0]|less_than_equal_to[20]',
            'contact_number'   => 'required|string|max_length[20]',
            'special_requests' => 'permit_empty|string|max_length[500]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->to(base_url('admin/bookings'))
                ->with('error', implode(' ', $this->validator->getErrors()));
        }

        $activityName    = trim($this->request->getPost('activity_name'));
        $date            = trim($this->request->getPost('date'));
        $time            = trim($this->request->getPost('time'));
        $participants    = (int) $this->request->getPost('participants');
        $contactNumber   = trim($this->request->getPost('contact_number'));
        $specialRequests = trim($this->request->getPost('special_requests') ?? '');

        if (! $safetyMonitor->canBookForDate($date)) {
            return redirect()->to(base_url('admin/bookings'))
                ->with('error', 'Unsafe sea conditions are active. Bookings for today are paused. You can still create bookings from ' . $safetyMonitor->getUnsafeBookingAllowedFromDate() . ' onward.');
        }

        $activity = $db->table('activities')
            ->where('name', $activityName)
            ->where('status', 'active')
            ->get()->getRowArray();

        if (! $activity) {
            return redirect()->to(base_url('admin/bookings'))
                ->with('error', 'Invalid or inactive activity selected.');
        }

        $price       = (float)($activity['price'] ?? 0);
        $priceType   = $activity['price_type'] ?? 'flat';
        $totalAmount = ($priceType === 'per_person') ? $price * $participants : $price;
        $downPayment = round($totalAmount * 0.5, 2);

        // Generate a unique booking code
        do {
            $bookingCode = 'WI-' . strtoupper(substr(md5(uniqid((string)mt_rand(), true)), 0, 8));
        } while ($db->table('bookings')->where('booking_code', $bookingCode)->countAllResults() > 0);

        $bookingData = [
            'user_id'             => 0,
            'booking_code'        => $bookingCode,
            'activity_id'         => (int)$activity['id'],
            'activity_name'       => $activityName,
            'all_activities'      => $activityName,
            'date'                => $date,
            'time'                => $time . ':00',
            'participants'        => $participants,
            'contact_number'      => $contactNumber,
            'special_requests'    => $specialRequests ?: null,
            'booking_type'        => 'walk_in',
            'total_amount'        => $totalAmount,
            'down_payment'        => 0,
            'down_payment_status' => 'pending',
            'status'              => 'confirmed',
            'payment_status'      => 'pending',
            'created_at'          => date('Y-m-d H:i:s'),
            'updated_at'          => date('Y-m-d H:i:s'),
        ];

        try {
            $db->table('bookings')->insert($bookingData);
            $insertedId = $db->insertID();

            if (! $insertedId) {
                return redirect()->to(base_url('admin/bookings'))
                    ->with('error', 'Walk-in booking could not be saved. Please check your database and try again.');
            }
        } catch (\Exception $e) {
            log_message('error', 'Walk-in booking insert failed: ' . $e->getMessage());
            return redirect()->to(base_url('admin/bookings'))
                ->with('error', 'Walk-in booking failed: ' . $e->getMessage());
        }

        $this->sendBookingActionNotification(
            (int) $insertedId,
            'Booking Created by Admin',
            'A booking was created for you',
            'Our admin team created a booking record under your account.',
            [
                'Booking Type' => 'Walk-In',
                'Total Amount' => 'PHP ' . number_format((float) $totalAmount, 2),
            ]
        );

        return redirect()->to(base_url('admin/bookings'))
            ->with('success', 'Walk-in booking created successfully! Code: ' . $bookingCode . ' — Total: ₱' . number_format($totalAmount, 2));
    }
}
