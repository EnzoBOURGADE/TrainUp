<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FriendsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_user_1' => 1,
                'id_user_2' => 3,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id_user_1' => 2,
                'id_user_2' => 4,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id_user_1' => 3,
                'id_user_2' => 5,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id_user_1' => 4,
                'id_user_2' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id_user_1' => 5,
                'id_user_2' => 2,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('friends')->insertBatch($data);
    }
}
