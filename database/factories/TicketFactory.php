<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Ticket;
use App\Enums\UserType;
use App\Enums\TicketStatus;
use App\Models\TicketReply;
use App\Enums\GeneralPriority;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tk_id' => null,
            'subject' => $this->faker->sentence(),
            'created_by' => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'user_id' => User::where('type', UserType::EMPLOYEE)->inRandomOrder()->first()->id,
            'description' => $this->faker->paragraph(5),
            'status' => $this->faker->randomElement(TicketStatus::cases()),
            'priority' => $this->faker->randomElement(GeneralPriority::cases()),
            'endDate' => $this->faker->dateTimeBetween()
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function(Ticket $ticket){
            TicketReply::factory()->count(4)->create([
                'ticket_id' => $ticket->id
            ]);
            $ticket->update([
                'tk_id' => '#TKT-'.pad_zeros(Ticket::count()+1),
            ]);
        });
    }
}
