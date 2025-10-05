<?php

namespace Database\Seeders\Product;

use App\Models\ProductColor;
use Illuminate\Database\Seeder;

class ProductColorSeeder extends Seeder
{
    public function run(): void
    {
        ProductColor::upsert(
            $this->data(),
            ['id'],
            ['name', 'slug']
        );
    }

    private function data(): array
    {
        return [
            ['id' => 1, 'name' => 'Black', 'slug' => 'black'],
            ['id' => 2, 'name' => 'White', 'slug' => 'white'],
            ['id' => 3, 'name' => 'Blue', 'slug' => 'blue'],
            ['id' => 4, 'name' => 'Midnight', 'slug' => 'midnight'],
            ['id' => 5, 'name' => 'Pink', 'slug' => 'pink'],
            ['id' => 6, 'name' => 'Titanium', 'slug' => 'titanium'],
        ];
    }
}
