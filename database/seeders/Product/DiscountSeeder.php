<?php

namespace Database\Seeders\Product;

use App\Domains\Product\Enums\DiscountTypeEnum;
use App\Domains\Product\Models\DeviceModel;
use App\Domains\Product\Models\Discount;
use App\Domains\Product\Models\Product;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    public function run(): void
    {
        Discount::upsert(
            $this->data(),
            ['id'],
            ['product_id', 'device_model_id', 'type', 'value']
        );
    }

    private function data(): array
    {
        $deviceModelLastId = DeviceModel::query()
            ->orderBy('id', 'desc')
            ->offset(1)
            ->limit(1)
            ->pluck('id')
            ->first();

        $productLastId = Product::query()
            ->orderBy('id', 'desc')
            ->limit(1)
            ->pluck('id')
            ->first();

        return [
            [
                'id' => 1,
                'device_model_id' => 1,
                'product_id' => null,
                'type' => DiscountTypeEnum::PERCENT,
                'value' => 20,
            ],
            [
                'id' => 2,
                'device_model_id' => 2,
                'product_id' => null,
                'type' => DiscountTypeEnum::PERCENT,
                'value' => 15,
            ],
            [
                'id' => 3,
                'device_model_id' => 3,
                'product_id' => null,
                'type' => DiscountTypeEnum::PERCENT,
                'value' => 10,
            ],
            [
                'id' => 4,
                'device_model_id' => ($deviceModelLastId - 1),
                'product_id' => null,
                'type' => DiscountTypeEnum::FIXED_AMOUNT,
                'value' => 10,
            ],
            [
                'id' => 5,
                'device_model_id' => $deviceModelLastId,
                'product_id' => null,
                'type' => DiscountTypeEnum::FIXED_AMOUNT,
                'value' => 5,
            ],
            [
                'id' => 6,
                'device_model_id' => null,
                'product_id' => $productLastId,
                'type' => DiscountTypeEnum::FIXED_AMOUNT,
                'value' => 25,
            ],
        ];
    }
}
