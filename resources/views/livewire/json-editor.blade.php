<div class="p-5">
    <div class="flex items-start justify-between mb-4">
        <div>
            <p class="text-xs font-bold text-zinc-400 dark:text-zinc-500 uppercase tracking-widest mb-1">Payload</p>
            <p class="text-xs text-zinc-500 dark:text-zinc-400">The JSON returned by this endpoint. Max size: {{ $max_payload_size / 1000 }}kb.</p>
        </div>
    </div>

    <!-- Hidden textarea for CodeMirror -->
    <textarea wire:model.defer="payload" id="json-editor-hidden" hidden>{{ $payload }}</textarea>

    <!-- CodeMirror editor -->
    <div wire:ignore>
        <div id="editor-container"
            class="border border-zinc-200 dark:border-zinc-700 rounded-xl mb-4 overflow-y-scroll"
            style="max-height: 600px;"
            container>
        </div>
    </div>

    <div class="flex items-center gap-2">
        <flux:button wire:click="save" variant="primary" color="emerald">Save Payload</flux:button>
        <flux:button id="prettify-btn" variant="ghost">Validate JSON</flux:button>
        @if (session()->has('success'))
            <span class="text-sm text-emerald-600 dark:text-emerald-400 font-medium flex items-center gap-1">
                <flux:icon name="check-circle" class="size-4" /> Saved
            </span>
        @endif
    </div>
</div>
