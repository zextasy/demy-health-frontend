<?php

namespace Tests\Feature\Listeners;

use Tests\TestCase;

class SendCustomerTestBookingConfirmationListenerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
