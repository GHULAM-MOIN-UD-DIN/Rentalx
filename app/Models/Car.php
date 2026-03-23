<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'brand',
        'model',
        'price_per_day',
        'horsepower',
        'acceleration',
        'top_speed',
        'image',
        'description',
        'is_available'
    ];

    /* ===== ACCESSORS ===== */
    public function getImageUrlAttribute()
    {
        if ($this->image && file_exists(public_path('car_images/' . $this->image))) {
            return asset('car_images/' . $this->image);
        }
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->brand . ' ' . $this->model) . '&background=ef4444&color=fff&size=200';
    }
}
