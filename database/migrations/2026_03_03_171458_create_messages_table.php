<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('receiver_id');
            $table->text('body')->nullable();
            $table->enum('type', ['text', 'image', 'file', 'emoji'])->default('text');
            $table->string('file_path')->nullable();
            $table->string('file_name')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->foreign('sender_id')->references('id')->on('users')->onDelete('no action');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('no action');
            $table->index(['sender_id', 'receiver_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
