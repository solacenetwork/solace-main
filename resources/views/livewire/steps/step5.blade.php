<div class="max-w-lg mx-auto bg-white p-8 rounded-lg border-2 border-black shadow-md">
    <div class="grid gap-4">
        <div>
            <x-label for="nid" value="Neighborhood ID" />
            <x-input
                id="nid"
                wire:model="form.nid"
                type="text"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                placeholder="To be generated on submit"
                readonly
            />
        </div>

        <!-- Placeholder for Google Maps -->
        <div>
            <p class="text-sm text-gray-600">[Google Maps app here]</p>
            <p class="text-sm text-gray-600">Neighborhood Label: {{ $form['nlabel'] }}</p>
            <p class="text-sm text-gray-600">Geometry: {{ $form['geometry'] }}</p>
        </div>

        <!-- Hidden Fields for nlabel, geometry -->
        <x-input
            id="nlabel"
            wire:model="form.nlabel"
            type="hidden"
        />
        <x-input
            id="geometry"
            wire:model="form.geometry"
            type="hidden"
        />
    </div>
</div>