<form wire:submit="save" class="space-y-5">

    <!-- Header -->
    <div class="pb-1">
        <p class="text-xs font-bold text-zinc-400 dark:text-zinc-500 uppercase tracking-widest mb-1">New Endpoint</p>
        <h2 class="text-xl font-bold text-zinc-900 dark:text-white">Create an endpoint</h2>
        <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-1">Configure your mock API endpoint. All settings can be changed after creation.</p>
    </div>

    <flux:field>
        <flux:label badge="required">Description</flux:label>
        <flux:description>A short label to identify this endpoint.</flux:description>
        <flux:input wire:model="form.description" placeholder="e.g. Get All Products" />
        <flux:error name="form.description" />
    </flux:field>

    <flux:field x-data="{ slug: '' }">
        <flux:label badge="required">Slug</flux:label>
        <flux:description>The unique path for this endpoint.</flux:description>
        <flux:input.group>
            <flux:input.group.prefix>/api/{{ auth()->id() }}/</flux:input.group.prefix>
            <flux:input
                x-model="slug"
                @input="slug = $event.target.value.replace(' ', '-')"
                wire:model.live.debounce.500ms="form.slug"
                placeholder="products" />
        </flux:input.group>
        @if ($form->slug)
            <p class="text-xs font-mono text-zinc-400 dark:text-zinc-500">
                /api/{{ auth()->id() }}/{{ $form->slug }}
            </p>
        @endif
        <flux:error name="form.slug" />
    </flux:field>

    <flux:field>
        <flux:label>Status Code</flux:label>
        <flux:description>The HTTP status code this endpoint will return.</flux:description>
        <flux:select wire:model="form.status_code" class="max-w-48">
            <flux:select.option value="200">200 — OK</flux:select.option>
            <flux:select.option value="201">201 — Created</flux:select.option>
            <flux:select.option value="202">202 — Accepted</flux:select.option>
            <flux:select.option value="204">204 — No Content</flux:select.option>
            <flux:select.option value="301">301 — Moved Permanently</flux:select.option>
            <flux:select.option value="302">302 — Found</flux:select.option>
            <flux:select.option value="400">400 — Bad Request</flux:select.option>
            <flux:select.option value="401">401 — Unauthorized</flux:select.option>
            <flux:select.option value="403">403 — Forbidden</flux:select.option>
            <flux:select.option value="404">404 — Not Found</flux:select.option>
            <flux:select.option value="405">405 — Method Not Allowed</flux:select.option>
            <flux:select.option value="408">408 — Request Timeout</flux:select.option>
            <flux:select.option value="409">409 — Conflict</flux:select.option>
            <flux:select.option value="410">410 — Gone</flux:select.option>
            <flux:select.option value="422">422 — Unprocessable Entity</flux:select.option>
            <flux:select.option value="429">429 — Too Many Requests</flux:select.option>
            <flux:select.option value="500">500 — Internal Server Error</flux:select.option>
            <flux:select.option value="502">502 — Bad Gateway</flux:select.option>
            <flux:select.option value="503">503 — Service Unavailable</flux:select.option>
            <flux:select.option value="504">504 — Gateway Timeout</flux:select.option>
        </flux:select>
        <flux:error name="form.status_code" />
    </flux:field>

    <flux:field>
        <flux:label>Simulated Delay</flux:label>
        <flux:description>Add latency in milliseconds to simulate a slow response.</flux:description>
        <flux:input.group class="max-w-40">
            <flux:input wire:model="form.delay_ms" type="number" min="0" max="10000" placeholder="0" />
            <flux:input.group.suffix>ms</flux:input.group.suffix>
        </flux:input.group>
        <flux:error name="form.delay_ms" />
    </flux:field>

    <flux:field variant="inline">
        <flux:checkbox wire:model.live="form.require_auth" />
        <flux:label>Require Bearer Token</flux:label>
        <flux:description>Protect this endpoint with a custom auth token.</flux:description>
        <flux:error name="form.require_auth" />
    </flux:field>

    <flux:field wire:show="form.require_auth">
        <flux:label>Auth Token</flux:label>
        <flux:description>Requests must include this value as a Bearer token.</flux:description>
        <flux:input wire:model="form.auth_token" placeholder="my-secret-token" />
        <flux:error name="form.auth_token" />
    </flux:field>

    <flux:field variant="inline">
        <flux:checkbox wire:model="form.is_public" />
        <flux:label>Make endpoint active</flux:label>
        <flux:description>Start accepting requests immediately after creation.</flux:description>
        <flux:error name="form.is_public" />
    </flux:field>

    <!-- Actions -->
    <div class="flex items-center justify-end gap-2 pt-2 border-t border-zinc-100 dark:border-zinc-800">
        <flux:modal.close>
            <flux:button variant="ghost">Cancel</flux:button>
        </flux:modal.close>
        <flux:button variant="primary" color="emerald" type="submit" wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="save">Create Endpoint</span>
            <span wire:loading wire:target="save">Creating...</span>
        </flux:button>
    </div>

</form>
