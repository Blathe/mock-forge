<?php

namespace App\Livewire;

use App\Models\Endpoint;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class TestEndpointModal extends Component
{
    public Endpoint $endpoint;
    public $statusCode = '';
    public $payload = '';
    public $bearerToken = '';

    public function mount(Endpoint $endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     * @throws ConnectionException
     */
    public function render()
    {

        return view('livewire.test-endpoint-modal');
    }

    public function makeRequest()
    {
        try {
            $request = Http::when(
                $this->endpoint->require_auth && $this->bearerToken,
                fn ($http) => $http->withToken($this->bearerToken)
            );

            $response = $request->get($this->endpoint->getFullUrl());

            $this->statusCode = $response->status();
            $this->payload = json_encode($response->json(), JSON_PRETTY_PRINT);

        } catch (ConnectionException) {
            $this->statusCode = 'Connection failed';
        }
    }
}
