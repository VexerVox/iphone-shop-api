<?php

namespace App\Domains\Product\Models;

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
        'preview_image',
        'full_image',
        'price',
        'discounted_price',
        'has_esim',
        'has_nanosim',
        'has_dualsim',
        'is_available',
        'is_recommended',
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
