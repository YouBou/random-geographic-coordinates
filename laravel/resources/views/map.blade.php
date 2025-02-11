<!DOCTYPE html>
<html>
<head>
    <title>Random Location Map</title>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ $googleMapsApiKey }}"></script>
    <style>
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            padding: 20px;
        }

        .maps-container {
            width: 90%;
            display: flex;
            gap: 20px;
            max-width: 1400px;
        }

        #map, #streetview {
            flex: 1;
            height: 500px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        #generate-button {
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .maps-container {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="maps-container">
            <div id="map"></div>
            <div id="streetview"></div>
        </div>
        <button id="generate-button">Generate Random Location</button>
    </div>

    <script>
        let map, streetview, marker;

        function initMap() {
            const defaultLocation = { lat: 0, lng: 0 };
            
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 2,
                center: defaultLocation
            });

            streetview = new google.maps.StreetViewPanorama(
                document.getElementById('streetview'),
                {
                    position: defaultLocation,
                    pov: { heading: 0, pitch: 0 }
                }
            );

            map.setStreetView(streetview);
        }

        document.getElementById('generate-button').addEventListener('click', function() {
            fetch('/generate-coordinates')
                .then(response => response.json())
                .then(coordinates => {
                    if (marker) {
                        marker.setMap(null);
                    }
                    
                    marker = new google.maps.Marker({
                        position: coordinates,
                        map: map
                    });

                    map.setCenter(coordinates);
                    map.setZoom(14);

                    // ストリートビューが利用可能か確認
                    const streetViewService = new google.maps.StreetViewService();
                    streetViewService.getPanorama({ location: coordinates, radius: 50 })
                        .then(data => {
                            const panorama = data.data;
                            streetview.setPosition(coordinates);
                        })
                        .catch(error => {
                            console.log("この地点ではストリートビューは利用できません");
                            // オプション: ユーザーに通知を表示
                        });
                });
        });

        initMap();
    </script>
</body>
</html>