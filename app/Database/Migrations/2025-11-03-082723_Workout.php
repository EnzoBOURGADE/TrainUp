<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Workout extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_exercices' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 20,
                'null' => false,
            ],
            'id_program' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 20,
                'null' => false,
            ],
            'date' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'rest_time' => [
                'type' => 'TIME',
                'null' => false,
            ],
            'order' => [
                'type' => 'INT',
                'constraint' => 20,
                'null' => false,
            ]
        ]);
        $this->forge->addForeignKey('id_exercices', 'exercices', 'id');
        $this->forge->addForeignKey('id_program', 'program', 'id',);
        $this->forge->createTable('workout');
    }

    public function down()
    {
        $this->forge->dropTable('workout');
    }
}
