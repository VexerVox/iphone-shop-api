<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Contact info
            $table->string('email');
            $table->string('phone');

            // Shipping address
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('city');
            $table->string('zip_code');
            $table->string('country');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'email',
                'phone',

                'first_name',
                'last_name',
                'address_line_1',
                'address_line_2',
                'city',
                'zip_code',
                'country',
            ]);
        });
    }
};
