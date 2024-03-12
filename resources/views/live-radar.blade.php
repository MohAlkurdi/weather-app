<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"></script>
    <script src="https://api.windy.com/assets/map-forecast/libBoot.js"></script>
    <style>
        #windy {
            width: 100%;
            height: 900px;
        }
    </style>
</head>

<body>
    <div id="windy"></div>

    <script>
        const options = {
            // Required: API key
            key: '{{ env('WINDY_API_KEY') }}',

            // Put additional console output
            verbose: true,

            // Optional: Initial state of the map
            lat: 22.950,
            lon: 48.790,
            zoom: 5,
        };

        // Initialize Windy API
        windyInit(options, windyAPI => {
            const {
                map
            } = windyAPI;

            L.popup()
                .setLatLng([22.950, 48.790])
        });
    </script>
</body>

</html>
