<?php

namespace App\Domains\Payment\Listeners;

use App\Domains\Checkout\Enums\OrderStatusEnum;
use App\Domains\Checkout\Models\Order;
use App\Domains\Payment\Services\PaymentService;
use Laravel\Cashier\Events\WebhookReceived;
use Stripe\Event;

readonly class WebhookListener
{
    public function __construct(
        private PaymentService $paymentService,
    ) {}

    public function handle(WebhookReceived $event): void
    {
        if (empty($event->payload['data']['object']['metadata']['order_id'])) {
            return;
        }

        switch ($event->payload['type']) {
            case Event::PAYMENT_INTENT_SUCCEEDED:
                $this->process($event->payload, OrderStatusEnum::PAYED);
                break;
            case Event::PAYMENT_INTENT_PROCESSING:
            case Event::PAYMENT_INTENT_PARTIALLY_FUNDED:
                $this->process($event->payload, OrderStatusEnum::PAYMENT_PROCESSING);
                break;
            case Event::PAYMENT_INTENT_PAYMENT_FAILED:
            case Event::PAYMENT_INTENT_CANCELED:
                $this->process($event->payload, OrderStatusEnum::PAYMENT_FAILED);
                break;

        }
    }

    private function process(array $payload, OrderStatusEnum $status): void
    {
        // 1. Find order
        $order = Order::query()
            ->where('id', $payload['data']['object']['metadata']['order_id'])
            ->with(['items'])
            ->first();

        if (is_null($order)) {
            return;
        }

        // 2. Create update order
        $this->paymentService->updateOrder($order, $status, $payload);
    }
}
