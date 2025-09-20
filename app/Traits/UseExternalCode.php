<?php

namespace App\Traits;

use App\Helpers\StrHelper;

trait UseExternalCode
{
    public static function bootUseExternalCode(): void
    {
        static::creating(function ($model) {
            if (!$model->isDirty('external_code')) {
                $model->external_code = StrHelper::getExternalCode(16);
            }
        });
    }
}
