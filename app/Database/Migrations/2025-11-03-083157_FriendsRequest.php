<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FriendsRequest extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'requester_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'constraint' => 20,
                'null' => false,
            ],
            'receiver_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'constraint' => 20,
                'null' => false,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('requester_id', 'user', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('receiver_id', 'user', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('friends-request');
    }

    public function down()
    {
        $this->forge->dropTable('friends-request');
    }
}
