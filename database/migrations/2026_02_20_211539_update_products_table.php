<?php
// database/migrations/2024_01_01_000003_update_products_table.php

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
        Schema::table('products', function (Blueprint $table) {
            // Sales Tracking
            if (!Schema::hasColumn('products', 'sold_count')) {
                $table->integer('sold_count')->default(0)->after('stock')->comment('Total units sold');
            }
            
            // Pricing
            if (!Schema::hasColumn('products', 'old_price')) {
                $table->decimal('old_price', 10, 2)->nullable()->after('price');
            }
            
            // Ratings
            if (!Schema::hasColumn('products', 'rating')) {
                $table->decimal('rating', 3, 2)->default(0)->after('sold_count');
            }
            if (!Schema::hasColumn('products', 'reviews_count')) {
                $table->integer('reviews_count')->default(0)->after('rating');
            }
            
            // Media
            if (!Schema::hasColumn('products', 'gallery_images')) {
                $table->json('gallery_images')->nullable()->after('image');
            }
            
            // Specifications
            if (!Schema::hasColumn('products', 'specifications')) {
                $table->json('specifications')->nullable()->after('description');
            }
            
            // Product Details
            if (!Schema::hasColumn('products', 'brand')) {
                $table->string('brand')->nullable()->after('category');
            }
            if (!Schema::hasColumn('products', 'model')) {
                $table->string('model')->nullable()->after('brand');
            }
            if (!Schema::hasColumn('products', 'material')) {
                $table->string('material')->nullable()->after('model');
            }
            if (!Schema::hasColumn('products', 'weight')) {
                $table->string('weight')->nullable()->after('material');
            }
            if (!Schema::hasColumn('products', 'manufacturer')) {
                $table->string('manufacturer')->nullable()->after('weight');
            }
            if (!Schema::hasColumn('products', 'origin')) {
                $table->string('origin')->nullable()->after('manufacturer');
            }
            
            // Status Flags
            if (!Schema::hasColumn('products', 'featured')) {
                $table->boolean('featured')->default(false)->after('origin');
            }
            if (!Schema::hasColumn('products', 'status')) {
                $table->enum('status', ['active', 'out_of_stock', 'discontinued'])->default('active')->after('featured');
            }
            
            // SEO Fields
            if (!Schema::hasColumn('products', 'meta_title')) {
                $table->string('meta_title')->nullable()->after('status');
            }
            if (!Schema::hasColumn('products', 'meta_description')) {
                $table->text('meta_description')->nullable()->after('meta_title');
            }
            if (!Schema::hasColumn('products', 'meta_keywords')) {
                $table->string('meta_keywords')->nullable()->after('meta_description');
            }
            
            // Indexes for better performance
            $table->index('sold_count');
            $table->index('rating');
            $table->index('featured');
            $table->index('status');
            $table->index('brand');
            $table->index(['category', 'status']);
            $table->index(['price', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $columns = [
                'sold_count', 'old_price', 'rating', 'reviews_count',
                'gallery_images', 'specifications', 'brand', 'model',
                'material', 'weight', 'manufacturer', 'origin',
                'featured', 'status', 'meta_title', 'meta_description',
                'meta_keywords'
            ];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('products', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};