<div>
    <flux:main container class="flex items-center justify-items-center h-screen min-w-[100vw]">
<flux:card class="bg-white p-6 shadow-lg outline outline-black/5 dark:bg-slate-800 dark:shadow-none dark:-outline-offset-1 dark:outline-white/10">
        <div class="mr-10 ml-10">
            <x-papiaccount::logo />
            <form wire:submit.prevent="login">
                <div class="mb-6 mt-6">
                    <flux:text size="xl" variant="strong">Log in to your account</flux:text>
                </div>
                <div class="space-y-6">
                    <flux:input label="Barcode" type="text" wire:model="form.Barcode" value="{{ $Barcode ?? '' }}" placeholder="Your library card number" />
                    <flux:error name="form.Barcode" />
                    <flux:input label="PIN" type="password" wire:model="form.Password" placeholder="Your 4-6 digit PIN" />
                    <flux:error name="form.Password" />
                </div>
                <div class="mt-10">
                    <flux:button type="submit" variant="primary" class="w-full">Log in</flux:button>
                </div>
            </form>
        </div>

    </flux:card></flux:main>
</div>
