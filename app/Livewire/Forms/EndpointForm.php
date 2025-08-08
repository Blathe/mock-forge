<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Endpoint;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EndpointForm extends Form
{

    #[Validate]
    public string $slug = '';

    #[Validate('required|string|max:128')]
    public string $description = '';

    #[Validate('required|string|in:GET,POST,PUT,PATCH,DELETE')]
    public string $method = 'GET';

    #[Validate('boolean')]
    public bool $require_auth = false;

    #[Validate('nullable|string|max:255|required_if:require_auth,true')]
    public ?string $auth_token = null;

    #[Validate('required|integer')]
    public int $status_code = 200;

    #[Validate('integer|min:0|max:10000')]
    public int $delay_ms = 0;

    #[Validate('boolean')]
    public bool $is_public = false;

    #[Validate('nullable|json')]
    public ?string $payload = '{ "hello": "world" }';

    public function rules() {
        return [
            'slug' => [
                'required',
                'string',
                'max:64',
                Rule::unique('endpoints')->where(fn ($query) => $query->where('user_id', Auth::id()))->whereNull('deleted_at'), //slugs must be unique per user, ignoring soft deleted entries.
            ],
        ];
    }

    public function submit() {
        $decoded_payload = json_decode($this->payload);
        $this->payload = json_encode($decoded_payload, JSON_PRETTY_PRINT);

        $this->validate();

        $endpoint = $this->all();
        $endpoint['user_id'] = Auth::id();

        Endpoint::create($endpoint);

        session()->flash('message', __('Endpoint created successfully.'));

        $this->reset();
        return redirect()->route('endpoints.index');
    }
}
