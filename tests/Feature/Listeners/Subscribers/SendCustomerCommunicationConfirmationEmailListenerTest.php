<?php

namespace Tests\Feature\Listeners\Subscribers;

use Tests\TestCase;

class SendCustomerCommunicationConfirmationEmailListenerTest extends TestCase
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
