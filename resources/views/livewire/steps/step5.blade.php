<div class="max-w-5xl mx-auto w-4/5 bg-white p-8 rounded-lg border-2 border-black shadow-md">
    <div class="grid gap-4">

        <!-- Header -->
        <h3 class="text-xl font-semibold text-gray-900">Create a New Neighborhood</h3>

        <!-- Neighborhood Label -->
        <div>
            <x-label for="nlabel" value="Give Your Neighborhood A Name:" />
            <x-input
                id="nlabel"
                wire:model="form.nlabel"
                type="text"
                placeholder="SOLACE One"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
            />
        </div>

        <!-- Instructions -->
        <p class="text-gray-700 mt-2">
            Use the draw tool to create a shape around the houses you wish to include in your neighborhood.
            The minimum number of houses is 10, and the maximum you can select is 50.
        </p>

        <!-- Google Maps Polygon Drawing Tool -->
        <div class="relative w-full h-[550px] md:h-[500px] sm:h-[400px] border rounded-md shadow-sm">
            <div id="map" class="absolute top-0 left-0 w-full h-full"></div>
            <div id="map-loader" class="absolute inset-0 flex justify-center items-center">
                <div class="animate-spin inline-block w-10 h-10 border-4 border-t-indigo-600 border-r-indigo-600 border-b-transparent border-l-transparent rounded-full"></div>
            </div>
        </div>

        <!-- Selected House Count -->
        <p class="text-sm text-gray-600 mt-2">Houses Selected: <span id="houseCount">0</span></p>

        <!-- Hidden Geometry Field -->
        <x-input id="geometry" wire:model="form.geometry" type="hidden" />

    </div>
</div>

@push('scripts')
<script>
function initMap() {
    
    document.getElementById("map-loader").style.display = "block"; // Show spinner

    const address = "{{ $form['address1'] }}, {{ $form['address2'] }}, {{ $form['city'] }}, {{ $form['state'] }} {{ $form['zip'] }}";
    const geocoder = new google.maps.Geocoder();
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,                                   
        center: { lat: 38.624691, lng: -90.184776 } // Default (before geocoding) is Gateway Arch in St. Louis
    });

    geocoder.geocode({ address: address }, function(results, status) {
        if (status === "OK") {
            map.panTo(results[0].geometry.location);
            map.setZoom(19);

            new google.maps.Marker({
                map: map,
                position: results[0].geometry.location,
                title: "Your House",
            });

            document.getElementById("lat").value = results[0].geometry.location.lat();
            document.getElementById("lng").value = results[0].geometry.location.lng();

            document.getElementById("map-loader").style.display = "none"; // Hide spinner after loading
        } else {
            console.error("Geocode failed: " + status);
        }
    });
}
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}&libraries=drawing,geometry&callback=initMap"></script>
@endpush
