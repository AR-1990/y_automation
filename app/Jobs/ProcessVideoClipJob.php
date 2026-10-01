<?php

namespace App\Jobs;

use App\Models\MatchEvent;
use App\Services\VideoProcessingService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessVideoClipJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $event;

    /**
     * Create a new job instance.
     */
    public function __construct(MatchEvent $event)
    {
        $this->event = $event;
    }

    /**
     * Execute the job.
     */
    public function handle(VideoProcessingService $service): void
    {
        try {
            $service->processEventClip($this->event);
        } catch (\Exception $e) {
            Log::error("Failed to process video clip for Event ID: {$this->event->id}. Error: " . $e->getMessage());
            $this->fail($e);
        }
    }
}
