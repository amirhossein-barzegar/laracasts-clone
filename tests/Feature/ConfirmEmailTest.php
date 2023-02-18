<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfirmEmailTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_user_can_confirm_email()
    {
        // create a user 
        $user = \App\Models\User::factory()->create();
        // make a get request to the confirm endpoint
        $this->get("/register/confirm/?token={$user->confirm_token}")
        ->assertRedirect('/')
        ->assertSessionHas('success','Your email has been confirmed.');
        // assert that the user is confirmed
        $this->assertTrue($user->fresh()->isConfirmed());
    }

    public function test_a_user_is_redirected_if_token_is_wrong() {
        // create a user 
        $user = \App\Models\User::factory()->create();
        // make a get request to the confirm endpoint
        $this->get("/register/confirm/?token=WRONG_TOKEN")
        ->assertRedirect('/')
        ->assertSessionHas('error','Confirmaiton token not recognized.');
    }
}
