<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'subject',
        'preferred_vehicle',
        'start_date',
        'end_date',
        'message',
        'admin_reply',
        'replied_at',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'replied_at' => 'datetime',
    ];

    /**
     * Get the user that owns the contact message.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope for user messages
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}