<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Program extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 20,
                'unsigned' => true,
                'null' => false,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
                'unique' => true,
            ],
            'id_user' => [
                'type' => 'INT',
                'constraint' => 20,
                'unsigned' => true,
                'null' => false,
            ],
            'id_cat' => [
                'type' => 'INT',
                'constraint' => 20,
                'unsigned' => true,
                'null' => false,
            ]
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey('id_user', 'user', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('id_cat', 'categories_prgm', 'id', 'CASCADE', 'RESTRICT');

        $this->forge->createTable('program');
    }

    public function down()
    {
        $this->forge->dropTable('program');
    }
}
