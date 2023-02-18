<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\User;
use Illuminate\Support\Facades\Config;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function loginAdmin() {
        $user = User::factory()->create();

        Config::push('laracasts.administrators', $user->email);

        $this->actingAs($user);
    }
}
