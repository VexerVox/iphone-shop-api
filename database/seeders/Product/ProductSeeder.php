<?php

namespace Database\Seeders\Product;

use App\Models\DeviceModel;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductStorageCapacity;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::upsert(
            $this->data(),
            ['id'],
            [
                'device_model_id',
                'color_id',
                'storage_capacity_id',
                'name',
                'slug',
                'price',
                'has_esim',
                'has_nanosim',
                'has_dualsim',
            ]
        );
    }

    private function data(): array
    {
        $products = [];
        $id = 1;

        $deviceModels = DeviceModel::all();
        $colors = ProductColor::all();
        $storages = ProductStorageCapacity::all();

        foreach ($deviceModels as $deviceModel) {
            foreach ($storages as $storage) {
                foreach ($colors as $color) {
                    $name = "{$deviceModel->name} {$storage->name} {$color->name}";
                    $slug = "{$deviceModel->slug}-{$storage->slug}-{$color->slug}";
                    $price = $this->calculatePrice($deviceModel->name, $storage->name);

                    $products[] = [
                        'id' => $id++,
                        'device_model_id' => $deviceModel->id,
                        'color_id' => $color->id,
                        'storage_capacity_id' => $storage->id,
                        'name' => $name,
                        'slug' => $slug,
                        'price' => $price,
                        'has_esim' => true,
                        'has_nanosim' => true,
                        'has_dualsim' => false,
                    ];
                }
            }
        }

        return $products;
    }

    private function calculatePrice(string $modelName, string $storageName): int
    {
        $basePrice = match (true) {
            str_contains($modelName, 'iPhone 11') => 50000,
            str_contains($modelName, 'iPhone 12') => 60000,
            str_contains($modelName, 'iPhone 13') => 70000,
            str_contains($modelName, 'iPhone 14') => 80000,
            str_contains($modelName, 'iPhone 15') => 90000,
            str_contains($modelName, 'iPhone 16') => 100000,
            str_contains($modelName, 'iPhone 17') => 110000,
            default => 60000,
        };

        $storagePrice = match ($storageName) {
            '128 GB' => 0,
            '256 GB' => 5000,
            '512 GB' => 10000,
            '1 TB' => 20000,
            default => 0,
        };

        return $basePrice + $storagePrice;
    }
}
