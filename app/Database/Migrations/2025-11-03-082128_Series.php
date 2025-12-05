<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Series extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_program' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 20,
                'null' => false,
            ],
            'id_exercices' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 20,
                'null' => false,
            ],
            'reps' => [
                'type' => 'INT',
                'null' => false,
            ],
            'weight' => [
                'type' => 'DECIMAL',
                'null' => false,
            ],
            'date' => [
                'type' => 'DATE',
                'null' => false,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_program', 'program', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('id_exercices', 'exercices', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('series');
    }

    public function down()
    {
        $this->forge->dropTable('series');
    }
}
