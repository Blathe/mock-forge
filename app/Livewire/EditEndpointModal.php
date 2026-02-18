<?php

namespace App\Livewire;

use App\Models\Endpoint;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditEndpointModal extends Component
{
    public Endpoint $endpoint;

    public string $description = '';
    public string $slug = '';
    public string $method = 'GET';
    public int $status_code = 200;
    public int $delay_ms = 0;
    public bool $require_auth = false;
    public ?string $auth_token = null;
    public bool $is_public = false;

    public function mount(Endpoint $endpoint)
    {
        $this->endpoint    = $endpoint;
        $this->description = $endpoint->description;
        $this->slug        = $endpoint->slug;
        $this->method      = $endpoint->method;
        $this->status_code = $endpoint->status_code;
        $this->delay_ms    = $endpoint->delay_ms ?? 0;
        $this->require_auth = $endpoint->require_auth;
        $this->auth_token  = $endpoint->auth_token;
        $this->is_public   = $endpoint->is_public;
    }

    protected function rules(): array
    {
        return [
            'description' => ['required', 'string', 'max:128'],
            'slug' => [
                'required',
                'string',
                'max:64',
                'regex:/^[a-z0-9][a-z0-9\-_\/]*$/',
                Rule::unique('endpoints')
                    ->ignore($this->endpoint->id)
                    ->where(fn ($q) => $q->where('user_id', $this->endpoint->user_id))
                    ->whereNull('deleted_at'),
            ],
            'method'      => ['required', 'string', 'in:GET,POST,PUT,PATCH,DELETE'],
            'status_code' => ['required', 'integer', 'in:200,201,202,204,301,302,400,401,403,404,405,408,409,410,422,429,500,502,503,504'],
            'delay_ms'    => ['integer', 'min:0', 'max:' . config('mockforge.max_delay_ms', 10000)],
            'require_auth' => ['boolean'],
            'auth_token'  => ['nullable', 'string', 'max:255', 'required_if:require_auth,true'],
            'is_public'   => ['boolean'],
        ];
    }

    protected function messages(): array
    {
        return [
            'slug.regex' => 'The slug may only contain lowercase letters, numbers, hyphens, underscores, and forward slashes, and must start with a letter or number.',
        ];
    }

    public function save()
    {
        Gate::authorize('update', $this->endpoint);

        $validated = $this->validate();

        $this->endpoint->fill($validated)->save();

        session()->flash('success', 'Endpoint updated successfully.');

        return redirect()->route('endpoints.show', $this->endpoint->id);
    }

    public function render()
    {
        return view('livewire.edit-endpoint-modal');
    }
}
