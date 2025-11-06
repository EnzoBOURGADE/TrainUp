<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategoriesProgramSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'Full Body'],
            ['name' => 'Upper Body'],
            ['name' => 'Lower Body'],
            ['name' => 'Core'],
            ['name' => 'HIIT'],
        ];

        $this->db->table('categories_prgm')->insertBatch($data);
    }
}
