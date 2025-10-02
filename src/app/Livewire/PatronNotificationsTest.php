<?php

namespace Dcplibrary\PAPIAccount\App\Livewire;

use Dcplibrary\PAPIAccount\App\Concerns\ViewConcerns;
use Livewire\Attributes\Layout;
use Livewire\Component;

class PatronNotificationsTest extends Component
{
    use ViewConcerns;

    public $deliveryOptionIDCurrent;
    public $deliveryOptionIDChanged;

    public $availableDeliveryOptions = [
        'Mailing Address',
        'Email Address',
        'Phone 1',
        'TXT Messaging',
    ];
    public string $deliveryOptionName = '';
    protected $listeners = ['deliveryOptionUpdated'];
    public function mount()
    {
        // Use session value with fallback to hardcoded default
        $this->deliveryOptionIDChanged = $this->deliveryOptionIDCurrent = session('DeliveryOptionID', 8);
    }

    /**
     * Updated when the delivery option changes in the child component
     */
    public function updatedDeliveryOptionIDChanged($value)
    {
        // Update the session whenever the delivery option changes
        session(['DeliveryOptionID' => $value]);

        $this->deliveryOptionIDCurrent = $value;

        // You can add additional logic here, such as:
        // - Saving to database
        // - Logging the change
        // - Triggering other updates
    }

    #[Layout('papiaccount::components.layouts.app')]
    public function render()
    {
        return view('papiaccount::livewire.patron.notifications-test');
    }
}
