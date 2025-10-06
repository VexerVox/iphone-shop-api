<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\Product\DeviceModelSeeder;
use Database\Seeders\Product\DiscountSeeder;
use Database\Seeders\Product\ProductColorSeeder;
use Database\Seeders\Product\ProductSeeder;
use Database\Seeders\Product\ProductStorageCapacitySeeder;
use Database\Seeders\User\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (app()->environment(['local', 'staging'])) {
            $this->developmentSeeders();
        }
    }

    private function developmentSeeders(): void
    {
        $this->call([
            UserSeeder::class,
            ProductColorSeeder::class,
            ProductStorageCapacitySeeder::class,
            DeviceModelSeeder::class,
            ProductSeeder::class,
            //            DiscountSeeder::class,
        ]);
    }
}
