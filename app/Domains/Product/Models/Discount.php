<?php

namespace App\Domains\Product\Models;

use App\Domains\Product\Enums\DiscountTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Discount extends Model
{
    protected $fillable = [
        'product_id',
        'model_id',
        'type',
        'value',
    ];

    protected $casts = [
        'type' => DiscountTypeEnum::class,
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function deviceModel(): BelongsTo
    {
        return $this->belongsTo(DeviceModel::class);
    }
}
