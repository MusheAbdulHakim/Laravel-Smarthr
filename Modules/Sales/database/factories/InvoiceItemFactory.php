<?php

namespace Modules\Sales\Database\Factories;

use Modules\Sales\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Sales\Models\InvoiceItem;

class InvoiceItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Sales\Models\InvoiceItem::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'invoice_id' => Invoice::inRandomOrder()->first()->id ?? Invoice::factory(),
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'unit_cost' => $this->faker->randomFloat(),
            'quantity' => $this->faker->numberBetween(1,10),
        ];
    }

    public function configure(): static 
    {
        return $this->afterCreating(function(InvoiceItem $invoiceItem){
            $invoiceItem->update([
                'total' => $invoiceItem->unit_cost * $invoiceItem->quantity
            ]);
        });
    }
}

