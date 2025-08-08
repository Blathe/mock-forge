<div>
    <flux:heading size="lg" class="mb-4">
        Payload
        <flux:text>The payload that will be returned from this endpoint. Max payload size is 25kb.</flux:text>
    </flux:heading>

    <!-- Hidden text area for codemirror -->
    <textarea wire:model.defer="payload" id="json-editor-hidden" hidden></textarea>

    <!-- The codemirror editor -->
    <div wire:ignore>
        <div id="editor-container" class="border border-black/30 dark:border-white/30 rounded mb-4 overflow-y-scroll" style="max-height: 700px;" container></div>
    </div>

    <div class="flex gap-2 mt-4">
        <flux:button wire:click="save" variant="primary" color="green">Save</flux:button>
        <flux:button id="prettify-btn" variant="subtle" color="blue">Validate JSON</flux:button>
    </div>

    @if (session()->has('success'))
        <p class="text-green-600">{{ session('success') }}</p>
    @endif
</div>
