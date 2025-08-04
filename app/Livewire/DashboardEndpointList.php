<?php

namespace App\Livewire;

use App\Models\Endpoint;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class DashboardEndpointList extends Component
{
    public $endpoints = [];

    public function render()
    {
        return view('livewire.dashboard-endpoint-list');
    }

    public function deleteEndpoint($id)
    {
        $endpoint = Endpoint::findOrFail($id);
        if ($endpoint->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $endpoint->delete();

        session()->flash('message', __('Endpoint deleted successfully.'));

        return redirect()->route('endpoints.index');
    }
}
