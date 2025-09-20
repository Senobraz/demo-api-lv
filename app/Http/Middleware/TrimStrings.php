<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

class TrimStrings extends Middleware
{
    /**
     * The names of the attributes that should not be trimmed.
     *
     * @var array<int, string>
     */
    protected $except = [
        'current_password',
        'password',
        'password_confirmation',
        'content.*',
    ];

    /**
     * Transform the given value.
     *
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    protected function transform($key, $value)
    {
        foreach ($this->except as $field) {
            if (str_ends_with($field, '.*') && str_starts_with($key, substr($field, 0, -2))) {
                return $value;
            }
        }

        return parent::transform($key, $value);
    }
}
