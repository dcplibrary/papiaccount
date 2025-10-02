<div class="max-w-2xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">Delivery Options Test</h2>
    
    {{-- Show session feedback messages --}}
    @if(session('message'))
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif
    
    {{-- Display current session and component values --}}
    <div class="bg-gray-100 p-4 rounded-lg mb-6">
        <h3 class="font-semibold mb-2">Current Values:</h3>
        <ul class="space-y-1 text-sm">
            <li><strong>Session Value:</strong> {{ session('DeliveryOptionID', 'Not set') }}</li>
            <li><strong>Component Current:</strong> {{ $deliveryOptionIDCurrent ?? 'Not set' }}</li>
            <li><strong>Component Changed:</strong> {{ $deliveryOptionIDChanged ?? 'Not set' }}</li>
        </ul>
    </div>
    
    {{-- The delivery option selector --}}
    <div class="mb-6">
        <livewire:delivery-option-select-flux 
            wire:model="deliveryOptionIDChanged" 
            :delivery-option-i-d-changed="$deliveryOptionIDChanged" 
        />
    </div>
    
    {{-- Test links for setting session values --}}
    <div class="border-t pt-4">
        <h3 class="font-semibold mb-3">Test Session Values:</h3>
        <div class="flex flex-wrap gap-2">
            <a href="{{ url('set-delivery-option/1') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-xs">
                Set Mail (1)
            </a>
            <a href="{{ url('set-delivery-option/2') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-xs">
                Set Email (2)
            </a>
            <a href="{{ url('set-delivery-option/3') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded text-xs">
                Set Phone (3)
            </a>
            <a href="{{ url('set-delivery-option/8') }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded text-xs">
                Set Text Messaging (8)
            </a>
            <a href="{{ url('clear-delivery-option') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded text-xs">
                Clear Session
            </a>
        </div>
        <p class="text-xs text-gray-600 mt-2">
            Use these links to test different session values. The component will remember your choice.
        </p>
    </div>
</div>
