<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Patron Location & UDF Test</h1>
    <p class="text-gray-600 mb-8">This page tests the integration of PatronUDFSelectFlux and PostalCodeSelectFlux components with real-time event monitoring.</p>
    
    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            <strong>Success:</strong> {{ session('success') }}
        </div>
    @endif
    
    @if(session('info'))
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-6">
            <strong>Info:</strong> {{ session('info') }}
        </div>
    @endif

    {{-- Status Message --}}
    @if($statusMessage)
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-6">
            <strong>Status:</strong> {{ $statusMessage }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        {{-- Left Column: Form Components --}}
        <div class="space-y-8">
            
            {{-- Form Validation Status --}}
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="font-semibold mb-2 flex items-center">
                    Form Status
                    @if($isFormValid)
                        <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            ✓ Valid
                        </span>
                    @else
                        <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            ✗ Incomplete
                        </span>
                    @endif
                </h3>
                <div class="text-sm space-y-1">
                    <p><strong>School Selected:</strong> {{ $selectedSchool ?: 'None' }}</p>
                    <p><strong>Department Selected:</strong> {{ $selectedDepartment ?: 'None' }}</p>
                    <p><strong>Location Selected:</strong> {{ $userCity ? "{$userCity}, {$userState} {$userPostalCode}" : 'None' }}</p>
                    <p><strong>Delivery Method:</strong> {{ $deliveryOptionIDCurrent ?: 'None' }}</p>
                </div>
            </div>

            {{-- Patron UDF Components --}}
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold mb-4">Patron Information</h3>
                
                {{-- School Selection --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        School Level
                    </label>
{{--                    <livewire:patron-udf-select-flux
                        wire:model="selectedSchool"
                        :patron-udf-label="$patronUdfSchoolLabel"
                        :selected-patron-udf-changed="$selectedSchool"
                        placeholder="Select your school level"
                        :attrs="['class' => 'w-full']"
                    />--}}
                    @error('selectedSchool')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Department Selection --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Department (Optional)
                    </label>
{{--                    <livewire:patron-udf-select-flux --}}
{{--                        wire:model="selectedDepartment"--}}
{{--                        :patron-udf-label="$patronUdfDepartmentLabel"--}}
{{--                        :selected-patron-udf-changed="$selectedDepartment"--}}
{{--                        placeholder="Select your department"--}}
{{--                        :attrs="['class' => 'w-full']"--}}
{{--                    />--}}
                </div>
            </div>

            {{-- Postal Code Component --}}
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold mb-4">Location Information</h3>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Select Your Location
                    </label>
{{--                    <livewire:postal-code-select-flux
                        wire:model="selectedPostalCode"
                        :selected-postal-code-changed="$selectedPostalCode"
                        :display-format="$displayFormat"
                        placeholder="Choose your city and postal code"
                        :attrs="['class' => 'w-full']"
                    />--}}
                    @error('selectedPostalCode')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Display Format Options --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Display Format:</label>
                    <div class="flex flex-wrap gap-2">
                        <button 
                            wire:click="changeDisplayFormat('city_state_zip')"
                            class="px-3 py-1 text-xs rounded {{ $displayFormat === 'city_state_zip' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}"
                        >
                            City, State ZIP
                        </button>
                        <button 
                            wire:click="changeDisplayFormat('city_zip')"
                            class="px-3 py-1 text-xs rounded {{ $displayFormat === 'city_zip' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}"
                        >
                            City ZIP
                        </button>
                        <button 
                            wire:click="changeDisplayFormat('full')"
                            class="px-3 py-1 text-xs rounded {{ $displayFormat === 'full' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}"
                        >
                            Full
                        </button>
                    </div>
                </div>

                {{-- Location Details Display --}}
                @if($userCity && $userState)
                    <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                        <h4 class="font-semibold text-blue-800 mb-2">Selected Location Details:</h4>
                        <div class="text-blue-700 text-sm space-y-1">
                            <p><strong>City:</strong> {{ $userCity }}</p>
                            <p><strong>State:</strong> {{ $userState }}</p>
                            <p><strong>ZIP Code:</strong> {{ $userPostalCode }}</p>
                            @if($userCounty)
                                <p><strong>County:</strong> {{ $userCounty }}</p>
                            @endif
                            @if($userCountryId)
                                <p><strong>Country ID:</strong> {{ $userCountryId }}</p>
                            @endif
                            <p><strong>Database ID:</strong> {{ $selectedPostalCode }}</p>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Delivery Options Component --}}
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold mb-4">Delivery Preferences</h3>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        How should we contact you?
                    </label>
                    <livewire:delivery-option-select-flux 
                        wire:model="deliveryOptionIDChanged"
                        :delivery-option-i-d-changed="$deliveryOptionIDChanged"
                    />
                    @error('deliveryOptionIDChanged')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold mb-4">Actions</h3>
                
                <div class="flex flex-wrap gap-3">
                    <button 
                        wire:click="submitTestForm"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 disabled:opacity-50 disabled:cursor-not-allowed"
                        @if(!$isFormValid) disabled @endif
                    >
                        Submit Test Form
                    </button>
                    
                    <button 
                        wire:click="resetForm"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700"
                    >
                        Reset All
                    </button>
                    
                    <button 
                        wire:click="setTestValues('College', 'CO', 2)"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
                    >
                        Set Test Values
                    </button>
                    
                    <button 
                        wire:click="clearTestResults"
                        class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700"
                    >
                        Clear Events
                    </button>
                </div>
            </div>
        </div>

        {{-- Right Column: Debug Information --}}
        <div class="space-y-8">
            
            {{-- Session Values --}}
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold mb-4">Session Values</h3>
                <div class="text-sm space-y-2">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <strong>School:</strong><br>
                            <code class="bg-gray-100 px-2 py-1 rounded">{{ session('PatronUDF_School', 'Not set') }}</code>
                        </div>
                        <div>
                            <strong>Department:</strong><br>
                            <code class="bg-gray-100 px-2 py-1 rounded">{{ session('PatronUDF_Department', 'Not set') }}</code>
                        </div>
                        <div>
                            <strong>Postal Code ID:</strong><br>
                            <code class="bg-gray-100 px-2 py-1 rounded">{{ session('PostalCodeID', 'Not set') }}</code>
                        </div>
                        <div>
                            <strong>Delivery Option:</strong><br>
                            <code class="bg-gray-100 px-2 py-1 rounded">{{ session('DeliveryOptionID', 'Not set') }}</code>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Component State --}}
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold mb-4">Component State</h3>
                <div class="text-sm space-y-2">
                    <p><strong>School Selected:</strong> <code class="bg-gray-100 px-2 py-1 rounded">{{ $selectedSchool ?: 'null' }}</code></p>
                    <p><strong>Department Selected:</strong> <code class="bg-gray-100 px-2 py-1 rounded">{{ $selectedDepartment ?: 'null' }}</code></p>
                    <p><strong>Postal Code ID:</strong> <code class="bg-gray-100 px-2 py-1 rounded">{{ $selectedPostalCode ?: 'null' }}</code></p>
                    <p><strong>Postal Code Current:</strong> <code class="bg-gray-100 px-2 py-1 rounded">{{ $selectedPostalCodeCurrent ?: 'null' }}</code></p>
                    <p><strong>Delivery Option:</strong> <code class="bg-gray-100 px-2 py-1 rounded">{{ $deliveryOptionIDChanged ?: 'null' }}</code></p>
                    <p><strong>Delivery Current:</strong> <code class="bg-gray-100 px-2 py-1 rounded">{{ $deliveryOptionIDCurrent ?: 'null' }}</code></p>
                    <p><strong>Display Format:</strong> <code class="bg-gray-100 px-2 py-1 rounded">{{ $displayFormat }}</code></p>
                </div>
            </div>

            {{-- Event Log --}}
            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold">Event Log</h3>
                    <span class="text-sm text-gray-600">{{ count($testResults) }} events</span>
                </div>
                
                @if(count($testResults) > 0)
                    <div class="max-h-96 overflow-y-auto">
                        @foreach(array_reverse($testResults) as $index => $result)
                            <div class="mb-4 p-3 border rounded {{ 
                                $result['event'] === 'patronUdfUpdated' ? 'border-blue-200 bg-blue-50' : 
                                ($result['event'] === 'postalCodeUpdated' ? 'border-green-200 bg-green-50' : 
                                ($result['event'] === 'deliveryOptionUpdated' ? 'border-purple-200 bg-purple-50' : 'border-gray-200 bg-gray-50'))
                            }}">
                                <div class="flex justify-between items-start mb-2">
                                    <span class="font-medium text-sm {{ 
                                        $result['event'] === 'patronUdfUpdated' ? 'text-blue-800' : 
                                        ($result['event'] === 'postalCodeUpdated' ? 'text-green-800' : 
                                        ($result['event'] === 'deliveryOptionUpdated' ? 'text-purple-800' : 'text-gray-800'))
                                    }}">
                                        {{ ucfirst(str_replace(['Updated', 'updated'], '', $result['event'])) }}
                                    </span>
                                    <span class="text-xs text-gray-500">{{ $result['timestamp'] }}</span>
                                </div>
                                
                                <details class="text-xs">
                                    <summary class="cursor-pointer text-gray-600 hover:text-gray-800">
                                        View Data
                                    </summary>
                                    <pre class="mt-2 p-2 bg-gray-100 rounded overflow-x-auto">{{ json_encode($result['data'], JSON_PRETTY_PRINT) }}</pre>
                                </details>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-sm">No events yet. Interact with the components above to see events here.</p>
                @endif
            </div>

            {{-- Test Links --}}
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold mb-4">Quick Tests</h3>
                <p class="text-sm text-gray-600 mb-4">Use these buttons to quickly test different scenarios:</p>
                
                <div class="grid grid-cols-2 gap-2 text-sm">
                    <button 
                        wire:click="setTestValues('Elementary School', 'CO', 1)"
                        class="px-3 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
                    >
                        Elementary + Mail
                    </button>
                    <button 
                        wire:click="setTestValues('High School', 'CA', 2)"
                        class="px-3 py-2 bg-green-500 text-white rounded hover:bg-green-600"
                    >
                        High School + Email
                    </button>
                    <button 
                        wire:click="setTestValues('College', 'NY', 3)"
                        class="px-3 py-2 bg-purple-500 text-white rounded hover:bg-purple-600"
                    >
                        College + Phone
                    </button>
                    <button 
                        wire:click="setTestValues('Adult Education', 'TX', 8)"
                        class="px-3 py-2 bg-red-500 text-white rounded hover:bg-red-600"
                    >
                        Adult + Text
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>