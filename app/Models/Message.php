<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'body',
        'type',
        'file_path',
        'file_name',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    /**
     * The user who sent the message.
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * The user who received the message.
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    /**
     * Messages between two specific users.
     */
    public function scopeBetween($query, $userA, $userB)
    {
        return $query->where(function ($q) use ($userA, $userB) {
            $q->where('sender_id', $userA)->where('receiver_id', $userB);
        })->orWhere(function ($q) use ($userA, $userB) {
            $q->where('sender_id', $userB)->where('receiver_id', $userA);
        });
    }

    /**
     * Unread messages.
     */
    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }

    /**
     * Check if message has a file.
     */
    public function hasFile(): bool
    {
        return !empty($this->file_path);
    }

    /**
     * Get file URL.
     */
    public function getFileUrlAttribute(): ?string
    {
        return $this->file_path ? asset('storage/' . $this->file_path) : null;
    }
}
