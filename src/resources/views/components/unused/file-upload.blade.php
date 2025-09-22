@props ([
"legend"=>false,
"modelName"=>false,
"label"=>false
])
<flux:fieldset>
    <flux:legend>{{ $legend }}</flux:legend>
        <flux:input class="mt-6" type="file" wire:model.live="{{ $modelName }}" label="{{ $label }}" />
        @if ($$modelName and $$modelName->isPreviewable())
            <img src="{{ $$modelName->temporaryUrl() }}">
    @endif
</flux:fieldset>
