<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSeaConditionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'wind_speed' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
            ],
            'wind_direction' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'wave_height' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
            ],
            'wave_period' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
            ],
            'temperature' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'null'       => true,
            ],
            'safety_status' => [
                'type'       => 'ENUM',
                'constraint' => ['safe', 'moderate', 'unsafe'],
                'default'    => 'safe',
            ],
            'notes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'updated_by' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
            ],
            'recorded_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('sea_conditions');
    }

    public function down()
    {
        $this->forge->dropTable('sea_conditions');
    }
}
