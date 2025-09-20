<?php

namespace App\Validation\Rules;

use App\Helpers\TiptapHelper;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TiptapLengthRule implements ValidationRule
{
    protected int $length;

    public function __construct(int $length = 0)
    {
        $this->length = $length;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$value || !is_array($value) || !TiptapHelper::validateContentByArray($value)) {
            $fail("The :attribute is wrong.");

            return;
        }

        if (!TiptapHelper::checkLimitLength($value, $this->length)) {
            $fail("The :attribute is too large.");
        }
    }
}
