<?php

namespace App\Http\Controllers;

use App\Models\Endpoint;
use Illuminate\Http\Request;

class EndpointController extends Controller
{
    public function index(Request $request)
    {
        $endpoints = $request->user()->endpoints()->get();
        return view('endpoints.index', compact('endpoints'));
    }

    public function create()
    {
        return view('endpoints.create');
    }

    public function delete($id) {
        $endpoint = Endpoint::findOrFail($id);
        $endpoint->delete();

        session()->flash('message', __('Endpoint deleted successfully.'));

        return redirect()->route('endpoints.index');
    }
}
