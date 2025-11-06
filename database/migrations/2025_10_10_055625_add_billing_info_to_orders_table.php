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
            $table->string('email')->after('stripe_session_id');
            $table->string('phone')->after('email');

            // Shipping address
            $table->string('first_name')->after('phone');
            $table->string('last_name')->after('first_name');
            $table->string('address_line_1')->after('last_name');
            $table->string('address_line_2')->after('address_line_1')->nullable();
            $table->string('city')->after('address_line_2');
            $table->string('zip_code')->after('city');
            $table->string('country')->after('zip_code');
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
