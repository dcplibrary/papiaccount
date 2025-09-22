<div>
    <flux:heading size="xl" class="mt-6">Account Information</flux:heading>

    <flux:separator variant="subtle" class="mb-5 mt-3"/>

    {{--Patron name--}}
    <div class="flex flex-col lg:flex-row gap-4 lg:gap-6 mt-2.5">
        <div class="w-40 align-text-top sm:justify-items-start lg:justify-items-end">
            <flux:heading>Name</flux:heading>
        </div>
        <div class="flex-1 align-text-top">
            <flux:text>{{ session('NameFirst') ?? '' }} {{ session('NameMiddle') ?? '' }} {{ session('NameLast') ?? '' }} {{ session('NameSuffix') ?? '' }}</flux:text>
        </div>
    </div>

    {{--Birthdate--}}
    <div class="flex flex-col lg:flex-row gap-4 lg:gap-6 mt-2.5">
        <div class="w-40 align-text-top sm:justify-items-start lg:justify-items-end">
            <flux:heading>Birthdate</flux:heading>
        </div>
        <div class="flex-1 align-text-top">
            <flux:text>{{ session('displayableBirthDate') ?? '' }}</flux:text>
        </div>
    </div>

    {{--Card number--}}
    <div class="flex flex-col lg:flex-row gap-4 lg:gap-6 mt-5">
        <div class="w-40 align-text-top sm:justify-items-start lg:justify-items-end">
            <flux:heading>Account number</flux:heading>
        </div>
        <div class="align-text-top">
            <flux:text>{{ session('Barcode') ?? '' }}</flux:text>
        </div>
    </div>

    {{--Patron type--}}
    <div class="flex flex-col lg:flex-row gap-4 lg:gap-6 mt-2.5">
        <div class="w-40 align-text-top sm:justify-items-start lg:justify-items-end">
            <flux:heading>Card type</flux:heading>
        </div>
        <div class="align-text-top">
            <flux:text>{{ session('patronCode') ?? '' }}</flux:text>
        </div>
    </div>

    {{--Registration date--}}
    <div class="flex flex-col lg:flex-row gap-4 lg:gap-6 mt-5">
        <div class="w-40 align-text-top sm:justify-items-start lg:justify-items-end">
            <flux:heading>Registration date</flux:heading>
        </div>
        <div class="align-text-top">
            <flux:text>{{ session('displayableRegistrationDate') ?? '' }}</flux:text>
        </div>
    </div>

    {{--Expiration date--}}
    <div class="flex flex-col lg:flex-row gap-4 lg:gap-6 mt-2.5 mb-10">
        <div class="w-40 align-text-top sm:justify-items-start lg:justify-items-end">
            <flux:heading>Card expires on</flux:heading>
        </div>
        <div class="align-text-top">
            <flux:text>{{ session('displayableExpirationDate') ?? '' }}</flux:text>
        </div>
    </div>
</div>
