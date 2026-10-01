<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Player extends Model
{
    protected $guarded = [];

    /**
     * Get the events associated with this player.
     */
    public function matchEvents(): HasMany
    {
        return $this->hasMany(MatchEvent::class);
    }
}

