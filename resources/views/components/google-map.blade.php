<!-- Google Maps -->
<div wire:ignore style="position: relative; width: 100%; height: 400px;">
    <!-- map container -->
    <div id="map" style="width:100%; height:100%;"></div>
    <!-- overlay spinner -->
    <div id="map-loader" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.8); display: flex; justify-content: center; align-items: center;">
        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-gray-900"></div>
    </div>
</div>

<script>
let map;
let marker;

function initMap() {
    console.log('initMap called');

    const mapElement = document.getElementById("map");
    const spinner = document.getElementById("map-loader");

    if (!mapElement || !spinner) {
        console.error('Missing required elements: map or spinner');
        if (spinner) spinner.style.display = 'none'; // Fallback
        return;
    }

    const address = "{{ $address }}";
    const lat = "{{ $latitude }}";
    const lng = "{{ $longitude }}";

    console.log('address:', address);
    console.log('latitude:', lat);
    console.log('longitude:', lng);

    map = new google.maps.Map(mapElement, {
        zoom: 15,
        center: { lat: {{ $latitude }}, lng: {{ $longitude }} },
    });

    // Listen for the 'tilesloaded' event
    google.maps.event.addListenerOnce(map, 'tilesloaded', function() {
        console.log('Map tiles loaded, hiding spinner');
        document.getElementById('map-loader').style.display = 'none';
    });

    // Geocoder logic
    const geocoder = new google.maps.Geocoder();
    if (address) {
        geocoder.geocode({ address: address }, function(results, status) {
            // Try to geocode the address
            if (status === "OK") {
                map.setCenter(results[0].geometry.location);
                map.setZoom(19);
                marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    title: "Your House",
                });
            } else {
                // if it fails, handle geocoding error
                console.error('Geocode failed: ' + status);
                const errorMsg = document.createElement('div');
                errorMsg.innerHTML = '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">' +
                    'Could not find this address. Please check the address or enter coordinates manually.' +
                    '</div>';
                mapElement.parentNode.insertBefore(errorMsg, mapElement.nextSibling);
            }
        });
    }
}

// Expose a global function to update the map
window.updateGoogleMap = function(lat, lng, address) {
    if (!map) return;
    const newCenter = { lat: lat, lng: lng };
    map.setCenter(newCenter);
    if (marker) marker.setMap(null);
    marker = new google.maps.Marker({
        map: map,
        position: newCenter,
        title: "Your Address",
    });
};

// Listen for browser events
window.addEventListener('update-google-map', function(e) {
    window.updateGoogleMap(e.detail.lat, e.detail.lng, e.detail.address);
});

// Initialize map when Google Maps API is loaded
if (typeof google === 'undefined') {
    const script = document.createElement('script');
    script.src = 'https://maps.googleapis.com/maps/api/js?key={{ config("services.google_maps.api_key") }}&loading=async&callback=initMap';
    script.async = true;
    script.defer = true;
    document.body.appendChild(script);
} else {
    initMap();
}
window.initMap = initMap;
</script>