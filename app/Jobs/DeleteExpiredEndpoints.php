<?php

namespace App\Jobs;

use App\Models\Endpoint;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

/**
 * Soft-deletes endpoints older than 7 days, then hard-deletes records
 * that have been soft-deleted for at least 5 days.
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
     *
     * 1. Soft-delete active endpoints that are over 7 days old.
     * 2. Hard-delete endpoints that have been soft-deleted for 5+ days.
     */
    public function handle(): void
    {
        Endpoint::expired()->delete();

        Endpoint::withTrashed()->where('deleted_at', '<=', now()->subDays(5))->forceDelete();
    }
}
