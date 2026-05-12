<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRemainingBalanceToPaymentHistory extends Migration
{
    public function up(): void
    {
        // Allow payment_type to hold 'down_payment' | 'remaining_balance' | 'full_payment'
        // Add per-row amount_due so admin can see what was expected vs what was uploaded
        $fields = [
            'amount_due' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => true,
                'after'      => 'amount',
                'comment'    => 'Amount that was expected for this payment leg',
            ],
            'payment_sequence' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
                'after'      => 'payment_type',
                'comment'    => '1 = first payment, 2 = second/remaining',
            ],
        ];

        $this->forge->addColumn('payment_history', $fields);

        // Update any existing 'full_remaining' values to canonical name
        $this->db->query("UPDATE payment_history SET payment_type = 'remaining_balance' WHERE payment_type IN ('remaining','full_remaining')");

        // Add a booking_payment_status column to bookings so we can track
        // 'unpaid' | 'half_paid' | 'second_pending' | 'paid'
        // without overloading the existing payment_status / down_payment_status fields
        if (!$this->db->fieldExists('booking_payment_stage', 'bookings')) {
            $this->forge->addColumn('bookings', [
                'booking_payment_stage' => [
                    'type'       => 'ENUM',
                    'constraint' => ['unpaid', 'half_paid', 'second_pending', 'paid'],
                    'default'    => 'unpaid',
                    'null'       => false,
                    'after'      => 'payment_status',
                ],
            ]);
        }

        // Back-fill booking_payment_stage from existing data
        $this->db->query("
            UPDATE bookings SET booking_payment_stage =
                CASE
                    WHEN payment_status = 'paid'                             THEN 'paid'
                    WHEN down_payment_status = 'paid' AND payment_status <> 'paid' THEN 'half_paid'
                    ELSE 'unpaid'
                END
        ");
    }

    public function down(): void
    {
        $this->forge->dropColumn('payment_history', ['amount_due', 'payment_sequence']);
        $this->forge->dropColumn('bookings', 'booking_payment_stage');
    }
}
