<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MusclesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'Biceps'],
            ['name' => 'Triceps'],
            ['name' => 'Quadriceps'],
            ['name' => 'Hamstrings'],
            ['name' => 'Deltoids'],
        ];

        $this->db->table('muscles')->insertBatch($data);
    }
}
