<x-guest-layout>
<div class="container mt-3 px-4"> 

    <div class="max-w-5xl mx-auto w-4/5 bg-white p-8 rounded-lg border-2 border-black shadow-md">
        <h2 class="text-2xl font-bold mb-4">Google Map Component Test</h2>
        <x-google-map
            :latitude="$lat"
            :longitude="$lng"
            :address="$address"
        />
    </div>

    <form method="get" action="/test-map" class="mb-6">
        <div class="grid gap-4">
            <div>
                <label class="block">Latitude</label>
                <input type="text" name="lat" value="{{ $lat }}" class="w-full">
            </div>
            <div>
                <label class="block">Longitude</label>
                <input type="text" name="lng" value="{{ $lng }}" class="w-full">
            </div>
            <div>
                <label class="block">Address</label>
                <div class="flex gap-2">
                    <input type="text" name="address" value="{{ $address }}" class="w-full" id="address-input">
                    <button title="Geolocate this address. Coords will appear in fields above." type="button" class="bg-green-500 text-white px-4 py-2 rounded" id="geolocate-btn">Geolocate</button>
                </div>
            </div>
            <script>
            document.getElementById('geolocate-btn').addEventListener('click', function() {
                const address = document.getElementById('address-input').value;
                if (!address) return;

                const geocoder = new google.maps.Geocoder();
                geocoder.geocode({ address: address }, function(results, status) {
                    if (status === "OK") {
                        const location = results[0].geometry.location;
                        document.querySelector('input[name="lat"]').value = location.lat();
                        document.querySelector('input[name="lng"]').value = location.lng();
                    } else {
                        alert('Could not find coordinates for this address.');
                    }
                });
            });
            </script>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Test Map</button>
        </div>
    </form>
</div>
</x-guest-layout>

