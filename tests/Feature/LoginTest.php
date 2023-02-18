<?php

namespace Tests\Feature;

use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_user_recieves_currect_message_when_passing_in_wrong_credentials()
    {
        $user = \App\Models\User::factory()->create();

        $this->postJson('/login', [
            'email' => $user->email,
            'password' => 'wrong-password'
        ])->assertStatus(422)
        ->assertJson([
            'message' => 'These credentials do not match our records.'
        ]);
    }

    public function test_currect_response_after_user_logs_in() {
        $user = \App\Models\User::factory()->create();

        $this->postJson('/login', [
            'email' => $user->email,
            'password' => 'secret'
        ])->assertStatus(200)
        ->assertJson([
            'status' => 'ok'
        ])->assertSessionHas('success','Successfully logged in.');
    }
}
