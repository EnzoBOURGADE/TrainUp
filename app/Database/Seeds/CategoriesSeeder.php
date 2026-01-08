<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'Cardio'],
            ['name' => 'Strength'],
            ['name' => 'Flexibility'],
            ['name' => 'Balance'],
            ['name' => 'Endurance'],
        ];

        $this->db->table('categories')->insertBatch($data);
    }
}