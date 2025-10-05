<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('device_models', function (Blueprint $table) {
            $table->foreignId('discount_id')->nullable()->after('id')->constrained('discounts')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('device_models', function (Blueprint $table) {
            $table->dropConstrainedForeignId('discount_id');
        });
    }
};
