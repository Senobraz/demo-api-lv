<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait UseUserBy
{
    public static function bootUseUserBy(): void
    {
        static::creating(function ($model) {
            if (!$model->isDirty('created_by') || !$model->created_by) {
                $model->created_by = Auth::user()->getId();
            }
            if (!$model->isDirty('updated_by') || !$model->updated_by) {
                $model->updated_by = Auth::user()->getId();
            }
        });

        static::updating(function ($model) {
            if (!$model->isDirty('updated_by') || !$model->updated_by) {
                $model->updated_by = Auth::user()->getId();
            }
        });
    }

    /**
     * @return int
     */
    public function getCreatedBy(): int
    {
        return $this->created_by;
    }

    /**
     * @return int
     */
    public function getUpdatedBy(): int
    {
        return $this->updated_by;
    }
}
