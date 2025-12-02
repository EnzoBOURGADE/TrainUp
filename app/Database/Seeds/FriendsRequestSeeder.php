<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FriendsRequestSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['requester_id' => 1, 'receiver_id' => 2]
        ];

        $this->db->table('friends-request')->insertBatch($data);
    }
}
