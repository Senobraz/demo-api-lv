<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

trait UseUlids
{
    use HasUlids;

    /**
     * @return string[]
     */
    public function uniqueIds(): array
    {
        return ['ulid'];
    }

    /**
     * @param Builder $query
     * @param string $ulid
     * @return void
     */
    public function scopeOfUlid(Builder $query, string $ulid): void
    {
        $query->where('ulid', $ulid);
    }

    /**
     * @param string $ulid
     * @return int|null
     */
    static public function getIdByUlid(string $ulid): ?int
    {
        if (!$ulid) {
            return null;
        }

        return self::OfUlid($ulid)->first('id')->id ?? null;
    }

    /**
     * @param string $ulid
     * @return UseUlids|null
     */
    static public function getByUlid(string $ulid): ?static
    {
        if (!$ulid) {
            return null;
        }

        return self::OfUlid($ulid)->first() ?? null;
    }
}
