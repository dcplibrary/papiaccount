<?php

namespace Dcplibrary\PAPIAccount\App\Livewire;

use Dcplibrary\PAPIAccount\App\Concerns\ViewConcerns;
use Livewire\Component;

class PatronContact extends Component
{
    use ViewConcerns;

    public $phoneNumberCurrent;
    public $phoneNumberChanged;
    public $emailAddressCurrent;
    public $emailAddressChanged;

    public function updateContactInformation(): void
    {
        if ($this->emailAddressCurrent != $this->emailAddressChanged) {
            $this->emailAddressCurrent = $this->emailAddressChanged;
        }

        if ($this->phoneNumberCurrent != $this->phoneNumberChanged) {
            $this->phoneNumberCurrent = $this->phoneNumberChanged;
            $this->update('PhoneVoice1', $this->phoneNumberCurrent);
        }
    }

    public function mount(): void
    {
        $this->phoneNumberChanged = $this->phoneNumberCurrent = session('PhoneVoice1');
        $this->emailAddressChanged = $this->emailAddressCurrent = session('EmailAddress');
    }

    public function render()
    {
        return view('papiaccount::livewire.patron.contact')
            ->layout('papiaccount::components.layouts.app');
    }
}
