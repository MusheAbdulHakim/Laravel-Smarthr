<?php

namespace Database\Seeders;

use App\Models\Holiday;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::insert([
            [
                'name' => 'Sales', 
                'location' => 'Ghana',
                'description' => null
            ],
            [
                'name' => 'Marketing', 
                'location' => 'Ghana',
                'description' => null
            ],
            [
                'name' => 'AI', 
                'location' => 'Ghana',
                'description' => null
            ],
            [
                'name' => 'Security', 
                'location' => 'Ghana',
                'description' => null
            ],
        ]);
        Designation::insert([
            [
                'name' => 'Web Developer',
                'description' => null
            ],
            [
                'name' => 'Software Developer',
                'description' => null
            ],
            [
                'name' => 'UI UX',
                'description' => null
            ],
            [
                'name' => 'Designer',
                'description' => null
            ],
            [
                'name' => 'FullStack',
                'description' => null
            ],
            [
                'name' => 'Laravel Developer',
                'description' => null
            ],
            [
                'name' => 'Wordpress Developer',
                'description' => null
            ],
        ]);
        Holiday::factory(10)->create();
    }
}
