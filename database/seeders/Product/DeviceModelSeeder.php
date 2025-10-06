<?php

namespace Database\Seeders\Product;

use App\Domains\Product\Models\DeviceModel;
use Illuminate\Database\Seeder;

class DeviceModelSeeder extends Seeder
{
    public function run(): void
    {
        DeviceModel::upsert(
            $this->data(),
            ['id'],
            ['name', 'slug']
        );
    }

    private function data(): array
    {
        return [
            ['id' => 1, 'name' => 'iPhone 11', 'slug' => 'iphone-11'],
            ['id' => 2, 'name' => 'iPhone 11 Pro', 'slug' => 'iphone-11-pro'],
            ['id' => 3, 'name' => 'iPhone 11 Pro Max', 'slug' => 'iphone-11-pro-max'],

            ['id' => 4, 'name' => 'iPhone 12', 'slug' => 'iphone-12'],
            ['id' => 5, 'name' => 'iPhone 12 Plus', 'slug' => 'iphone-12-plus'],
            ['id' => 6, 'name' => 'iPhone 12 Pro', 'slug' => 'iphone-12-pro'],
            ['id' => 7, 'name' => 'iPhone 12 Pro Max', 'slug' => 'iphone-12-pro-max'],

            ['id' => 8, 'name' => 'iPhone 13', 'slug' => 'iphone-13'],
            ['id' => 9, 'name' => 'iPhone 13 Plus', 'slug' => 'iphone-13-plus'],
            ['id' => 10, 'name' => 'iPhone 13 Pro', 'slug' => 'iphone-13-pro'],
            ['id' => 11, 'name' => 'iPhone 13 Pro Max', 'slug' => 'iphone-13-pro-max'],

            ['id' => 12, 'name' => 'iPhone 14', 'slug' => 'iphone-14'],
            ['id' => 13, 'name' => 'iPhone 14 Plus', 'slug' => 'iphone-14-plus'],
            ['id' => 14, 'name' => 'iPhone 14 Pro', 'slug' => 'iphone-14-pro'],
            ['id' => 15, 'name' => 'iPhone 14 Pro Max', 'slug' => 'iphone-14-pro-max'],

            ['id' => 16, 'name' => 'iPhone 15', 'slug' => 'iphone-15'],
            ['id' => 17, 'name' => 'iPhone 15 Plus', 'slug' => 'iphone-15-plus'],
            ['id' => 18, 'name' => 'iPhone 15 Pro', 'slug' => 'iphone-15-pro'],
            ['id' => 19, 'name' => 'iPhone 15 Pro Max', 'slug' => 'iphone-15-pro-max'],

            ['id' => 20, 'name' => 'iPhone 16', 'slug' => 'iphone-16'],
            ['id' => 21, 'name' => 'iPhone 16 Plus', 'slug' => 'iphone-16-plus'],
            ['id' => 22, 'name' => 'iPhone 16e', 'slug' => 'iphone-16e'],
            ['id' => 23, 'name' => 'iPhone 16 Pro', 'slug' => 'iphone-16-pro'],
            ['id' => 24, 'name' => 'iPhone 16 Pro Max', 'slug' => 'iphone-16-pro-max'],

            ['id' => 25, 'name' => 'iPhone 17', 'slug' => 'iphone-17'],
            ['id' => 26, 'name' => 'iPhone 17 Air', 'slug' => 'iphone-17-air'],
            ['id' => 27, 'name' => 'iPhone 17 Pro', 'slug' => 'iphone-17-pro'],
            ['id' => 28, 'name' => 'iPhone 17 Pro Max', 'slug' => 'iphone-17-pro-max'],
        ];
    }
}
