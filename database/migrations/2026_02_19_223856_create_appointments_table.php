<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->date('pickup_date');
            $table->date('return_date');
            $table->string('delivery_location');
            $table->string('car_name');
            $table->decimal('price_per_day', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->json('addons')->nullable(); // Store selected addons as JSON
            $table->text('special_requests')->nullable();
            $table->string('status')->default('pending'); // pending, confirmed, completed, cancelled
            $table->unsignedBigInteger('car_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            // Foreign keys (optional)
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};