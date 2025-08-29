<?php

namespace App\Livewire;

use App\Models\Endpoint;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class TestEndpointModal extends Component
{
    public Endpoint $endpoint;
    public $statusCode = '';
    public $payload = '';

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
            $response = Http::get($this->endpoint->getFullUrl());

            $this->statusCode = $response->status();

            if ($response->successful()){
                $this->payload = json_encode($response->json(), JSON_PRETTY_PRINT);
            }

        } catch (Exception $ex) {
            dd($ex->getMessage());
        }
    }
}
