<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use League\CommonMark\Normalizer\SlugNormalizer;
use Tests\TestCase;
use App\Mail\ConfirmYourEmail;
use App\Models\User;

class RegisterationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_user_has_a_default_username_after_registeration()
    {
        $this->withoutExceptionHandling();

        $this->post('/register', [
            'name' => 'amir hossein',
            'email' => 'amirhossein@gmail.com',
            'password' => '12345678'
        ])->assertRedirect();
        $sluger = new SlugNormalizer;
        $this->assertDatabaseHas('users', [
            'username' => $sluger->normalize('amir hossein')
        ]);
    }

    public function test_an_email_is_sent_to_newly_registered_users() {
        $this->withoutExceptionHandling();

        Mail::fake();
        // Register new user 
        $this->post('/register', [
            'name' => 'amir hossein',
            'email' => 'amirhossein@gmail.com',
            'password' => '12345678'
        ])->assertRedirect();
        // Assert that a particular email was sent
        Mail::assertSent(ConfirmYourEmail::class);
    }

    public function test_a_user_has_a_token_after_registeration() {
        Mail::fake();
        // Register new user 
        $this->post('/register', [
            'name' => 'amir hossein',
            'email' => 'amirhossein@gmail.com',
            'password' => '12345678'
        ])->assertRedirect();

        $user = User::first();

        $this->assertNotNull($user->confirm_token);
        $this->assertFalse($user->isConfirmed());
    }
}
