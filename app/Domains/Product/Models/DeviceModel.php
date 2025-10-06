<?php

namespace App\Domains\Product\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceModel extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];
}
