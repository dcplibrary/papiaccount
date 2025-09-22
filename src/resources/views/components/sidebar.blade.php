<flux:sidebar sticky stashable class="bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

    <flux:navlist variant="outline">
        <flux:navlist.item icon="home" wire:navigate href="/dashboard/information">Account Information</flux:navlist.item>
        <flux:navlist.item icon="inbox" wire:transition wire:navigate href="/dashboard/contact">Contact Information</flux:navlist.item>
        <flux:navlist.item icon="inbox" wire:navigate href="/dashboard/notifications">Notification Preference</flux:navlist.item>
        <flux:navlist.item icon="inbox" wire:navigate href="/dashboard/renew">Renew Account</flux:navlist.item>
    </flux:navlist>

    <div class="mt-10 w-full align-top">
        <flux:button href="/logout" icon="arrow-right-start-on-rectangle">Logout</flux:button>
    </div>
</flux:sidebar>
