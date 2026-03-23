<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'phone',
        'alternate_phone',
        'date_of_birth',
        'gender',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'postal_code',
        'country',
        'profile_photo',
        'cover_photo',
        'bio',
        'occupation',
        'company',
        'website',
        'social_facebook',
        'social_twitter',
        'social_instagram',
        'social_linkedin',
        'notification_settings',
        'privacy_settings',
        'last_login_at',
        'last_login_ip',
        'login_count',
        'account_status',
        'membership_tier',
        'reward_points',
        'total_spent',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'last_login_at' => 'datetime',
        'reward_points' => 'integer',
        'total_spent' => 'decimal:2',
        'notification_settings' => 'array',
        'privacy_settings' => 'array',
    ];

    protected $appends = [
        'full_address',
        'profile_photo_url',
        'cover_photo_url',
        'membership_badge',
        'completion_percentage',
        'initials'
    ];

    /**
     * Get the user that owns the profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get full address attribute.
     */
    public function getFullAddressAttribute(): ?string
    {
        $parts = array_filter([
            $this->address_line1,
            $this->address_line2,
            $this->city,
            $this->state,
            $this->postal_code,
            $this->country
        ]);
        
        return !empty($parts) ? implode(', ', $parts) : null;
    }

    /**
     * Get profile photo URL - DIRECT FROM PUBLIC FOLDER
     */
    public function getProfilePhotoUrlAttribute(): string
    {
        if ($this->profile_photo && file_exists(public_path('profiles/' . $this->profile_photo))) {
            return asset('profiles/' . $this->profile_photo);
        }
        
        // Default avatar using UI Avatars
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->user->name ?? 'User') . 
               '&size=200&length=2&background=ef4444&color=fff&bold=true&font-size=0.40';
    }

    /**
     * Get cover photo URL - DIRECT FROM PUBLIC FOLDER
     */
    public function getCoverPhotoUrlAttribute(): string
    {
        if ($this->cover_photo && file_exists(public_path('covers/' . $this->cover_photo))) {
            return asset('covers/' . $this->cover_photo);
        }
        
        // Default cover image
        return 'https://images.unsplash.com/photo-1492144533655-ae61267b5239?q=80&w=2070&auto=format&fit=crop';
    }

    /**
     * Get membership badge.
     */
    public function getMembershipBadgeAttribute(): array
    {
        $tiers = [
            'bronze' => ['color' => 'orange-600', 'bg' => 'orange-600/20', 'icon' => 'fa-solid fa-medal', 'name' => 'Bronze'],
            'silver' => ['color' => 'gray-400', 'bg' => 'gray-400/20', 'icon' => 'fa-solid fa-medal', 'name' => 'Silver'],
            'gold' => ['color' => 'yellow-500', 'bg' => 'yellow-500/20', 'icon' => 'fa-solid fa-crown', 'name' => 'Gold'],
            'platinum' => ['color' => 'blue-400', 'bg' => 'blue-400/20', 'icon' => 'fa-solid fa-gem', 'name' => 'Platinum'],
            'diamond' => ['color' => 'purple-500', 'bg' => 'purple-500/20', 'icon' => 'fa-solid fa-star', 'name' => 'Diamond'],
        ];

        $tier = $tiers[$this->membership_tier ?? 'bronze'] ?? $tiers['bronze'];
        
        return [
            'name' => $tier['name'],
            'color' => $tier['color'],
            'bg' => $tier['bg'],
            'icon' => $tier['icon'],
            'points' => $this->reward_points ?? 0,
            'next_tier' => $this->getNextTier(),
            'points_to_next' => $this->getPointsToNextTier(),
        ];
    }

    /**
     * Get next membership tier.
     */
    protected function getNextTier(): ?string
    {
        $tiers = ['bronze', 'silver', 'gold', 'platinum', 'diamond'];
        $currentIndex = array_search($this->membership_tier ?? 'bronze', $tiers);
        
        return $tiers[$currentIndex + 1] ?? null;
    }

    /**
     * Get points needed for next tier.
     */
    protected function getPointsToNextTier(): ?int
    {
        $thresholds = [
            'silver' => 1000,
            'gold' => 5000,
            'platinum' => 10000,
            'diamond' => 25000,
        ];

        $nextTier = $this->getNextTier();
        
        if (!$nextTier || !isset($thresholds[$nextTier])) {
            return null;
        }

        $remaining = $thresholds[$nextTier] - ($this->reward_points ?? 0);
        return $remaining > 0 ? $remaining : 0;
    }

    /**
     * Get profile completion percentage.
     */
    public function getCompletionPercentageAttribute(): int
    {
        $fields = [
            'phone', 'date_of_birth', 'gender', 'address_line1', 
            'city', 'country', 'bio', 'occupation'
        ];
        
        $filled = 0;
        foreach ($fields as $field) {
            if (!empty($this->$field)) {
                $filled++;
            }
        }
        
        return (int) round(($filled / count($fields)) * 100);
    }

    /**
     * Get user initials.
     */
    public function getInitialsAttribute(): string
    {
        if (!$this->user) {
            return 'U';
        }
        
        $words = explode(' ', $this->user->name);
        $initials = '';
        
        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= strtoupper(substr($word, 0, 1));
            }
        }
        
        return substr($initials, 0, 2);
    }

    /**
     * Update login stats.
     */
    public function updateLoginStats(string $ip): void
    {
        $this->last_login_at = now();
        $this->last_login_ip = $ip;
        $this->login_count = ($this->login_count ?? 0) + 1;
        $this->save();
    }

    /**
     * Add reward points.
     */
    public function addRewardPoints(int $points): void
    {
        $this->reward_points = ($this->reward_points ?? 0) + $points;
        $this->checkMembershipUpgrade();
        $this->save();
    }

    /**
     * Check and upgrade membership based on reward points.
     */
    protected function checkMembershipUpgrade(): void
    {
        $points = $this->reward_points ?? 0;
        
        if ($points >= 25000) {
            $this->membership_tier = 'diamond';
        } elseif ($points >= 10000) {
            $this->membership_tier = 'platinum';
        } elseif ($points >= 5000) {
            $this->membership_tier = 'gold';
        } elseif ($points >= 1000) {
            $this->membership_tier = 'silver';
        } else {
            $this->membership_tier = 'bronze';
        }
    }
}