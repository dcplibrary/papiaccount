<div>
    <div class="flex align-bottom">
        <flux:heading size="xl"
                      class="mt-6 flex inline-block">Contact Information</flux:heading>
        <flux:modal.trigger name="edit-contact">
            <flux:button tooltip="Edit your phone number and email address." icon="pencil-square" class="flex inline-block ml-5 mt-6"/>
        </flux:modal.trigger>
    </div>

    <flux:separator variant="subtle" class="mb-5 mt-3"/>

    {{--Address--}}
    <div class="flex flex-col lg:flex-row gap-4 lg:gap-6 mt-2.5">
        <div class="w-40 align-text-top sm:justify-items-start lg:justify-items-end">
            <flux:heading>Mailing address</flux:heading>
        </div>
        <div class="flex-1 align-text-top">
            <flux:text>{{ session('NameFirst') ?? '' }} {{ session('NameMiddle') ?? '' }} {{ session('NameLast') ?? '' }} {{ session('NameSuffix') ?? '' }}</flux:text>
            <flux:text>{{ session('StreetOne') ?? '' }}</flux:text>
            <flux:text>{{ session('StreetTwo') ?? '' }}</flux:text>
            <flux:text>{{ session('City') ?? '' }}, {{ session('State') ?? '' }} {{ session('PostalCode') ?? '' }}</flux:text>
        </div>
    </div>

    {{--Phone number--}}
    <div class="flex flex-col lg:flex-row gap-4 lg:gap-6 mt-2.5">
        <div class="w-40 align-text-top sm:justify-items-start lg:justify-items-end">
            <flux:heading>Phone number</flux:heading>
        </div>
        <div class="flex-1 align-text-top">
            <flux:text>{{ session('PhoneVoice1') ?? '' }}</flux:text>
        </div>
    </div>

    {{--Email address--}}
    <div class="flex flex-col lg:flex-row gap-4 lg:gap-6 mt-5">
        <div class="w-40 align-text-top sm:justify-items-start lg:justify-items-end">
            <flux:heading>Email address</flux:heading>
        </div>
        <div class="align-text-top">
            <flux:text>{{ session('EmailAddress') ?? '' }}</flux:text>
        </div>
    </div>

    <flux:modal name="edit-contact" class="md:w-96">
        <div class="space-y-6">
            <form wire:submit.prevent="updateContactInformation; $flux.modal('edit-contact').close()">
                <div>
                    <flux:heading size="lg">Update Contact Information</flux:heading>
                    <flux:text class="mt-2">Update your phone number or email address.</flux:text>
                </div>

                <flux:input wire:model.live="phoneNumberChanged" wire:model.blur="restorePhoneNumberCurrent" label="Phone number" value="{{ $phoneNumberCurrent ?? ''}}" />

                <flux:input wire:model="emailAddressChanged"  label="Email address" type="email" value="{{ $emailAddressCurrent ?? ''}}" />

                <div class="flex mt-4">
                    <flux:spacer />

                    <flux:button type="submit" variant="primary">Save changes</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>


</div>
