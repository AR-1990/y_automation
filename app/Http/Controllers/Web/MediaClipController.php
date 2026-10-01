<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\MediaClip;
use App\Services\MediaClipService;
use Illuminate\Http\Request;

class MediaClipController extends Controller
{
    /**
     * Display the approval dashboard (Pending Clips).
     */
    public function index(Request $request, MediaClipService $service)
    {
        $clips = $service->getPaginatedClips($request, 'pending');
        return view('clips.index', compact('clips'));
    }

    /**
     * Display published/approved clips (Highlight Library).
     */
    public function library(Request $request, MediaClipService $service)
    {
        $clips = $service->getPaginatedClips($request, 'approved');
        return view('clips.library', compact('clips'));
    }

    /**
     * Approve a clip.
     */
    public function approve(MediaClip $clip, MediaClipService $service)
    {
        $service->approveClip($clip);
        return redirect()->back()->with('success', 'Clip approved and queued for publishing!');
    }

    /**
     * Reject a clip.
     */
    public function reject(MediaClip $clip, MediaClipService $service)
    {
        $service->rejectClip($clip);
        return redirect()->back()->with('success', 'Clip rejected successfully.');
    }

    /**
     * Update clip caption/hashtags.
     */
    public function update(Request $request, MediaClip $clip, MediaClipService $service)
    {
        $validated = $request->validate([
            'caption' => 'nullable|string',
            'hashtags' => 'nullable|string',
        ]);

        $service->updateClipContent($clip, $validated);
        return redirect()->back()->with('success', 'Clip content updated successfully.');
    }
}
