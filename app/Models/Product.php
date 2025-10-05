<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'device_model_id',
        'color_id',
        'storage_capacity_id',
        'name',
        'slug',
        'price',
        'has_esim',
        'has_nanosim',
        'has_dualsim',
    ];

    public function deviceModel(): BelongsTo
    {
        return $this->belongsTo(DeviceModel::class);
    }

    public function color(): BelongsTo
    {
        return $this->belongsTo(ProductColor::class);
    }

    public function storageCapacity(): BelongsTo
    {
        return $this->belongsTo(ProductStorageCapacity::class);
    }
}
