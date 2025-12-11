<?php

namespace Tests\Feature;

use Tests\TestCase;
use Inertia\Testing\AssertableInertia as Assert;

class DistanceCalculatorTest extends TestCase
{
    public function test_it_calculates_distance_correctly()
    {
        $payload = [
            'latA' => 52.22972,
            'longA' => 21.01224,
            'latB' => 50.06471,
            'longB' => 19.94505,
        ];

        $response = $this->post('/', $payload);

        $response->assertStatus(200)
                 ->assertInertia(fn (Assert $page) => $page
                     ->component('DistanceCalculator')
                     ->has('result', fn (Assert $json) => $json
                         ->where('kilometers', 251.98)
                         ->etc()
                     )
                 );
    }
    public function test_it_validates_input_data()
    {
        $response = $this->post('/', []);
        $response->assertSessionHasErrors(['latA', 'longA', 'latB', 'longB']);
        
        $response = $this->post('/', [
            'latA' => 999,
        ]);
        $response->assertSessionHasErrors(['latA']);
    }
}
