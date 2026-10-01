<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MediaClip extends Model
{
    protected $guarded = [];

    /**
     * Get the match event associated with this clip.
     */
    public function matchEvent(): BelongsTo
    {
        return $this->belongsTo(MatchEvent::class);
    }
}

