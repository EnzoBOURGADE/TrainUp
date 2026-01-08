<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MasterSeeder extends Seeder
{
    public function run()
    {
        $this->call('PermissionSeeder');
        $this->call('UserSeeder');
        $this->call('CategoriesSeeder');
        $this->call('MusclesSeeder');
        $this->call('CategoriesProgramSeeder');
        $this->call('ProgramSeeder');
        $this->call('ExercicesSeeder');
        $this->call('SeriesSeeder');
        $this->call('WorkoutSeeder');
        $this->call('FriendsRequestSeeder');
        $this->call('FriendsSeeder');
    }
}
