<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FriendsRequestSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['requester_id' => 1, 'receiver_id' => 2],
            ['requester_id' => 2, 'receiver_id' => 3],
            ['requester_id' => 3, 'receiver_id' => 4],
            ['requester_id' => 4, 'receiver_id' => 5],
            ['requester_id' => 5, 'receiver_id' => 1],
        ];

        $this->db->table('friends_request')->insertBatch($data);
    }
}
