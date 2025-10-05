<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_model_id')->constrained('device_models')->cascadeOnDelete();
            $table->foreignId('color_id')->constrained('product_colors')->cascadeOnDelete();
            $table->foreignId('storage_capacity_id')->constrained('product_storage_capacities')->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->unsignedInteger('price');
            $table->boolean('has_esim')->default(false);
            $table->boolean('has_nanosim')->default(false);
            $table->boolean('has_dualsim')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
