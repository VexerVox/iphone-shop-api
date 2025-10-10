<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('preview_image')->after('slug')->nullable();
            $table->string('full_image')->after('preview_image')->nullable();
            $table->boolean('is_recommended')->after('has_dualsim')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['preview_image', 'full_image', 'is_recommended']);
        });
    }
};
