<?php

namespace App\Livewire;

use App\Models\Endpoint;
use App\Models\EndpointHistory;
use Livewire\Component;

class EndpointHistoryModal extends Component
{
    public $histories;
    public Endpoint $endpoint;

    public $modal_history_count = 10;

    public function mount() {
        $this->histories = EndpointHistory::where('endpoint_id', '=', $this->endpoint->id)
        ->limit($this->modal_history_count)
        ->orderBy('created_at', 'desc')
        ->get();
    }

    public function render()
    {
        return view('livewire.endpoint-history-modal');
    }
}
