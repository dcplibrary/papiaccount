<div class="flex w-full min-h-screen">

    <x-papiaccount::header/>
    <x-papiaccount::sidebar/>

    <flux:main container class="max-w-xl lg:max-w-3xl">
        @if(session('isRenewable'))
            <flux:callout icon="clock">
                <flux:callout.heading>Upcoming maintenance</flux:callout.heading>

                <flux:callout.text>
                    Your account will expire in {{ session('daysToExpiration') }} day(s).
                    <flux:callout.link href="#">Please renew your account now.</flux:callout.link>
                </flux:callout.text>
            </flux:callout>
        @endif
        <livewire:dynamic-component :is="$current" :key="$current" />
    </flux:main>
</div>
