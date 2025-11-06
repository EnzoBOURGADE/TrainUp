<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Friends extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user_1' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'constraint' => 20,
                'null' => false,
            ],
            'id_user_2' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'constraint' => 20,
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_user_1', 'user', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('id_user_2', 'user', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('friends');
    }

    public function down()
    {
        $this->forge->dropTable('friends');
    }
}
