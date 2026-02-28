<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected static function booted()
    {
        static::addGlobalScope('tenant', function ($builder) {
            if (app()->has('currentTenant')) {
                $builder->where('tenant_id', app('currentTenant')->id);
            }
        });
        static::creating(function ($model) {
            if (app()->has('currentTenant')) {
                $model->tenant_id = app('currentTenant')->id;
            }
        });
    }
}
