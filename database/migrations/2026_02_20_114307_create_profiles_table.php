<?php

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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            
            // Foreign key to users table
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Contact Information
            $table->string('phone')->nullable();
            $table->string('alternate_phone')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other', 'prefer_not_to_say'])->nullable();
            
            // Address Information
            $table->string('address_line1')->nullable();
            $table->string('address_line2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->nullable();
            
            // Profile Media (Direct public folder - NO STORAGE)
            $table->string('profile_photo')->nullable();
            $table->string('cover_photo')->nullable();
            
            // Professional Information
            $table->text('bio')->nullable();
            $table->string('occupation')->nullable();
            $table->string('company')->nullable();
            $table->string('website')->nullable();
            
            // Social Links
            $table->string('social_facebook')->nullable();
            $table->string('social_twitter')->nullable();
            $table->string('social_instagram')->nullable();
            $table->string('social_linkedin')->nullable();
            
            // Settings
            $table->json('notification_settings')->nullable();
            $table->json('privacy_settings')->nullable();
            
            // Login Tracking
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->integer('login_count')->default(0);
            
            // Account Status
            $table->enum('account_status', ['active', 'suspended', 'inactive'])->default('active');
            
            // Membership
            $table->enum('membership_tier', ['bronze', 'silver', 'gold', 'platinum', 'diamond'])->default('bronze');
            $table->integer('reward_points')->default(0);
            $table->decimal('total_spent', 10, 2)->default(0);
            
            $table->timestamps();
            
            // Indexes
            $table->index('user_id');
            $table->index('membership_tier');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};