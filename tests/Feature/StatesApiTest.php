<?php

namespace Tests\Feature;

use App\Models\State;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StatesApiTest extends TestCase
{

    /** @test */
    public function it_checks_state_capacity()
    {
        // Given
        $state = State::where('active', 1)->inRandomOrder()->first();

        // When
        $response = $this->json('GET', "/api/v1/states/{$state->id}/check-capacity", [], $this->headers);

        // Then
        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'data' => [
                    'name',
                    'code',
                    'hasCapacity',
                ],
                'success',
            ])
            ->assertJson([
                'data' => [
                    'name' => $state->name,
                    'code' => $state->code
                ],
                'success' => true,
            ]);
    }

}
