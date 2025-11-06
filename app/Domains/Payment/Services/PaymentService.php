<?php

namespace App\Domains\Payment\Services;

use App\Domains\Checkout\Enums\OrderStatusEnum;
use App\Domains\Checkout\Models\Order;

class PaymentService
{
    public function updateOrder(Order $order, OrderStatusEnum $status, array $payload): void
    {
        $order->update([
            'status' => $status,
            'payment_info' => $payload
        ]);
    }
}
