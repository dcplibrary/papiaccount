<?php

namespace Dcplibrary\PAPIAccount\App\Livewire;

use Dcplibrary\PAPIAccount\App\Concerns\ViewConcerns;
use Livewire\Component;

class PatronNotifications extends Component
{
    use ViewConcerns;

    public $deliveryOptionIDCurrent;
    public $deliveryOptionIDChanged;

    public function updateDeliveryOptionID(): void
    {
        if ($this->deliveryOptionIDCurrent != $this->deliveryOptionIDChanged) {
            $this->deliveryOptionIDCurrent = $this->deliveryOptionIDChanged;
            $this->update('DeliveryOptionID', $this->deliveryOptionIDCurrent);
        }

    }

    public function mount()
    {
        $this->deliveryOptionIDChanged = $this->deliveryOptionIDCurrent = session('DeliveryOptionID');
    }
    public function render()
    {
        return view('papiaccount::livewire.patron.notifications');
    }
}
