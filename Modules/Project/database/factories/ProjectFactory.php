<?php

namespace Modules\Project\Database\Factories;

use App\Models\User;
use App\Enums\UserType;
use Modules\Project\Models\Project;
use Modules\Project\Models\TaskBoard;
use Modules\Project\Models\ProjectTaskBoard;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'client_id' => User::where('type', UserType::CLIENT)->inRandomOrder()->first()->id,
            'short_desc' => $this->faker->sentence(),
            'startDate' => $this->faker->date(),
            'endDate' => $this->faker->date(),
            'rate' => $this->faker->numberBetween(10,50),
            'rateType' => $this->faker->randomElement(['Hourly','Fixed']),
            'priority' => $this->faker->randomElement(['High','Medium','Low','Normal']),
            'leader_id' => User::where('type', UserType::EMPLOYEE)->inRandomOrder()->first()->id,
            'description' => $this->faker->realText(),
            'created_by' => 1
        ];
    }

    public function configure(): ProjectFactory 
    {
        return $this->afterCreating(function(Project $project){
            $defaultBoards = TaskBoard::get()->map(function(TaskBoard $board) use($project){
                return [
                    'project_id' => $project->id,
                    'name' => $board->name,
                    'color' => $board->color,
                    'priority' => $board->priority,
                    'created_by' => $board->created_by
                ];
            });
            if(!empty($defaultBoards) && $defaultBoards->count() > 0){
                ProjectTaskBoard::insert($defaultBoards->all());
            }
            return $project;
        });
    }
}

