<?php

namespace App\Traits;

use Closure;

trait UseVariableCache
{
    private array $variableCache = [];

    /**
     * @param $key
     * @param Closure $callback
     * @return mixed
     */
    public function rememberVariable($key, Closure $callback): mixed
    {
        if (isset($this->variableCache[$key])) {
            return $this->variableCache[$key];
        }

        $this->variableCache[$key] = $callback();

        return $this->variableCache[$key];
    }

    /**
     * @return void
     */
    public function clearVariables(): void
    {
        $this->variableCache = [];
    }
}
