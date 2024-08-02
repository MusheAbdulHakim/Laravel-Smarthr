<?php

namespace Modules\Sales\Database\Factories;

use App\Models\User;
use App\Enums\UserType;
use Modules\Sales\Models\Tax;
use Modules\Sales\Models\Invoice;
use Modules\Project\Models\Project;
use Modules\Sales\Models\InvoiceItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'client_id' => User::where('type', UserType::CLIENT)->inRandomOrder()->first()->id ?? User::factory()->create()->first()->id,
            'project_id' => Project::inRandomOrder()->first()->id ?? Project::factory(),
            'taxe_id' => Tax::inRandomOrder()->first()->id ?? Tax::factory(),
            'client_address' => $this->faker->streetAddress(),
            'billing_address' => $this->faker->address(),
            'startDate' => $this->faker->dateTimeBetween("-1 year"),
            'expiryDate' => $this->faker->date(),
            'discount' => $this->faker->numberBetween(0,10),
            'note' => $this->faker->realTextBetween(),
            'status' => $this->faker->randomElement([1,2,3,4])
        ];
    }

    public function configure(): InvoiceFactory
    {
        return $this->afterCreating(function(Invoice $invoice){
            InvoiceItem::factory()->count(5)->create([
                'invoice_id' => $invoice->id
            ]);
            $taxes = 0;
            if(!empty($invoice->taxe_id)){
                $taxes = ($invoice->tax->percentage/100) + InvoiceItem::where('invoice_id', $invoice->id)->sum('total');
            }
            $invoice->update([
                'inv_id' => app(\App\Settings\InvoiceSettings::class)->prefix . pad_zeros(Invoice::count() + 1),
                'tax_amount' => $taxes,
                'grand_total' => ($invoice->subtotal+$taxes) - ($invoice->discount / 100),
            ]);
        });
    }
}

