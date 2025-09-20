<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Auth;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function authorize() {
        Auth::attempt([
            'email' => 'test@test.com',
            'password' => 'password'

        ]);
    }

    public function user(): \App\Models\User\User|\Illuminate\Contracts\Auth\Authenticatable|null
    {
        return Auth::user();
    }
}
