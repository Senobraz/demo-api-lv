<?php

namespace App\Models\Module;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    const MODULE_ENOTE = 'enotes';

    public $timestamps = false;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function geName(): string
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return (bool)$this->active;
    }

    /**
     * @param Builder $query
     * @param string $code
     * @return void
     */
    public function scopeOfCode(Builder $query, string $code): void
    {
        $query->where('code', $code);
    }

    /**
     * @param string $code
     * @param array $columns
     * @return Module|\Closure|null
     */
    static function findByCode(string $code, array $columns = ['*']): Module|\Closure|null
    {
        $module = static::ofCode($code)->get();

        if (!$module->isEmpty()) {
            return $module->first();
        }

        return null;
    }
}
