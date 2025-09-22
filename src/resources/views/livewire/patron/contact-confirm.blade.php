<div>
   {{ $token }}
    <flux:button wire:click="confirm" value="Confirm"/>
    {{ $success ?? '' }}
</div>
