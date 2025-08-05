<?php

namespace App\Jobs;

use App\Models\Endpoint;
use App\Models\EndpointHistory;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CreateEndpointHistory implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $endpointId;
    protected int $statusCode;
    protected float $responseTime;

    public function __construct(int $endpointId, int $statusCode, float $responseTime)
    {
        $this->endpointId = $endpointId;
        $this->statusCode = $statusCode;
        $this->responseTime = $responseTime;
    }

    public function handle(): void
    {
        $endpoint = Endpoint::find($this->endpointId);

        if (!$endpoint) {
            Log::warning("Attempted to create Endpoint History - Endpoint not found for ID: {$this->endpointId}");
            return;
        }

        $history = new EndpointHistory(['status_code' => $this->statusCode, 'response_time_ms' => $this->responseTime]);
        $endpoint->histories()->save($history);

        Log::info("History created for endpoint '{$endpoint->slug}' with status {$this->statusCode}");
    }
}
