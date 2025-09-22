<div>
    <div class="flex">
        <flux:heading size="xl" class="mt-6 flex inline-block">Renew Your Account</flux:heading>
    </div>
    <flux:separator variant="subtle" class="mb-5 mt-3"/>

        @if(!session('photoUploaded'))
            <div class="flex flex-col lg:flex-row gap-4 lg:gap-6 mt-2.5">
            <div class="w-40 align-text-top sm:justify-items-start lg:justify-items-end">
                <flux:text>A government-issued photo ID is required to verify your eligibility.
                </flux:text>
                <flux:text class="mt-5"> We will contact you once your account is renewed.
                </flux:text>
            </div>
            <div class="flex-1 align-text-top">
                <form method="post" wire:submit.prevent="save" >
                    <flux:fieldset>
                        <flux:legend>Upload Photo ID</flux:legend>
                        <flux:input class="mt-6" type="file" wire:model.live="photo"
                                    label="Upload an image of your driver's license or other government-issued photo ID" />
                        @if ($photo and $photo->isPreviewable())
                            <img src="{{ $photo->temporaryUrl() }}">
                        @endif
                    </flux:fieldset>
                    @if($photo)
                        <flux:button type="submit">Submit</flux:button>
                    @endif
                </form>
            </div>
            </div>
        @else
            <flux:heading>
                Thank you!  Your request to renew your card has been submitted.
            </flux:heading>
            <flux:text class="mt-4 inline">
                Next, we will review your information and verify that your card is eligible for renewal.
                You will receive an email within 14 days from</flux:text><flux:text class="inline space-y-1" variant="strong">&nbsp;ecard@dcplibrary.org&nbsp;</flux:text><flux:text class="inline"> with your card status.
                We may contact you if we require further information.
            </flux:text>
        @endif
</div>
