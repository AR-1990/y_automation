<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MatchEvent extends Model
{
    protected $guarded = [];
    
    protected $casts = [
        'event_timestamp' => 'datetime',
    ];

    /**
     * Get the match this event belongs to.
     */
    public function cricketMatch(): BelongsTo
    {
        return $this->belongsTo(CricketMatch::class);
    }

    /**
     * Get the player involved in this event (if any).
     */
    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    /**
     * Get the media clips generated for this event.
     */
    public function mediaClips(): HasMany
    {
        return $this->hasMany(MediaClip::class);
    }
}

