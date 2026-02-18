<?php

namespace App\Jobs;

use App\Models\Endpoint;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

/**
 * Soft-deletes endpoints older than the configured expiry threshold, then
 * hard-deletes records that have been soft-deleted beyond the retention period.
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
     * 1. Soft-delete active endpoints past the expiry threshold.
     * 2. Hard-delete endpoints past the soft-delete retention period.
     */
    public function handle(): void
    {
        Endpoint::expired()->delete();

        Endpoint::withTrashed()->where('deleted_at', '<=', now()->subDays(config('mockforge.soft_delete_retention_days', 5)))->forceDelete();
    }
}
