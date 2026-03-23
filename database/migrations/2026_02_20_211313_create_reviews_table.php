<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            
            // Order ID - NO foreign key constraint (SQL Server circular path issue)
            $table->unsignedBigInteger('order_id')->nullable();
            
            $table->tinyInteger('rating');
            $table->string('title', 255)->nullable();
            $table->text('comment');
            
            // JSON fields - NVARCHAR for SQL Server
            $table->string('pros', 4000)->nullable();
            $table->string('cons', 4000)->nullable();
            $table->string('images', 4000)->nullable();
            
            $table->boolean('verified_purchase')->default(false);
            $table->string('status', 20)->default('pending');
            
            // Approval columns
            $table->dateTime('approved_at')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->dateTime('rejected_at')->nullable();
            $table->unsignedBigInteger('rejected_by')->nullable();
            $table->text('rejection_reason')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index(['product_id', 'status']);
            $table->index(['user_id', 'product_id']);
            $table->index('status');
            $table->index('order_id');
        });
        
        // Foreign keys separately add karein (NO ACTION for SQL Server)
        Schema::table('reviews', function (Blueprint $table) {
            // Approved by user
            $table->foreign('approved_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('no action');
                  
            // Rejected by user      
            $table->foreign('rejected_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('no action');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};