<?php

namespace Modules\Project\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Project\Models\TaskBoard;

class TaskBoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TaskBoard::insert([
            [
                'name' => 'Todo',
                'color' => '#318da0',
                'priority' => 1,
                'created_by' => 1
            ],
            [
                'name' => 'InProgress',
                'color' => '#318da0',
                'priority' => 2,
                'created_by' => 1
            ],
            [
                'name' => 'Pending',
                'color' => '#318da0',
                'priority' => 3,
                'created_by' => 1
            ],
            [
                'name' => 'OnHold',
                'color' => '#318da0',
                'priority' => 4,
                'created_by' => 1
            ],
            [
                'name' => 'Review',
                'color' => '#318da0',
                'priority' => 5,
                'created_by' => 1
            ],
            [
                'name' => 'Completed',
                'color' => '#318da0',
                'priority' => 6,
                'created_by' => 1
            ],
        ]);
    }
}
