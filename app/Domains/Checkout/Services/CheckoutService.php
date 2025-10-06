<?php

namespace App\Domains\Checkout\Services;

use App\Domains\Checkout\Data\CheckoutInputData;
use App\Domains\Checkout\Data\CheckoutOutputData;
use App\Domains\Checkout\Data\CheckoutProductData;
use App\Domains\Checkout\Data\OrderCalculateData;
use App\Domains\Checkout\Data\ProductCalculateData;
use App\Domains\Checkout\Enums\OrderStatusEnum;
use App\Domains\Checkout\Models\Order;
use App\Domains\Checkout\Models\OrderItem;
use App\Domains\Product\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            'status' => OrderStatusEnum::CREATED,
            'total' => $calculatedOrder->totalPrice,
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

        // 4. Create order session TODO

        DB::commit();

        return CheckoutOutputData::from([
            'orderUuid' => $order->uuid,
        ]);
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
}
