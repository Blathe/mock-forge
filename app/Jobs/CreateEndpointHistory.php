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

    public function __construct(
        public int $endpoint_id,
        public int $status_code,
        public float $response_time,
        public int $payload_size
    ) {}

    public function handle(): void
    {
        //TODO: Should I just pass the entire endpoint object instead??
        $endpoint = Endpoint::find($this->endpoint_id);

        if (!$endpoint) {
            Log::error("Attempted to create Endpoint History - Endpoint not found for ID: $this->endpoint_id");
            return;
        }

        $history = new EndpointHistory([
            'status_code' => $this->status_code,
            'response_time_ms' => $this->response_time,
            'payload_size' => $this->payload_size
        ]);

        $endpoint->histories()->save($history);

        Log::info("History created for endpoint '$endpoint->slug' with status $this->status_code");
    }
}
