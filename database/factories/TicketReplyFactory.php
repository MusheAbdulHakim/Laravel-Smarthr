<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TicketReply>
 */
class TicketReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ticket_id' => Ticket::inRandomOrder()->first()->id ?? Ticket::factory()->create()->id,
            'reply_id' => null,
            'message' => $this->faker->paragraph(),
            'created_by' => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'is_read' => $this->faker->randomElement([true, false])
        ];
    }
}
