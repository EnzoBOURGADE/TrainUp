<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeriesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_program' => 1,
                'id_exercices' => 1,
                'reps' => 15,
                'weight' => 0,
                'date' => '2025-10-16',
            ],
            [
                'id_program' => 1,
                'id_exercices' => 2,
                'reps' => 12,
                'weight' => 0,
                'date' => '2025-10-16',
            ],
            [
                'id_program' => 2,
                'id_exercices' => 4,
                'reps' => 10,
                'weight' => 5,
                'date' => '2025-10-16',
            ],
            [
                'id_program' => 3,
                'id_exercices' => 3,
                'reps' => 1,
                'weight' => 0,
                'date' => '2025-10-16',
            ],
            [
                'id_program' => 4,
                'id_exercices' => 5,
                'reps' => 12,
                'weight' => 0,
                'date' => '2025-10-16',
            ],
        ];

        $this->db->table('series')->insertBatch($data);
    }
}
