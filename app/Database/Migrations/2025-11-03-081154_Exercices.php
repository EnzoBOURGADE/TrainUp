<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Exercices extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'null' => false,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
                'unique' => true,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => false,
                'unique' => true,
            ],
            'rest_time' => [
                'type' => 'INT',
                'null' => false,
                'unique' => true,
            ],
            'reps' => [
                'type' => 'INT',
                'null' => false,
                'unique' => true,
            ],
            'nber_series' => [
                'type' => 'INT',
                'null' => false,
                'unique' => true,
            ],
            'time_series' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'id_cat' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'constraint' => '20',
                'null' => false,
            ],
            'id_muscles' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'constraint' => '20',
                'null' => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_cat', 'categories', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('id_muscles', 'muscles', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('exercices');
    }

    public function down()
    {
        $this->forge->dropTable('exercices');
    }
}
