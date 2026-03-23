<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_number',
        'total_amount',
        'subtotal',
        'tax',
        'shipping_cost',
        'discount',
        'coupon_code',
        'payment_method',
        'payment_status',
        'status',
        'shipping_address',
        'billing_address',
        'notes',
        'tracking_number'
    ];

    protected $casts = [
        'total_amount' => 'float',
        'subtotal' => 'float',
        'tax' => 'float',
        'shipping_cost' => 'float',
        'discount' => 'float',
        'shipping_address' => 'array',
        'billing_address' => 'array'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Boot method to generate order number
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($order) {
            $order->order_number = 'ORD-' . strtoupper(uniqid());
        });
    }

    // Helper Methods
    public function updateStatus($status)
    {
        $this->status = $status;
        $this->save();
    }

    public function markAsPaid()
    {
        $this->payment_status = 'paid';
        $this->save();
    }

    public function canBeReviewed()
    {
        return $this->status === 'delivered' && $this->payment_status === 'paid';
    }
}