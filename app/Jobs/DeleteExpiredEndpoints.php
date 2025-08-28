<?php

namespace App\Jobs;

use App\Models\Endpoint;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

/**
 * This job hard deletes endpoints that have been soft deleted for at least 5 days.
 */
class DeleteExpiredEndpoints implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Endpoint::withTrashed()->where('deleted_at', '<=', now()->subDays(5))->forceDelete();
    }
}
