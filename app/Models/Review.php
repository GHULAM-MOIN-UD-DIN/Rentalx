<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    protected $fillable = [
        'user_id',
        'product_id',
        'order_id',
        'rating',
        'title',
        'comment',
        'pros',
        'cons',
        'images',
        'verified_purchase',
        'status',
        'approved_at',
        'approved_by',
        'rejected_at',
        'rejected_by',
        'rejection_reason'
    ];

    protected $casts = [
        'rating' => 'integer',
        'verified_purchase' => 'boolean',
        'images' => 'array',
        'pros' => 'array',      // SQL Server mein JSON ke liye
        'cons' => 'array',      // SQL Server mein JSON ke liye
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime'
    ];

    // SQL Server ke liye JSON handling
    public function setProsAttribute($value)
    {
        if (is_array($value)) {
            // Empty array ko null save karo SQL Server issues se bachne ke liye
            $this->attributes['pros'] = empty($value) ? null : json_encode($value, JSON_UNESCAPED_UNICODE);
        } else {
            $this->attributes['pros'] = $value;
        }
    }

    public function setConsAttribute($value)
    {
        if (is_array($value)) {
            // Empty array ko null save karo
            $this->attributes['cons'] = empty($value) ? null : json_encode($value, JSON_UNESCAPED_UNICODE);
        } else {
            $this->attributes['cons'] = $value;
        }
    }

    public function setImagesAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['images'] = empty($value) ? null : json_encode($value, JSON_UNESCAPED_UNICODE);
        } else {
            $this->attributes['images'] = $value;
        }
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function helpfulVotes()
    {
        return $this->hasMany(ReviewHelpful::class);
    }

    // Helper Methods
    public function markAsHelpful($userId)
    {
        return $this->helpfulVotes()->firstOrCreate(['user_id' => $userId]);
    }

    public function getHelpfulCount()
    {
        return $this->helpfulVotes()->count();
    }

    // Scopes
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeVerifiedPurchases($query)
    {
        return $query->where('verified_purchase', true);
    }

    public function scopeByRating($query, $rating)
    {
        return $query->where('rating', $rating);
    }
}