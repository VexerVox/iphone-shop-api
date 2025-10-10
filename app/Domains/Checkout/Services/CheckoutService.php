<?php

namespace App\Domains\Checkout\Services;

use App\Domains\Checkout\Data\CheckoutInputData;
use App\Domains\Checkout\Data\CheckoutOutputData;
use App\Domains\Checkout\Data\CheckoutProductData;
use App\Domains\Checkout\Data\OrderCalculateData;
use App\Domains\Checkout\Data\ProductCalculateData;
use App\Domains\Checkout\Data\StripeSessionData;
use App\Domains\Checkout\Enums\OrderStatusEnum;
use App\Domains\Checkout\Models\Order;
use App\Domains\Checkout\Models\OrderItem;
use App\Domains\Product\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Throwable;

class CheckoutService
{
    /**
     * @throws Throwable
     */
    public function checkout(CheckoutInputData $data): CheckoutOutputData
    {
        $user = Auth::guard('api')->user();

        DB::beginTransaction();

        // 1. Calculate total
        $calculatedOrder = $this->calculate($data->products);

        // 2. Create order
        $order = Order::create([
            'user_id' => $user?->id,
            'status' => OrderStatusEnum::PENDING,
            'total' => $calculatedOrder->totalPrice,

            'email' => $data->email,
            'phone' => $data->phone,

            'first_name' => $data->firstName,
            'last_name' => $data->lastName,
            'address_line_1' => $data->addressLine1,
            'address_line_2' => $data->addressLine2,
            'city' => $data->city,
            'zip_code' => $data->zipCode,
            'country' => $data->country,
        ]);

        // 3. Create order items
        foreach ($calculatedOrder->calculatedProducts as $calculatedProduct) {
            $item = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $calculatedProduct->product->id,
                'total' => $calculatedProduct->totalPrice,
                'price_per_item' => $calculatedProduct->perProductPrice,
                'quantity' => $calculatedProduct->quantity,
            ]);
        }

        // 4. Create order session
        $stripeSessionData = $this->createStripeSession($calculatedOrder->calculatedProducts, $order);

        // 5. Update order stripe_session_id
        $order->update([
            'stripe_session_id' => $stripeSessionData->stripeSessionId,
        ]);

        DB::commit();

        return CheckoutOutputData::from([
            'orderUuid' => $order->uuid,
            'paymentUrl' => $stripeSessionData->paymentUrl,
        ]);
    }

    /**
     * @throws ApiErrorException
     */
    public function success(Order $order): bool
    {
        if ($order->status == OrderStatusEnum::PAYED) {
            return true;
        }

        if (is_null($order->stripe_session_id)) {
            return false;
        }

        $session = Session::retrieve($order->stripe_session_id);

        if ($session->payment_status == Session::PAYMENT_STATUS_PAID) {
            $order->update([
                'status' => OrderStatusEnum::PAYED,
            ]);

            return true;
        }

        return false;
    }

    /**
     * @param  Collection<CheckoutProductData>  $products
     */
    protected function calculate(Collection $products): OrderCalculateData
    {
        $totalPrice = 0;
        $calculatedProducts = collect();

        foreach ($products as $productData) {
            $calculatedProduct = $this->calculateProduct($productData);
            $totalPrice += $calculatedProduct->totalPrice;
            $calculatedProducts->push($calculatedProduct);
        }

        return OrderCalculateData::from([
            'calculatedProducts' => $calculatedProducts,
            'totalPrice' => $totalPrice,
        ]);
    }

    protected function calculateProduct(CheckoutProductData $data): ProductCalculateData
    {
        $product = Product::where('slug', $data->slug)->first();
        $perProductPrice = $product->discounted_price ?? $product->price;

        return ProductCalculateData::from([
            'product' => $product,
            'quantity' => $data->quantity,
            'totalPrice' => $perProductPrice * $data->quantity,
            'perProductPrice' => $perProductPrice,
        ]);
    }

    /**
     * @param  Collection<ProductCalculateData>  $calculatedProducts
     *
     * @throws ApiErrorException
     */
    public function createStripeSession(Collection $calculatedProducts, Order $order): StripeSessionData
    {
        $lineItems = [];

        foreach ($calculatedProducts as $product) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $product->product->name,
                    ],
                    'unit_amount' => $product->perProductPrice,
                ],
                'quantity' => $product->quantity,
            ];
        }

        $checkoutSession = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => Session::MODE_PAYMENT,
            'success_url' => $this->checkoutFrontendUrl(config('frontend.checkout.success_url'), $order->uuid),
            'cancel_url' => $this->checkoutFrontendUrl(config('frontend.checkout.cancel_url'), $order->uuid),
            'metadata' => [
                'order_id' => $order->id,
            ],
        ]);

        return StripeSessionData::from([
            'stripeSessionId' => $checkoutSession->id,
            'paymentUrl' => $checkoutSession->url,
        ]);
    }

    protected function checkoutFrontendUrl(string $url, string $orderUuid): string
    {
        return config('frontend.base_url').$url.'?uuid='.$orderUuid;
    }
}
