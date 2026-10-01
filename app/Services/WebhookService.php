<?php

namespace App\Services;

use App\Models\CricketMatch;
use App\Models\MatchEvent;
use App\Models\Player;
use Illuminate\Support\Facades\Log;

class WebhookService
{
    /**
     * Process incoming dummy webhook data from CricClubs simulation.
     */
    public function processCricClubsEvent(array $payload)
    {
        Log::info('Received CricClubs Event', $payload);

        // 1. Find or create the match
        $match = CricketMatch::firstOrCreate(
            ['id' => $payload['match_id'] ?? 1],
            [
                'title' => $payload['match_title'] ?? 'Dummy Match',
                'status' => 'live',
                'youtube_stream_url' => $payload['youtube_url'] ?? 'https://youtube.com/watch?v=dummy'
            ]
        );

        // 2. Find or create the player
        $player = null;
        if (!empty($payload['player_name'])) {
            $player = Player::firstOrCreate(
                ['name' => $payload['player_name']],
                ['team_name' => $payload['team_name'] ?? 'Unknown Team']
            );
        }

        // 3. Record the Event
        $event = MatchEvent::create([
            'cricket_match_id' => $match->id,
            'player_id' => $player ? $player->id : null,
            'event_type' => $payload['event_type'],
            'match_time' => $payload['match_time'] ?? null,
            'score_snapshot' => $payload['score_snapshot'] ?? null,
            'event_timestamp' => now(), // In real scenario, use payload timestamp
        ]);

        // 4. Here we would dispatch the FFmpeg job
        // Dispatch(new ExtractVideoClipJob($event));
        
        return $event;
    }
}
