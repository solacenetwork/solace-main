<div id="map" style="width: 100%; height: 400px;"></div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        if (typeof google === 'undefined') {
            console.error("Google Maps API not loaded!");
            return;
        }

        function initMap() {
            const mapOptions = {
                center: { lat: {{ $latitude }}, lng: {{ $longitude }} },
                zoom: 12
            };

            const map = new google.maps.Map(document.getElementById("map"), mapOptions);

            new google.maps.Marker({
                position: { lat: {{ $latitude }}, lng: {{ $longitude }} },
                map: map,
                title: "{{ $address }}"
            });
        }

        initMap();
    });
</script>
