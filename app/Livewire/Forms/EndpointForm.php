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

    #[Validate('required|integer|in:200,201,202,204,301,302,400,401,403,404,405,408,409,410,422,429,500,502,503,504')]
    public int $status_code = 200;

    #[Validate]
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
                'regex:/^[a-z0-9][a-z0-9\-_\/]*$/',
                Rule::unique('endpoints')->where(fn ($query) => $query->where('user_id', Auth::id()))->whereNull('deleted_at'), //slugs must be unique per user, ignoring soft deleted entries.
            ],
            'delay_ms' => [
                'integer',
                'min:0',
                'max:' . config('mockforge.max_delay_ms', 10000),
            ],
        ];
    }

    public function messages() {
        return [
            'slug.regex' => 'The slug may only contain lowercase letters, numbers, hyphens, underscores, and forward slashes, and must start with a letter or number.',
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
