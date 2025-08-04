<form wire:submit="save">
    <p class="mb-6 text-2xl font-bold">Create Endpoint</p>
    <flux:field class="mb-4">
        <flux:label badge="required">Description</flux:label>
        <flux:description>A short description of the endpoint.</flux:description>
        <flux:input wire:model="form.description" placeholder="View All Products"/>
        <flux:error name="form.description" />
    </flux:field>

    <flux:field class="mb-4">
        <flux:label badge="required">Slug</flux:label>
        <flux:description>The endpoint slug.</flux:description>
        <flux:input.group>
            <flux:input.group.prefix>/api/user_id/</flux:input.group.prefix>
                    <flux:input wire:model="form.slug" placeholder="products" />
        </flux:input.group>
        <flux:error name="form.slug" />
    </flux:field>

    <flux:field class="mb-4">
        <flux:label>Method</flux:label>
        <flux:description>What method should this endpoint accept?</flux:description>
        <flux:select wire:model="form.method" placeholder="Choose method">
            <flux:select.option>GET</flux:select.option>
            <flux:select.option>POST</flux:select.option>
            <flux:select.option>PUT</flux:select.option>
            <flux:select.option>DELETE</flux:select.option>
        </flux:select>
        <flux:error name="form.method" />
    </flux:field>

    <flux:field class="mb-4">
        <flux:label>Delay (ms)</flux:label>
        <flux:description>Add a delay (in milliseconds) to simulate a slow endpoint. Useful for verifying animations and placeholders.</flux:description>
        <flux:input.group>
            <flux:input wire:model="form.delay_ms"/>
            <flux:input.group.suffix>ms</flux:input.group.suffix>
        </flux:input.group>
        <flux:error name="form.delay_ms" />
    </flux:field>

    <flux:field class="mb-4">
        <flux:label>Status Code</flux:label>
        <flux:description>What status code should this endpoint return?</flux:description>
        <flux:select wire:model="form.status_code" placeholder="Choose code">
            <flux:select.option>200</flux:select.option>
            <flux:select.option>404</flux:select.option>
            <flux:select.option>500</flux:select.option>
        </flux:select>
        <flux:error name="form.status_code" />
    </flux:field>

    <flux:field variant="inline" class="mb-4">
        <flux:checkbox wire:model="form.requires_auth" />
        <flux:label>Require auth?</flux:label>
        <flux:description>Simulate authenticated calls to this endpoint.</flux:description>
        <flux:error name="form.requires_auth" />
    </flux:field>

    <flux:field class="mb-4" wire:show="form.requires_auth">
        <flux:label>Auth token</flux:label>
        <flux:description>Give this endpoint a custom auth token to simulate authenticated calls.</flux:description>
        <flux:input wire:model="form.auth_token"/>
        <flux:error name="form.auth_token" />
    </flux:field>

    <flux:field variant="inline" class="mb-4">
        <flux:checkbox wire:model="form.is_public" />
        <flux:label>Set public?</flux:label>
        <flux:description>Set this endpoint public so you can make requests to it.</flux:description>

        <flux:error name="form.is_public" />
    </flux:field>

    <flux:field class="mb-4">
        <flux:label>JSON Payload</flux:label>
        <flux:description>Enter the JSON payload you want this endpoint to return.</flux:description>

        <flux:textarea
            wire:model="form.payload"
            rows="auto"
            placeholder="
            {
                'key': 'value'
            }"
        />

        <flux:error name="form.payload" />
    </flux:field>

    <flux:button variant="primary" color="green" type="submit">Create Endpoint</flux:button>
</form>
