<?php

namespace App\Validation\Rules;


use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DelimitedRule implements ValidationRule
{
    protected string $separator;

    protected array $values;

    public function __construct(array $values = [], string $separator = ',')
    {
        $this->separator = $separator;
        $this->values = $values;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(!is_string($value)) {
            $fail("The selected :attribute is invalid type, a string is expected");

            return;
        }

        $validateValues = explode($this->separator, $value);

        if(!is_array($validateValues)) {
            $fail("The selected :attribute {$value} is invalid.");

            return;
        }

        if($this->values) {
            foreach ($validateValues as $value) {
                if (!in_array($value, $this->values)) {
                    $fail("The selected :attribute {$value} is invalid.");
                }
            }
        }
    }
}
