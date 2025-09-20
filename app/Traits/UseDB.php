<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait UseDB
{
    /**
     * @param callable $callback
     * @return mixed
     */
    public function transaction(callable $callback): mixed
    {
        return DB::transaction(static function () use ($callback) {
            return $callback();
        });
    }
}
