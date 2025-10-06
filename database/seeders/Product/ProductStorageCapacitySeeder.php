<?php

namespace Database\Seeders\Product;

use App\Domains\Product\Models\ProductStorageCapacity;
use Illuminate\Database\Seeder;

class ProductStorageCapacitySeeder extends Seeder
{
    public function run(): void
    {
        ProductStorageCapacity::upsert(
            $this->data(),
            ['id'],
            ['name', 'slug']
        );
    }

    private function data(): array
    {
        return [
            ['id' => 1, 'name' => '128 GB', 'slug' => '128gb'],
            ['id' => 2, 'name' => '256 GB', 'slug' => '256gb'],
            ['id' => 3, 'name' => '512 GB', 'slug' => '512gb'],
            ['id' => 4, 'name' => '1 TB',   'slug' => '1tb'],
        ];
    }
}
