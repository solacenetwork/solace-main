<div class="max-w-5xl mx-auto w-4/5 bg-white p-8 rounded-lg border-2 border-black shadow-md">
    <div class="grid gap-4">

        <!-- Header -->
        <h3 class="text-xl font-semibold text-gray-900">Please confirm your home address</h3>

        <!-- Formatted Address -->
        <p class="text-gray-700 mt-2">
            {{ $form['address1'] }}{{ $form['address2'] ? ', ' . $form['address2'] : '' }}<br>
            {{ $form['city'] }}, {{ $form['state'] }} {{ $form['zip'] }}
        </p>

        <!-- Google Map Component -->
        <x-google-map :latitude="$form['lat']" :longitude="$form['lng']" :address="implode(', ', array_filter([$form['address1'], $form['address2'], $form['city'], $form['state'], $form['zip']]))" />

        <!-- GPS Coords -->
        <div>
            <p class="text-sm text-gray-600">Latitude: {{ $form['lat'] }}</p>
            <p class="text-sm text-gray-600">Longitude: {{ $form['lng'] }}</p>
        </div>

        <!-- Hidden fields for Latitude/Longitude -->
        <x-input id="lat" wire:model="form.lat" type="hidden" />
        <x-input id="lng" wire:model="form.lng" type="hidden" />

    </div>
</div>

@push('scripts')
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}"></script>
@endpush
