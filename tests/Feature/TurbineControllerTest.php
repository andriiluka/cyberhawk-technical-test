<?php

namespace Tests\Feature;

use App\Models\Blade;
use App\Models\Generator;
use App\Models\Hub;
use App\Models\Rotor;
use App\Models\Turbine;
use App\Models\User;
use Tests\TestCase;

class TurbineControllerTest extends TestCase
{
    public function test_index(): void
    {
        $this->actingAs(User::factory()->create());
        Turbine::factory()->count(3)->create();

        $this->getJson('/api/turbines')
            ->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function test_store(): void
    {
        $this->actingAs(User::factory()->create());

        $this->postJson('/api/turbines', [
            'blades' => [
                [
                    'grade' => 5,
                ],
                [
                    'grade' => 4,
                ],
            ],
            'rotor' => [
                'grade' => 3,
            ],
            'hub' => [
                'grade' => 4,
            ],
            'generator' => [
                'grade' => 5,
            ],
        ])->assertCreated();
    }

    public function test_show(): void
    {
        $this->actingAs(User::factory()->create());

        Turbine::factory()
            ->has(Blade::factory()->count(3))
            ->has(Rotor::factory()->count(1))
            ->has(Hub::factory()->count(1))
            ->has(Generator::factory()->count(1))
            ->count(3)
            ->create();

        $expectedData = json_decode(file_get_contents(__DIR__ . '/data/turbine_show.json'), true);

        $this->getJson('/api/turbines/1')
            ->assertStatus(200)
            ->assertExactJson($expectedData);
    }

    public function test_update(): void
    {
        $this->actingAs(User::factory()->create());

        Turbine::factory()
            ->has(Blade::factory()->count(3))
            ->has(Rotor::factory()->count(1))
            ->has(Hub::factory()->count(1))
            ->has(Generator::factory()->count(1))
            ->count(3)
            ->create();

        $this->putJson('/api/turbines/1', [
            'blades' => [
                [
                    'id' => 1,
                    'grade' => 5,
                ],
                [
                    'id' => 2,
                    'grade' => 4,
                ],
            ],
            'rotor' => [
                'grade' => 3,
            ],
            'hub' => [
                'grade' => 4,
            ],
            'generator' => [
                'grade' => 5,
            ],
        ])->assertStatus(200);
    }

    public function test_delete(): void
    {
        $this->actingAs(User::factory()->create());
        Turbine::factory()->count(3)->create();

        $this->deleteJson('/api/turbines/1')
            ->assertNoContent();
    }
}
