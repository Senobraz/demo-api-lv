<?php

namespace App\Http\Requests;


use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class ApiRequest extends FormRequest
{
    public function attempt(int $maxAttempts = 10, int $decaySeconds = 60)
    {
        $throttleKey = $this->route()->getName() . ':' . $this->user()->id;

        $executed = RateLimiter::attempt(
            $throttleKey,
            $maxAttempts,
            function () {
                return true;
            },
            $decaySeconds
        );

        if (!$executed) {
            event(new Lockout($this));

            $seconds = RateLimiter::availableIn($throttleKey);

            throw ValidationException::withMessages([
                'email' => __('alert.throttle', [
                    'seconds' => $seconds,
                ]),
            ]);
        }
    }
}
