<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'pickup_date',
        'return_date',
        'delivery_location',
        'car_name',
        'price_per_day',
        'total_price',
        'addons',
        'special_requests',
        'status',
        'car_id',
        'user_id'  // This connects to user
    ];

    protected $casts = [
        'pickup_date' => 'date',
        'return_date' => 'date',
        'addons' => 'array',
        'price_per_day' => 'decimal:2',
        'total_price' => 'decimal:2'
    ];

    // Relationships
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    /**
     * Get the user that owns the appointment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Calculate number of days
    public function getDaysAttribute()
    {
        return $this->pickup_date->diffInDays($this->return_date) + 1;
    }

    // Get full name attribute
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    // Scope for filtering
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeDateRange($query, $start, $end)
    {
        return $query->whereBetween('pickup_date', [$start, $end])
                     ->orWhereBetween('return_date', [$start, $end]);
    }

    /**
     * Scope for user appointments
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}