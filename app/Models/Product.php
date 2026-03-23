<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'old_price',
        'category',
        'image',
        'gallery_images',
        'description',
        'specifications',
        'brand',
        'model',
        'material',
        'weight',
        'manufacturer',
        'origin',
        'stock',
        'sold_count',
        'rating',
        'reviews_count',
        'featured',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];

    protected $casts = [
        'price' => 'float',
        'old_price' => 'float',
        'stock' => 'integer',
        'sold_count' => 'integer',
        'rating' => 'float',
        'reviews_count' => 'integer',
        'featured' => 'boolean',
        'gallery_images' => 'array',
        'specifications' => 'array'
    ];

    // Relationships
    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // Helper Methods
    public function decreaseStock($quantity)
    {
        if ($this->stock >= $quantity) {
            $this->stock -= $quantity;
            $this->sold_count += $quantity;
            $this->save();
            
            // Update status if out of stock
            if ($this->stock == 0) {
                $this->status = 'out_of_stock';
                $this->save();
            }
            
            return true;
        }
        return false;
    }

    public function increaseStock($quantity)
    {
        $this->stock += $quantity;
        if ($this->stock > 0 && $this->status == 'out_of_stock') {
            $this->status = 'active';
        }
        $this->save();
        return true;
    }

    public function isInStock()
    {
        return $this->stock > 0;
    }

    public function getDiscountPercentage()
    {
        if ($this->old_price && $this->old_price > $this->price) {
            return round((($this->old_price - $this->price) / $this->old_price) * 100);
        }
        return 0;
    }

    public function updateRating()
    {
        $this->rating = $this->reviews()->avg('rating') ?? 0;
        $this->reviews_count = $this->reviews()->count();
        $this->save();
    }

    // Scopes
    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopePriceRange($query, $min, $max)
    {
        return $query->whereBetween('price', [$min, $max]);
    }

    public function scopeSearch($query, $term)
    {
        return $query->where('name', 'LIKE', "%{$term}%")
                     ->orWhere('description', 'LIKE', "%{$term}%")
                     ->orWhere('category', 'LIKE', "%{$term}%");
    }

    public function getImageUrlAttribute()
    {
        if ($this->image && file_exists(public_path('products/' . $this->image))) {
            return asset('products/' . $this->image);
        }
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=ef4444&color=fff&size=200';
    }
}