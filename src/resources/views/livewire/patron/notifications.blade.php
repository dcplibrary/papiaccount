<div>
    <div class="flex align-bottom">
        <flux:heading size="xl" class="mt-6 flex inline-block">Notification Preference</flux:heading>
        <flux:modal.trigger name="edit-notifications">
            <flux:button tooltip="Change your notification method." icon="pencil-square" class="flex inline-block ml-5 mt-6"/>
        </flux:modal.trigger>
    </div>

    <flux:separator variant="subtle" class="mb-5 mt-3"/>
    <div class="flex flex-col lg:flex-row gap-4 lg:gap-6 mt-2.5">
        <div class="w-40 align-text-top sm:justify-items-start lg:justify-items-end">
            <flux:heading>Notify me by</flux:heading>
        </div>
        <div class="flex-1 align-text-top">
            <flux:radio.group wire:model='deliveryOptionIDCurrent' disabled>
                <flux:radio value="2" label="Email"/>
                <flux:radio value="3" label="Phone"/>
                <flux:radio value="8" label="Text messaging"/>
                <flux:radio value="1" label="Mail"/>
            </flux:radio.group>

        </div>
    </div>
    <flux:modal name="edit-notifications" class="md:w-96" >
        <div class="space-y-6">
            <form name="deliveryOption" wire:submit.prevent="updateDeliveryOptionID; $flux.modal('edit-notifications').close()">
                <div>
                    <flux:heading size="lg">Update Notification Preference</flux:heading>
                    <flux:text class="mt-2">Select a notification method.</flux:text>
                </div>
                <div class="flex-1 align-text-top">
                    <flux:radio.group wire:model.live='deliveryOptionIDChanged'>
                        <flux:radio value="2" label="Email"/>
                        <flux:radio value="3" label="Phone"/>
                        <flux:radio value="8" label="Text messaging"/>
                        <flux:radio value="1" label="Mail"/>
                    </flux:radio.group>
                </div>
                <div class="flex">
                    <flux:spacer />
                    <flux:button type="submit" variant="primary">Save changes</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>


</div>
