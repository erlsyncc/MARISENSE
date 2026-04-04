<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateActivitiesTable extends Migration
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
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'price' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => '0.00',
            ],
            'duration' => [
                'type'     => 'INT',
                'null'     => true,
                'comment'  => 'in minutes',
            ],
            'max_riders' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'difficulty' => [
                'type'       => 'ENUM',
                'constraint' => ['Easy', 'Moderate', 'Hard'],
                'default'    => 'Moderate',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['active', 'paused'],
                'default'    => 'active',
            ],
            'image' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
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
        $this->forge->createTable('activities');

        // Seed the 4 default activities
        $this->db->table('activities')->insertBatch([
            ['name' => 'Jet Ski',       'price' => 2500, 'duration' => 15,  'max_riders' => '1–2 persons',  'difficulty' => 'Moderate', 'status' => 'active', 'image' => 'jetski.jpg',      'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Banana Boat',   'price' => 500,  'duration' => 10,  'max_riders' => 'Up to 12',     'difficulty' => 'Easy',     'status' => 'active', 'image' => 'bananaboats.jpg', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Kayaking',      'price' => 300,  'duration' => 30,  'max_riders' => '1–2 persons',  'difficulty' => 'Easy',     'status' => 'active', 'image' => 'kayak.jpg',       'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Flying Saucer', 'price' => 600,  'duration' => 10,  'max_riders' => 'Up to 10',     'difficulty' => 'Moderate', 'status' => 'active', 'image' => 'flying.jpg',      'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('activities');
    }
}
