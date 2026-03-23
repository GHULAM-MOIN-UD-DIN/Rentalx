<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'google_id',
        'facebook_id',
        'avatar',
        'otp',
        'otp_expire',
        'is_online',
        'last_seen_at',
    ];

    /**
     * Messages sent by this user.
     */
    public function sentMessages()
    {
        return $this->hasMany(\App\Models\Message::class, 'sender_id');
    }

    /**
     * Messages received by this user.
     */
    public function receivedMessages()
    {
        return $this->hasMany(\App\Models\Message::class, 'receiver_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'otp_expire' => 'datetime',
            'last_seen_at' => 'datetime',
        ];
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Get the orders for the user.
     */
   // Add these relationships to your existing User model

public function orders()
{
    return $this->hasMany(Order::class);
}

public function reviews()
{
    return $this->hasMany(Review::class);
}

public function wishlists()
{
    return $this->hasMany(Wishlist::class);
}

public function cart()
{
    return $this->hasOne(Cart::class);
}

public function helpfulVotes()
{
    return $this->hasMany(ReviewHelpful::class);
}

// Check if user purchased a product
public function hasPurchased($productId)
{
    return $this->orders()
        ->where('status', 'delivered')
        ->whereHas('items', function($query) use ($productId) {
            $query->where('product_id', $productId);
        })->exists();
}

// Check if user already reviewed a product
public function hasReviewed($productId)
{
    return $this->reviews()
        ->where('product_id', $productId)
        ->exists();
}
    /**
     * Get the appointments for the user.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Get the contact messages for the user.
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * Get the profile for the user.
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * Get profile or create if not exists - FIXED VERSION
     */
    public function getProfileAttribute()
    {
        // Load relation if not loaded
        if (!$this->relationLoaded('profile')) {
            $this->load('profile');
        }
        
        $profile = $this->getRelation('profile');
        
        // Create profile if it doesn't exist
        if (!$profile) {
            $profile = new Profile(['user_id' => $this->id]);
            $profile->save();
            
            // Set the relation
            $this->setRelation('profile', $profile);
        }
        
        return $profile;
    }
}