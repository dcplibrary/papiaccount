# PatronLocationTest Component

A comprehensive test component for the Dcplibrary\PAPIAccount package that demonstrates the integration of both `PatronUDFSelectFlux` and `PostalCodeSelectFlux` components from the PAPIClient package.

## Overview

The `PatronLocationTest` component serves as a live testing environment and integration example for:

- **PatronUDFSelectFlux**: Dynamic User Defined Field selection (School, Department, etc.)
- **PostalCodeSelectFlux**: Location selection with comprehensive postal code data
- **DeliveryOptionSelectFlux**: Notification delivery method selection
- **Real-time Event Monitoring**: Live display of all component interactions
- **Session Management**: Demonstrates persistent state across page loads

## File Locations

```
/src/app/Livewire/PatronLocationTest.php
/src/resources/views/livewire/patron/location-test.blade.php
```

## Features

### 🎯 **Component Integration**
- **Multiple UDF Fields**: Demonstrates both School and Department UDF selection
- **Location Selection**: Full postal code integration with multiple display formats
- **Delivery Options**: Complete form workflow integration
- **Cross-component Communication**: Shows how components work together

### 📊 **Real-time Monitoring**
- **Event Log**: Live display of all component events with timestamps
- **Session Tracking**: Real-time display of session values
- **Component State**: Current state of all component properties
- **Form Validation**: Live validation status updates

### 🧪 **Testing Features**
- **Quick Test Scenarios**: Pre-configured test value combinations
- **Display Format Testing**: Switch between different postal code formats
- **Form Submission**: Complete workflow testing
- **Reset Functionality**: Clean slate for new tests

## Usage

### Accessing the Component

Add a route to your web.php file:

```php
Route::get('/patron-location-test', PatronLocationTest::class)
    ->name('patron.location.test');
```

### Component Structure

#### Event Listeners

The component demonstrates proper event handling for all three Flux components:

```php
#[On('patronUdfUpdated')]
public function handlePatronUdfUpdate($data)
{
    // Handles School and Department selections
    match($data['label']) {
        'School' => $this->selectedSchool = $data['value'],
        'Department' => $this->selectedDepartment = $data['value'],
        default => null
    };
}

#[On('postalCodeUpdated')]
public function handlePostalCodeUpdate($data)
{
    // Handles location data with full address information
    $this->userCity = $data['city'];
    $this->userState = $data['state'];
    $this->userPostalCode = $data['postalCode'];
    // ... etc
}

#[On('deliveryOptionUpdated')]
public function handleDeliveryOptionUpdate($data)
{
    // Handles delivery method selection
    $this->deliveryOptionIDCurrent = $data['deliveryOptionId'];
}
```

#### Session Management

Demonstrates proper session integration:

```php
// Initialize from session
$this->selectedSchool = session('PatronUDF_School', '');
$this->selectedPostalCode = session('PostalCodeID', null);
$this->deliveryOptionIDChanged = session('DeliveryOptionID', 8);

// Update session on changes
public function updatedSelectedPostalCode($value)
{
    session(['PostalCodeID' => $value]);
}
```

## Testing Scenarios

### Manual Testing
1. **Select School**: Choose from available school levels
2. **Select Department**: Choose from available departments (optional)
3. **Select Location**: Choose from postal codes with different display formats
4. **Select Delivery**: Choose notification delivery method
5. **Submit Form**: Test complete workflow
6. **Monitor Events**: Watch real-time event log

### Quick Test Buttons
- **Elementary + Mail**: Sets Elementary School + Mailing Address delivery
- **High School + Email**: Sets High School + Email delivery  
- **College + Phone**: Sets College + Phone delivery
- **Adult + Text**: Sets Adult Education + Text messaging delivery

### Display Format Testing
Switch between postal code display formats:
- **City, State ZIP**: "Denver, CO 80202"
- **City ZIP**: "Denver 80202" 
- **Full**: "Denver, CO 80202 (Denver County)"

## Event Data Structures

### PatronUDF Events
```json
{
  "label": "School",
  "value": "High School", 
  "displayName": "High School"
}
```

### PostalCode Events
```json
{
  "id": 123,
  "postalCodeId": 456,
  "city": "Denver",
  "state": "CO",
  "postalCode": "80202",
  "county": "Denver County",
  "countryId": 1,
  "displayText": "Denver, CO 80202"
}
```

### DeliveryOption Events
```json
{
  "deliveryOptionId": 2,
  "deliveryOption": "Email Address",
  "displayName": "Email"
}
```

## Development Integration

### Using as Template

Copy the patterns from PatronLocationTest for your own components:

```php
// 1. Event Listeners
#[On('patronUdfUpdated')]
public function handlePatronUdfUpdate($data) { /* ... */ }

// 2. Session Management  
public function updatedSelectedValue($value) {
    session(['key' => $value]);
}

// 3. Component Integration
<livewire:patron-udf-select-flux 
    wire:model="selectedValue"
    :patron-udf-label="'YourLabel'"
    :selected-patron-udf-changed="$selectedValue"
/>
```

### Production Implementation

For production use:

1. **Remove Debug Elements**: Remove event log, test buttons, debug panels
2. **Add Validation**: Implement proper form validation rules  
3. **Add Database Logic**: Save form submissions to database
4. **Add Error Handling**: Handle component failures gracefully
5. **Style Integration**: Integrate with your design system

## Troubleshooting

### Components Not Loading
- Verify PAPIClient package is installed and up to date
- Check component registration in service providers
- Ensure database models exist and are accessible

### Events Not Firing
- Verify Livewire attributes syntax: `#[On('eventName')]`
- Check component is properly instantiated
- Ensure session middleware is active

### Session Not Persisting
- Verify Laravel session configuration
- Check session driver settings
- Ensure session storage is writable

### Database Issues
- Verify postal_codes table exists and has data
- Check patron_udfs table exists and has UDF records
- Ensure delivery_options table is seeded

## Examples

### Basic Integration
```blade
{{-- Minimal integration example --}}
<livewire:patron-udf-select-flux 
    wire:model="school"
    patron-udf-label="School"
/>

<livewire:postal-code-select-flux 
    wire:model="location"
    display-format="city_state_zip"
/>
```

### Advanced Integration
```blade
{{-- With all options --}}
<livewire:postal-code-select-flux 
    wire:model="selectedPostalCode"
    :selected-postal-code-changed="$selectedPostalCode"
    :display-format="$displayFormat"
    :filters="['State' => 'CO']"
    placeholder="Choose Colorado location"
    :attrs="['class' => 'w-full custom-select']"
/>
```

## Related Documentation

- [PAPIClient Package README](../../papiclient/README.md)
- [Component Testing Guide](../../papiclient/examples/INTEGRATION_GUIDE.md)
- [PatronUDFSelectFlux Documentation](../../papiclient/README.md#patronudfselectflux)
- [PostalCodeSelectFlux Documentation](../../papiclient/README.md#postalcodeselectflux)