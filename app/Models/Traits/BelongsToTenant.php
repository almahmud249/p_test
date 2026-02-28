<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Tenant;

trait BelongsToTenant
{
    /**
     * Boot the trait.
     */
    protected static function bootBelongsToTenant(): void
    {
        // Apply global scope
        static::addGlobalScope('tenant', function (Builder $builder) {

            if (!app()->has('currentTenant')) {
                throw new \Exception('Tenant not resolved.');
            }

            $builder->where(
                $builder->getModel()->getTable() . '.tenant_id',
                app('currentTenant')->id
            );
        });

        // Auto assign tenant_id when creating
        static::creating(function ($model) {

            if (!app()->has('currentTenant')) {
                throw new \Exception('Tenant not resolved.');
            }

            $model->tenant_id = app('currentTenant')->id;
        });
    }

    /**
     * Define tenant relationship
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}