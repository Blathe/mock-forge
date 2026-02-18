<?php

namespace App\Livewire;

use App\Models\Endpoint;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
        Gate::authorize('delete', $endpoint);
        $endpoint->delete();

        session()->flash('success', __('Endpoint deleted successfully.'));

        return redirect()->route('endpoints.index');
    }

    public function toggleEndpointVisibility($id) {
        $endpoint = Endpoint::findOrFail($id);
        Gate::authorize('update', $endpoint);

        $endpoint->is_public = !$endpoint->is_public;
        $endpoint->save();

        session()->flash('message', __('Endpoint visibility updated successfully.'));

        return redirect()->route('endpoints.index');
    }

    public function search() {
        $this->endpoints = Endpoint::where('user_id', Auth::id())
            ->when($this->search_string, function ($query) {
                $query->where('slug', 'like', '%' . $this->search_string . '%')
                      ->orWhere('description', 'like', '%' . $this->search_string . '%');
            })
            ->with('latestHistory')
            ->get();
    }
}
