<?php

namespace App\Livewire;

use App\Models\Endpoint;
use JsonException;
use Livewire\Component;

class JsonEditor extends Component
{
    public Endpoint $endpoint;
    public string $payload = '';

    public function mount(Endpoint $endpoint) {
        $this->endpoint = $endpoint;
        $this->payload = $endpoint->payload
        ? json_encode($endpoint->payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
        : '{ }';
    }

    public function save() {
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
