<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DifficultiesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'libelle' => 'débutants',
                'color_hex' => '#03fc0b',
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'deleted_at' => null,
            ],
            [
                'libelle' => 'intermédiaires',
                'color_hex' => '#fca103',
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'deleted_at' => null,
            ],
            [
                'libelle' => 'confirmés',
                'color_hex' => '#c90000',
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'deleted_at' => null,
            ],
        ];

        $this->db->table('difficulties')->insertBatch($data);
    }
}
