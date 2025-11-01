<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('shipping_name')->nullable()->after('customer_email');
            $table->string('shipping_address')->nullable();
            $table->string('shipping_postal_code')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_country')->default('BE');
            $table->string('shipping_phone')->nullable();
            $table->text('shipping_notes')->nullable();
            $table->decimal('shipping_cost', 10, 2)->default(0);
            $table->string('tracking_number')->nullable();
            $table->timestamp('shipped_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'shipping_name',
                'shipping_address',
                'shipping_postal_code',
                'shipping_city',
                'shipping_country',
                'shipping_phone',
                'shipping_notes',
                'shipping_cost',
                'tracking_number',
                'shipped_at'
            ]);
        });
    }
};