<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Asset;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Asset>
 */
class AssetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ast_id' => 'null',
            'name' => $this->faker->word(),
            'purchase_date' => $this->faker->date(),
            'purchase_from' => $this->faker->word(),
            'manufacturer' => $this->faker->word(),
            'model' => $this->faker->word(),
            'serial_no' => $this->faker->randomDigit(),
            'supplier' => $this->faker->name(),
            'ast_condition' => $this->faker->randomElement(['Brand New','Used', 'Minimum']),
            'warranty' => $this->faker->randomNumber(2), 
            'warranty_end' => $this->faker->dateTimeBetween(),
            'cost' => $this->faker->randomNumber(),
            'description' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['approved','pending','returned']),
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'files' => null,
            'created_by' => 1,
            'brand' => $this->faker->numberBetween()
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function(Asset $asset) {
            $totalAsset = Asset::count();
            $asset->update([
                'ast_id' => "AST-" . pad_zeros(($totalAsset + 1))
            ]);
        });
    }

}
