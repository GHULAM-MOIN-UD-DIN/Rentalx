<?php
// database/migrations/2024_01_01_000005_update_order_items_table.php

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
        Schema::table('order_items', function (Blueprint $table) {
            // Total Price
            if (!Schema::hasColumn('order_items', 'total')) {
                $table->decimal('total', 10, 2)->after('price');
            }
            
            // Product Snapshot
            if (!Schema::hasColumn('order_items', 'product_name')) {
                $table->string('product_name')->after('product_id');
            }
            if (!Schema::hasColumn('order_items', 'product_data')) {
                $table->json('product_data')->nullable()->after('product_name')
                      ->comment('Complete product snapshot at time of order');
            }
            
            // Indexes
            $table->index('product_id');
            $table->index('order_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $columns = ['total', 'product_name', 'product_data'];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('order_items', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};