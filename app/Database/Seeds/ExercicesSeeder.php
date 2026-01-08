<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ExercicesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Push Up',
                'description' => 'Push-ups for chest',
                'rest_time' => 60,
                'reps' => 15,
                'nber_series' => 3,
                'time_series' => '00:01:00',
                'id_cat' => 2,
                'id_muscle' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'deleted_at' => null,
            ],
            [
                'name' => 'Squat',
                'description' => 'Leg exercise',
                'rest_time' => 90,
                'reps' => 12,
                'nber_series' => 4,
                'time_series' => '00:01:30',
                'id_cat' => 2,
                'id_muscle' => 3,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'deleted_at' => null,
            ],
            [
                'name' => 'Plank',
                'description' => 'Core stability',
                'rest_time' => 75,
                'reps' => 1,
                'nber_series' => 3,
                'time_series' => '00:02:00',
                'id_cat' => 4,
                'id_muscle' => 4,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'deleted_at' => null,
            ],
            [
                'name' => 'Bicep Curl',
                'description' => 'Dumbbell curls',
                'rest_time' => 45,
                'reps' => 10,
                'nber_series' => 3,
                'time_series' => '00:00:45',
                'id_cat' => 2,
                'id_muscle' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'deleted_at' => null,
            ],
            [
                'name' => 'Lunges',
                'description' => 'Leg workout',
                'rest_time' => 70,
                'reps' => 12,
                'nber_series' => 3,
                'time_series' => '00:01:00',
                'id_cat' => 2,
                'id_muscle' => 3,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'deleted_at' => null,
            ],
        ];

        $this->db->table('exercices')->insertBatch($data);
    }
}
