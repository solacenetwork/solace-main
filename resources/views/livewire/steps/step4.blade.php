<div class="max-w-lg mx-auto bg-white p-8 rounded-lg border-2 border-black shadow-md">
    <div class="grid gap-4">
        <div>
            <x-label for="hid" value="House ID" />
            <x-input
                id="hid"
                wire:model="form.hid"
                type="text"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                placeholder="To be generated on submit"
                readonly
            />
        </div>

        <!-- Placeholder for Google Maps -->
        <div>
            <p class="text-sm text-gray-600">[Google Maps app here]</p>
            <p class="text-sm text-gray-600">Latitude: {{ $form['lat'] }}</p>
            <p class="text-sm text-gray-600">Longitude: {{ $form['lng'] }}</p>
        </div>

        <!-- Hidden Fields for Lat/Lng -->
        <x-input
            id="lat"
            wire:model="form.lat"
            type="hidden"
        />
        <x-input
            id="lng"
            wire:model="form.lng"
            type="hidden"
        />
    </div>
</div>