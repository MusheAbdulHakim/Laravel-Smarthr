<?php

namespace Modules\Sales\Database\Factories;

use App\Models\User;
use App\Enums\UserType;
use Modules\Sales\Models\Tax;
use Modules\Sales\Models\Estimate;
use Modules\Project\Models\Project;
use Modules\Sales\Models\EstimateItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class EstimateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Estimate::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'client_id' => User::where('type', UserType::CLIENT)->inRandomOrder()->first()->id,
            'project_id' => Project::inRandomOrder()->first()->id ?? Project::factory(),
            'taxe_id' => Tax::inRandomOrder()->first()->id ?? Tax::factory(),
            'client_address' => $this->faker->streetAddress(),
            'billing_address' => $this->faker->address(),
            'startDate' => $this->faker->dateTimeBetween("-1 year"),
            'expiryDate' => $this->faker->date(),
            'discount' => $this->faker->numberBetween(0,10),
            'note' => $this->faker->realTextBetween(),
            'status' => $this->faker->randomElement(['Accepted','Sent','Declined','Expired'])
        ];
    }

    public function configure(): EstimateFactory
    {
        return $this->afterCreating(function(Estimate $estimate){
            EstimateItem::factory();
            $taxes = 0;
            if(!empty($estimate->tax_id)){
                $taxes = $estimate->tax->percentage * EstimateItem::where('estimate_id', $estimate->id)->sum('total');
            }
            $estimate->update([
                'est_id' => "EST-" . pad_zeros(Estimate::count() + 1),
                'tax_amount' => $taxes
            ]);
            return $estimate;
        });
    }
}

