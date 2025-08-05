<?php

namespace App\Livewire;

use App\Models\Endpoint;
use App\Models\EndpointHistory;
use Livewire\Component;

class EndpointHistoryModal extends Component
{
    public $histories;
    public Endpoint $endpoint;

    public function mount() {
        $this->histories = EndpointHistory::where('endpoint_id', '=', $this->endpoint->id)
        ->with('endpoint')
        ->limit(20)
        ->orderBy('created_at', 'desc')
        ->get();
    }

    public function render()
    {
        return view('livewire.endpoint-history-modal');
    }
}
