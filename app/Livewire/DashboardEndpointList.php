<?php

namespace App\Livewire;

use App\Models\Endpoint;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class DashboardEndpointList extends Component
{
    public $endpoints = [];

    public $search_string = '';
    public $filter_status = 'all';

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

    public function search() {
        $this->endpoints = Endpoint::where('user_id', Auth::id())
            ->when($this->search_string, function ($query) {
                $query->where('slug', 'like', '%' . $this->search_string . '%')
                      ->orWhere('description', 'like', '%' . $this->search_string . '%');
            })
            ->get();
    }
}
