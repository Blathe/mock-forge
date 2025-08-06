<?php

namespace App\Http\Controllers;

use App\Models\Endpoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EndpointController extends Controller
{
    public function index(Request $request)
    {
        $endpoints = Endpoint::where('user_id', Auth::id())
            ->orderBy('created_at')
            ->with('histories')->orderBy('created_at', 'desc')
            ->get();
        return view('endpoints.index', compact('endpoints'));
    }

    public function create()
    {
        return view('endpoints.create');
    }

    public function show($id, Request $request)
    {
        $endpoint = Endpoint::findOrFail($id);

        if ($request->user()->cannot('update', $endpoint)) {
            abort(403);
        }

        return view('endpoints.show', compact('endpoint'));
    }

    public function delete($id) {
        $endpoint = Endpoint::findOrFail($id);
        $endpoint->delete();

        session()->flash('message', __('Endpoint deleted successfully.'));

        return redirect()->route('endpoints.index');
    }
}
