<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Factory as Faker;

class StorePersonTesting extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $faker = Faker::create();

        $data = [
            'name' => $faker->firstName,
            'surname' => $faker->lastName,
            'second_surname' => $faker->lastName,
            'email' => $faker->email,
            'phone_number' => $faker->phoneNumber,
            'postal_code' => $faker->postcode,
            'state' => $faker->state,
        ];

        $response = $this->postJson('/api/person', $data);

        $response->assertStatus(201)
                 ->assertJson([
                     'message' => 'Persona registrada exitosamente',
                 ]);
    }
}
