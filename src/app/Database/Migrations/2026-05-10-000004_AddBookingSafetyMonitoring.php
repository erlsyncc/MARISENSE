<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBookingSafetyMonitoring extends Migration
{
    public function up()
    {
        if (! $this->db->fieldExists('cancel_reason', 'bookings')) {
            $this->forge->addColumn('bookings', [
                'cancel_reason' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => true,
                    'after'      => 'status',
                ],
            ]);
        }

        if (! $this->db->tableExists('sea_safety_state')) {
            $this->forge->addField([
                'id' => [
                    'type'       => 'TINYINT',
                    'constraint' => 1,
                    'unsigned'   => true,
                ],
                'status' => [
                    'type'       => 'ENUM',
                    'constraint' => ['safe', 'unsafe'],
                    'default'    => 'safe',
                ],
                'booking_blocked' => [
                    'type'       => 'TINYINT',
                    'constraint' => 1,
                    'unsigned'   => true,
                    'default'    => 0,
                ],
                'last_unsafe_confirmed_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
                'last_safe_confirmed_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
                'last_wave_height' => [
                    'type'       => 'DECIMAL',
                    'constraint' => '6,2',
                    'null'       => true,
                ],
                'last_wind_speed' => [
                    'type'       => 'DECIMAL',
                    'constraint' => '6,2',
                    'null'       => true,
                ],
                'created_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
                'updated_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->createTable('sea_safety_state');
        }

        if (! $this->db->tableExists('sea_safety_events')) {
            $this->forge->addField([
                'id' => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true,
                ],
                'event_type' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 64,
                ],
                'message' => [
                    'type' => 'TEXT',
                    'null' => true,
                ],
                'wave_height' => [
                    'type'       => 'DECIMAL',
                    'constraint' => '6,2',
                    'null'       => true,
                ],
                'wind_speed' => [
                    'type'       => 'DECIMAL',
                    'constraint' => '6,2',
                    'null'       => true,
                ],
                'threshold_wave_height' => [
                    'type'       => 'DECIMAL',
                    'constraint' => '6,2',
                    'default'    => '1.20',
                ],
                'threshold_wind_speed' => [
                    'type'       => 'DECIMAL',
                    'constraint' => '6,2',
                    'default'    => '20.00',
                ],
                'consecutive_packets' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'unsigned'   => true,
                    'default'    => 0,
                ],
                'duration_seconds' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'unsigned'   => true,
                    'default'    => 0,
                ],
                'affected_bookings' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'unsigned'   => true,
                    'default'    => 0,
                ],
                'details' => [
                    'type' => 'LONGTEXT',
                    'null' => true,
                ],
                'created_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->addKey(['event_type', 'created_at'], false, false, 'idx_event_type_created_at');
            $this->forge->addKey('created_at');
            $this->forge->createTable('sea_safety_events');
        }

        $existingState = $this->db->table('sea_safety_state')
            ->where('id', 1)
            ->countAllResults();

        if ($existingState === 0) {
            $now = date('Y-m-d H:i:s');
            $this->db->table('sea_safety_state')->insert([
                'id'              => 1,
                'status'          => 'safe',
                'booking_blocked' => 0,
                'created_at'      => $now,
                'updated_at'      => $now,
            ]);
        }
    }

    public function down()
    {
        if ($this->db->tableExists('sea_safety_events')) {
            $this->forge->dropTable('sea_safety_events');
        }

        if ($this->db->tableExists('sea_safety_state')) {
            $this->forge->dropTable('sea_safety_state');
        }

        if ($this->db->fieldExists('cancel_reason', 'bookings')) {
            $this->forge->dropColumn('bookings', 'cancel_reason');
        }
    }
}
