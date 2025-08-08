<?php

namespace App\Livewire;

use App\Models\Endpoint;
use JsonException;
use Livewire\Component;

class JsonEditor extends Component
{
    public Endpoint $endpoint;
    public string $payload = '';

    public int $max_payload_size = 25000; //TODO: maybe make this an ENV var?

    public function mount(Endpoint $endpoint) {
        $this->endpoint = $endpoint;
        $this->payload = $endpoint->payload
        ? json_encode($endpoint->payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
        : '{ }';
    }

    public function save() {
        if (strlen($this->payload) > $this->max_payload_size) {
            session()->flash('error', 'JSON payload is too large. It must be under 25kb.');
            return;
        }

        try {
            $parsed = json_decode($this->payload, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            $this->addError('json', 'Invalid JSON: ' . $exception->getMessage());
            return;
        }

        $this->endpoint->payload = $parsed;
        $this->endpoint->save();

        session()->flash('success', 'JSON Payload saved!');
    }

    public function render()
    {
        return view('livewire.json-editor');
    }
}
