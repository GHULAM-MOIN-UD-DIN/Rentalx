<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'total',
        'product_name',
        'product_data'
    ];

    protected $casts = [
        'price' => 'float',
        'total' => 'float',
        'product_data' => 'array'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Boot method to handle stock
    protected static function boot()
    {
        parent::boot();

        static::created(function ($orderItem) {
            // Decrease stock when order item is created
            if ($orderItem->product) {
                $orderItem->product->decreaseStock($orderItem->quantity);
            }
        });

        static::deleted(function ($orderItem) {
            // Increase stock when order item is deleted/cancelled
            if ($orderItem->product) {
                $orderItem->product->increaseStock($orderItem->quantity);
            }
        });
    }
}