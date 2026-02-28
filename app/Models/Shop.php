<?php
namespace App\Models;

use App\Models\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected static function booted()
    {
        use BelongsToTenant;
    }
}
