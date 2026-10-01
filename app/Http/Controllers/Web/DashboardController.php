<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index()
    {
        $eventsProcessed = \App\Models\MatchEvent::count();
        $pendingApproval = \App\Models\MediaClip::where('status', 'pending')->count();
        $published = \App\Models\MediaClip::where('status', 'published')->orWhere('status', 'approved')->count();
        $recentClips = \App\Models\MediaClip::with(['matchEvent.cricketMatch', 'matchEvent.player'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard.index', compact('eventsProcessed', 'pendingApproval', 'published', 'recentClips'));
    }
}
