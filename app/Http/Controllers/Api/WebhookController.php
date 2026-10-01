<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\WebhookService;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    /**
     * Dummy endpoint for CricClubs Webhook simulation
     */
    public function handleCricClubs(Request $request, WebhookService $service)
    {
        // For the demo, we are skipping actual API secret validation
        // In production, we would check $request->header('Authorization') against our ApiCredential table
        
        $validated = $request->validate([
            'event_type' => 'required|string|in:SIX,FOUR,WICKET,MILESTONE_50,MILESTONE_100,BOWLING_MILESTONE_3W_4W_5W,PARTNERSHIP,INNINGS_BREAK,WINNING_RUNS',
            'match_id' => 'nullable|integer',
            'match_title' => 'nullable|string',
            'youtube_url' => 'nullable|url',
            'player_name' => 'nullable|string',
            'team_name' => 'nullable|string',
            'match_time' => 'nullable|string',
            'score_snapshot' => 'nullable|string',
        ]);

        $event = $service->processCricClubsEvent($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Event received and processing started.',
            'data' => [
                'event_id' => $event->id
            ]
        ]);
    }
}
