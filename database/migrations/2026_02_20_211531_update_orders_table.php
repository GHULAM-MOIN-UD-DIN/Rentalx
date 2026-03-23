<?php
// database/migrations/2024_01_01_000004_update_orders_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Order Number
            if (!Schema::hasColumn('orders', 'order_number')) {
                $table->string('order_number')->unique()->after('id');
            }
            
            // Financial Details
            if (!Schema::hasColumn('orders', 'subtotal')) {
                $table->decimal('subtotal', 10, 2)->default(0)->after('total_amount');
            }
            if (!Schema::hasColumn('orders', 'tax')) {
                $table->decimal('tax', 10, 2)->default(0)->after('subtotal');
            }
            if (!Schema::hasColumn('orders', 'shipping_cost')) {
                $table->decimal('shipping_cost', 10, 2)->default(0)->after('tax');
            }
            if (!Schema::hasColumn('orders', 'discount')) {
                $table->decimal('discount', 10, 2)->default(0)->after('shipping_cost');
            }
            if (!Schema::hasColumn('orders', 'coupon_code')) {
                $table->string('coupon_code')->nullable()->after('discount');
            }
            
            // Payment Details
            if (!Schema::hasColumn('orders', 'payment_method')) {
                $table->string('payment_method')->nullable()->after('coupon_code');
            }
            if (!Schema::hasColumn('orders', 'payment_status')) {
                $table->enum('payment_status', ['pending', 'paid', 'failed', 'refunded'])
                      ->default('pending')->after('payment_method');
            }
            
            // Addresses
            if (!Schema::hasColumn('orders', 'shipping_address')) {
                $table->json('shipping_address')->nullable()->after('payment_status');
            }
            if (!Schema::hasColumn('orders', 'billing_address')) {
                $table->json('billing_address')->nullable()->after('shipping_address');
            }
            
            // Additional Info
            if (!Schema::hasColumn('orders', 'notes')) {
                $table->text('notes')->nullable()->after('billing_address');
            }
            if (!Schema::hasColumn('orders', 'tracking_number')) {
                $table->string('tracking_number')->nullable()->after('notes');
            }
            
            // Indexes
            $table->index('order_number');
            $table->index('payment_status');
            $table->index('status');
            $table->index('user_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $columns = [
                'order_number', 'subtotal', 'tax', 'shipping_cost',
                'discount', 'coupon_code', 'payment_method',
                'payment_status', 'shipping_address', 'billing_address',
                'notes', 'tracking_number'
            ];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('orders', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};