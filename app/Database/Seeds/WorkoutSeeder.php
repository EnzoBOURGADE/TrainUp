<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class WorkoutSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_exercices' => 1,
                'id_program' => 1,
                'date' => '2025-10-16',
                'rest_time' => '00:01:00',
                'order' => 1,
            ],
            [
                'id_exercices' => 2,
                'id_program' => 1,
                'date' => '2025-10-16',
                'rest_time' => '00:01:30',
                'order' => 2,
            ],
            [
                'id_exercices' => 3,
                'id_program' => 2,
                'date' => '2025-09-25',
                'rest_time' => '00:02:00',
                'order' => 1,
            ],
            [
                'id_exercices' => 4,
                'id_program' => 2,
                'date' => '2025-09-25',
                'rest_time' => '00:00:45',
                'order' => 2,
            ],
            [
                'id_exercices' => 5,
                'id_program' => 3,
                'date' => '2025-04-03',
                'rest_time' => '00:01:00',
                'order' => 1,
            ],
        ];

        $this->db->table('workout')->insertBatch($data);
    }
}
