<?php

namespace Tests\Feature;

use App\Models\State;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompaniesApiTest extends TestCase
{
    // use RefreshDatabase;

    /** @test */
    public function it_creates_a_company_for_given_state()
    {
        // Given
        $name = 'New Company for Test - ' . now()->timestamp;
        $bodyContent = [
            'state' => 2,
            'name' => $name,
            'assignThemselves' => false
        ];

        // When
        $response = $this->json('POST',
            '/api/v1/companies',
            $bodyContent,
            $this->headers
        );

        // Then
        $response->assertStatus(201)
        ->assertJsonStructure([
            'message',
            'data' => [
                'user_id',
                'state_id',
                'registered_agent_id',
                'name',
                'created_at',
                'id',
            ],
            'success',
        ])->assertJson([
            'data' => [
                'state_id' => 2,
                'name' => $name,
            ],
            'success' => true,
        ]);

        $this->assertDatabaseHas('companies', [
            'state_id' => 2,
            'name'     => $name
        ]);
    }

    /** @test */
    public function it_reassigns_an_agent()
    {
        // Given:
        $bodyContent = [
            "assignThemselves" => false
        ];

        $state = State::where('active', 1)->inRandomOrder()->first();
        $agent = $state->agents->random();

        $company = \App\Models\Company::factory()->create([
            'user_id'               => $this->user->id,
            'state_id'              => $state->id,
            'registered_agent_id'   => $agent->id,
            'registered_agent_type' => 1,
        ]);

        // When:
        $response = $this->json('PUT', '/api/v1/companies/' . $company->id , $bodyContent, $this->headers);

        // Then:
        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'data' => [
                    'assignThemselves',
                    'assigned' => [
                        'id',
                        'state_id',
                        'name',
                        'email',
                        'capacity',
                        'created_at',
                    ],
                ],
                'success',
            ])
            ->assertJson([
                'data' => [
                    'assignThemselves' => false,
                ],
                'success' => true,
            ]);

        $this->assertDatabaseHas('companies', [
            'id' => $company->id
        ]);
    }

}
