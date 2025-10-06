<?php

namespace App\Domains\Checkout\Models;

use App\Domains\Auth\Models\User;
use App\Domains\Checkout\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Order extends Model
{
    protected $fillable = [
        'uuid',
        'status',
        'user_id',
        'total',
        'stripe_session_id',
    ];

    protected $casts = [
        'status' => OrderStatusEnum::class,
    ];

    protected static function booted(): void
    {
        static::creating(function ($order) {
            $order->uuid = Str::uuid();
        });
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
