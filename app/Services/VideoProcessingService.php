<?php

namespace App\Services;

use App\Models\MatchEvent;
use App\Models\MediaClip;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VideoProcessingService
{
    /**
     * POC: Generate a dummy processed video clip for an event.
     * In real life, this will run yt-dlp first, then FFmpeg to crop and overlay text.
     */
    public function processEventClip(MatchEvent $event)
    {
        Log::info("Starting video processing for Event ID: " . $event->id);

        // Define output path
        $fileName = 'clip_' . $event->id . '_' . Str::random(5) . '.mp4';
        $outputPath = 'public/clips/' . $fileName; // storage/app/public/clips/
        
        // Ensure directory exists
        Storage::makeDirectory('public/clips');
        
        // -------------------------------------------------------------
        // TODO (Future Real Implementation):
        // 1. Get YouTube URL from $event->cricketMatch->youtube_stream_url
        // 2. Fetch last 30 seconds using yt-dlp into a raw_clip.mp4
        // 3. Run FFmpeg command:
        //    ffmpeg -i raw_clip.mp4 -vf "crop=ih*(9/16):ih,drawtext=text='Score: $score':fontcolor=white..." processed.mp4
        // -------------------------------------------------------------

        // For POC: Since we don't have yt-dlp/ffmpeg installed on the server yet, 
        // we will just create a dummy file to simulate the output.
        // In real world, we wait for Process::run('ffmpeg ...') to finish.
        
        Storage::put($outputPath, 'Dummy video binary data simulation');

        // Create MediaClip record
        $clip = MediaClip::create([
            'match_event_id' => $event->id,
            'file_path' => 'clips/' . $fileName, // Accessible via storage/clips/...
            'caption' => $this->generateAiCaption($event),
            'hashtags' => $this->generateHashtags($event),
            'status' => 'pending'
        ]);

        Log::info("Video clip processed and ready for approval. Clip ID: " . $clip->id);

        return $clip;
    }

    /**
     * Simple dummy function to mimic AI generating captions.
     */
    private function generateAiCaption(MatchEvent $event)
    {
        $playerName = $event->player ? $event->player->name : 'A Player';
        $team = $event->player ? $event->player->team_name : '';
        
        return match ($event->event_type) {
            'SIX' => "Massive SIX by {$playerName}! 🔥 Absolute power hitting.",
            'FOUR' => "Beautiful boundary by {$playerName}! 🏏 Classic shot.",
            'WICKET' => "WICKET! {$playerName} has to walk back. What a moment in the game!",
            'MILESTONE_50' => "Brilliant HALF-CENTURY for {$playerName}! 👏 Outstanding innings.",
            default => "Incredible moment from the match! Don't miss this."
        };
    }

    private function generateHashtags(MatchEvent $event)
    {
        $playerName = str_replace(' ', '', $event->player ? $event->player->name : 'Cricket');
        return "#{$playerName} #Cricket #Live #{$event->event_type}";
    }
}
