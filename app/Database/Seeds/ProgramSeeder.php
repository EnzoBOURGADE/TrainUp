<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProgramSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Morning Routine',
                'id_user' => 1,
                'id_cat' => 1,
            ],
            [
                'name' => 'Strength Builder',
                'id_user' => 2,
                'id_cat' => 2,
            ],
            [
                'name' => 'Yoga Flow',
                'id_user' => 3,
                'id_cat' => 4,
            ],
            [
                'name' => 'HIIT Express',
                'id_user' => 4,
                'id_cat' => 5,
            ],
            [
                'name' => 'Core Focus',
                'id_user' => 5,
                'id_cat' => 4,
            ],
        ];

        $this->db->table('program')->insertBatch($data);
    }
}
