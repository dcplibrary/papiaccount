<?php

namespace Dcplibrary\PAPIAccount\App\Livewire;

use Dcplibrary\PAPIAccount\App\Concerns\ViewConcerns;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class PatronLocationTest extends Component
{
    use ViewConcerns;

    // Patron UDF (School) Properties
    public $selectedSchool = '';
    public $selectedDepartment = '';
    public $patronUdfSchoolLabel = 'School';
    public $patronUdfDepartmentLabel = 'Department';
    
    // Postal Code Properties
    public $selectedPostalCode = null;
    public $selectedPostalCodeCurrent = null;
    public $userCity = '';
    public $userState = '';
    public $userPostalCode = '';
    public $userCounty = '';
    public $userCountryId = null;
    public $displayFormat = 'city_state_zip';
    
    // Delivery Option Properties (for complete form testing)
    public $deliveryOptionIDChanged = null;
    public $deliveryOptionIDCurrent = null;
    
    // Form State
    public $isFormValid = false;
    public $statusMessage = '';
    public $testResults = [];

    public function mount()
    {
        // Initialize Patron UDF values from session
        $this->selectedSchool = session('PatronUDF_School', '');
        $this->selectedDepartment = session('PatronUDF_Department', '');
        
        // Initialize Postal Code values from session
        $this->selectedPostalCode = $this->selectedPostalCodeCurrent = session('PostalCodeID', null);
        
        // Initialize Delivery Option from session
        $this->deliveryOptionIDChanged = $this->deliveryOptionIDCurrent = session('DeliveryOptionID', 8);
        
        // Load existing postal code details if available
        if ($this->selectedPostalCode) {
            $this->loadPostalCodeDetails();
        }
        
        // Validate form on mount
        $this->validateForm();
    }

    /**
     * Listen for Patron UDF updates (School selection)
     */
    #[On('patronUdfUpdated')]
    public function handlePatronUdfUpdate($data)
    {
        $this->testResults[] = [
            'timestamp' => now()->format('H:i:s'),
            'event' => 'patronUdfUpdated',
            'data' => $data
        ];
        
        // Update the appropriate property based on the label
        match($data['label']) {
            'School' => $this->selectedSchool = $data['value'],
            'Department' => $this->selectedDepartment = $data['value'],
            default => null
        };
        
        $this->statusMessage = "Updated {$data['label']}: {$data['displayName']}";
        $this->validateForm();
    }

    /**
     * Listen for Postal Code updates
     */
    #[On('postalCodeUpdated')]
    public function handlePostalCodeUpdate($data)
    {
        $this->testResults[] = [
            'timestamp' => now()->format('H:i:s'),
            'event' => 'postalCodeUpdated',
            'data' => $data
        ];
        
        // Update local properties with comprehensive postal code data
        $this->userCity = $data['city'];
        $this->userState = $data['state'];
        $this->userPostalCode = $data['postalCode'];
        $this->userCounty = $data['county'] ?? '';
        $this->userCountryId = $data['countryId'] ?? null;
        $this->selectedPostalCodeCurrent = $data['id'];
        
        $this->statusMessage = "Updated location: {$data['displayText']}";
        $this->validateForm();
        
        // Trigger location-specific logic
        $this->updateLocationSettings($data);
    }

    /**
     * Listen for Delivery Option updates
     */
    #[On('deliveryOptionUpdated')]
    public function handleDeliveryOptionUpdate($data)
    {
        $this->testResults[] = [
            'timestamp' => now()->format('H:i:s'),
            'event' => 'deliveryOptionUpdated',
            'data' => $data
        ];
        
        $this->deliveryOptionIDCurrent = $data['deliveryOptionId'];
        $this->statusMessage = "Updated delivery method: {$data['displayName']}";
        $this->validateForm();
    }

    /**
     * Handle changes to selected postal code (wire:model binding)
     */
    public function updatedSelectedPostalCode($value)
    {
        session(['PostalCodeID' => $value]);
        $this->selectedPostalCodeCurrent = $value;
        
        if ($value) {
            $this->loadPostalCodeDetails();
        } else {
            $this->clearLocationData();
        }
        
        $this->validateForm();
    }

    /**
     * Handle changes to delivery option (wire:model binding)
     */
    public function updatedDeliveryOptionIDChanged($value)
    {
        session(['DeliveryOptionID' => $value]);
        $this->deliveryOptionIDCurrent = $value;
        $this->validateForm();
    }

    /**
     * Load postal code details from database if we have a selection
     */
    private function loadPostalCodeDetails()
    {
        if ($this->selectedPostalCode) {
            try {
                $postalCodeData = \Blashbrook\PAPIClient\Models\PostalCode::find($this->selectedPostalCode);
                
                if ($postalCodeData) {
                    $this->userCity = $postalCodeData->City;
                    $this->userState = $postalCodeData->State;
                    $this->userPostalCode = $postalCodeData->PostalCode;
                    $this->userCounty = $postalCodeData->County ?? '';
                    $this->userCountryId = $postalCodeData->CountryID ?? null;
                }
            } catch (\Exception $e) {
                $this->statusMessage = "Error loading postal code details: " . $e->getMessage();
            }
        }
    }

    /**
     * Clear location data
     */
    private function clearLocationData()
    {
        $this->userCity = '';
        $this->userState = '';
        $this->userPostalCode = '';
        $this->userCounty = '';
        $this->userCountryId = null;
    }

    /**
     * Update location-specific settings
     */
    private function updateLocationSettings($postalData)
    {
        // Example: Location-specific logic
        if ($postalData['state'] === 'CO') {
            $this->statusMessage .= " (Colorado resident - special programs available)";
        }
        
        // Log location change for debugging
        logger('Location updated in PatronLocationTest', $postalData);
    }

    /**
     * Validate the form based on current selections
     */
    private function validateForm()
    {
        $this->isFormValid = !empty($this->selectedSchool) && 
                           !empty($this->selectedPostalCode) && 
                           !empty($this->deliveryOptionIDChanged);
    }

    /**
     * Test method to simulate form submission
     */
    public function submitTestForm()
    {
        $this->validate([
            'selectedSchool' => 'required',
            'selectedPostalCode' => 'required',
            'deliveryOptionIDChanged' => 'required',
        ], [
            'selectedSchool.required' => 'Please select a school',
            'selectedPostalCode.required' => 'Please select a location', 
            'deliveryOptionIDChanged.required' => 'Please select a delivery method',
        ]);

        // Process the form submission
        $formData = [
            'school' => $this->selectedSchool,
            'department' => $this->selectedDepartment,
            'postal_code_id' => $this->selectedPostalCode,
            'city' => $this->userCity,
            'state' => $this->userState,
            'postal_code' => $this->userPostalCode,
            'county' => $this->userCounty,
            'delivery_option_id' => $this->deliveryOptionIDChanged,
            'timestamp' => now()->toISOString()
        ];

        $this->testResults[] = [
            'timestamp' => now()->format('H:i:s'),
            'event' => 'formSubmitted',
            'data' => $formData
        ];

        session()->flash('success', 'Test form submitted successfully!');
        $this->statusMessage = 'Form submitted with all component data';
    }

    /**
     * Reset all form data and sessions
     */
    public function resetForm()
    {
        $this->reset([
            'selectedSchool',
            'selectedDepartment',
            'selectedPostalCode', 
            'selectedPostalCodeCurrent',
            'userCity',
            'userState',
            'userPostalCode',
            'userCounty',
            'userCountryId',
            'deliveryOptionIDChanged',
            'deliveryOptionIDCurrent',
            'statusMessage',
            'testResults'
        ]);
        
        // Clear all relevant sessions
        session()->forget([
            'PatronUDF_School',
            'PatronUDF_Department', 
            'PostalCodeID',
            'DeliveryOptionID'
        ]);
        
        session()->flash('info', 'All form data and sessions have been reset');
        $this->validateForm();
    }

    /**
     * Clear test results
     */
    public function clearTestResults()
    {
        $this->testResults = [];
        $this->statusMessage = 'Test results cleared';
    }

    /**
     * Test method to set specific values programmatically
     */
    public function setTestValues($school = 'High School', $state = 'CO', $deliveryOption = 8)
    {
        // Set school via session
        session(['PatronUDF_School' => $school]);
        $this->selectedSchool = $school;
        
        // Set delivery option via session
        session(['DeliveryOptionID' => $deliveryOption]);
        $this->deliveryOptionIDChanged = $this->deliveryOptionIDCurrent = $deliveryOption;
        
        $this->statusMessage = "Test values set: School={$school}, DeliveryOption={$deliveryOption}";
        $this->validateForm();
    }

    /**
     * Change display format for postal code component
     */
    public function changeDisplayFormat($format)
    {
        $this->displayFormat = $format;
        $this->statusMessage = "Changed postal code display format to: {$format}";
    }

    #[Layout('papiaccount::components.layouts.app')]
    public function render()
    {
        return view('papiaccount::livewire.patron.location-test');
    }
}