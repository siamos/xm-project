<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_home_page_response()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_post_home_page_response()
    {
        $response = $this->call('POST', '/', array(
            'company_symbol' => 'AAIT',
            'email' => 'siamosaris@gmail.com',
            'start_date' => '2022-04-20',
            'end_date' => '2022-04-27',
        ));

        $this->assertEquals(200, $response->getStatusCode());
    }
}
