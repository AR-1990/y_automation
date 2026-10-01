<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CricketMatch;
use App\Models\Player;
use App\Models\MatchEvent;
use App\Models\MediaClip;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $match = CricketMatch::create([
            'title' => 'Karachi Kings vs Lahore Qalandars - PSL 2026',
            'youtube_stream_url' => 'https://youtube.com/watch?v=demo123',
            'status' => 'live',
        ]);

        $player1 = Player::create(['name' => 'Babar Azam', 'team_name' => 'Karachi Kings']);
        $player2 = Player::create(['name' => 'Shaheen Afridi', 'team_name' => 'Lahore Qalandars']);

        // Dummy Event 1 (Pending Clip)
        $event1 = MatchEvent::create([
            'cricket_match_id' => $match->id,
            'player_id' => $player1->id,
            'event_type' => 'SIX',
            'match_time' => 'Over 14.2',
            'score_snapshot' => '124/2',
            'event_timestamp' => now()->subMinutes(5),
        ]);
        
        MediaClip::create([
            'match_event_id' => $event1->id,
            'file_path' => 'dummy_path_1.mp4',
            'caption' => 'Massive SIX by Babar Azam! 🔥 What a shot straight down the ground. #PSL #KarachiKings',
            'hashtags' => '#BabarAzam #Cricket #Six',
            'status' => 'pending'
        ]);

        // Dummy Event 2 (Pending Clip)
        $event2 = MatchEvent::create([
            'cricket_match_id' => $match->id,
            'player_id' => $player2->id,
            'event_type' => 'WICKET',
            'match_time' => 'Over 1.4',
            'score_snapshot' => '12/1',
            'event_timestamp' => now()->subMinutes(15),
        ]);
        
        MediaClip::create([
            'match_event_id' => $event2->id,
            'file_path' => 'dummy_path_2.mp4',
            'caption' => 'Shaheen strikes early! The eagle flies high. 🦅⚡️',
            'hashtags' => '#ShaheenAfridi #Wicket #PSL',
            'status' => 'pending'
        ]);

        // Dummy Event 3 (Approved Clip)
        $event3 = MatchEvent::create([
            'cricket_match_id' => $match->id,
            'player_id' => $player1->id,
            'event_type' => 'FOUR',
            'match_time' => 'Over 12.1',
            'score_snapshot' => '98/1',
            'event_timestamp' => now()->subHours(1),
        ]);
        
        MediaClip::create([
            'match_event_id' => $event3->id,
            'file_path' => 'dummy_path_3.mp4',
            'caption' => 'Classic cover drive for FOUR! Pure timing. 🏏',
            'hashtags' => '#CoverDrive #Four',
            'status' => 'approved'
        ]);
    }
}
