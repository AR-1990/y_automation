<?php

namespace App\Services;

use App\Models\MediaClip;
use Illuminate\Http\Request;

class MediaClipService
{
    /**
     * Get paginated media clips based on status.
     */
    public function getPaginatedClips(Request $request, $status = 'pending')
    {
        return MediaClip::query()
            ->with(['matchEvent.cricketMatch', 'matchEvent.player'])
            ->where('status', $status)
            ->orderBy($request->sort_by ?? 'created_at', $request->sort_direction ?? 'desc')
            ->paginate($request->per_page ?? 12);
    }

    /**
     * Approve a clip for publishing.
     */
    public function approveClip(MediaClip $clip)
    {
        $clip->update(['status' => 'approved']);
        // Here we would dispatch a Job to actually publish to FB/IG
        // Dispatch(new PublishToSocialMediaJob($clip));
        return $clip;
    }

    /**
     * Reject a clip.
     */
    public function rejectClip(MediaClip $clip)
    {
        $clip->update(['status' => 'rejected']);
        return $clip;
    }

    /**
     * Update caption/hashtags of a clip.
     */
    public function updateClipContent(MediaClip $clip, array $data)
    {
        $clip->update([
            'caption' => $data['caption'] ?? $clip->caption,
            'hashtags' => $data['hashtags'] ?? $clip->hashtags,
        ]);
        return $clip;
    }
}
