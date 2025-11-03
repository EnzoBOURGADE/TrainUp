<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Workout extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_exercices' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => false,
            ],
            'id_program' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => false,
            ],
            'date' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'rest_time' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'order' => [
                'type' => 'INT',
                'constraint' => 20,
                'null' => false,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_exercices', 'exercices', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('id_program', 'program', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('workout');
    }

    public function down()
    {
        $this->forge->dropTable('workout');
    }
}
