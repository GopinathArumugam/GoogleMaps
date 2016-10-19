<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta charset="utf-8">
        <title>Google Maps</title>
        <style>
            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
            }
            #map {
                height: 100%;
            }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script type="text/javascript" src="/GoogleMaps/src/markerclusterer.js"></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRU-f4nloK8Di3nX5ulFYzcLGXHz7HovM&callback=getGoogleMaps"
                type="text/javascript">
        </script>
        <script>
            function getGoogleMaps() {
                $.ajax({
                    url: '/GoogleMaps/External/googleMapsController.php',
                    data: {action_name: 'getGoogleMaps'},
                    type: 'POST',
                    success: function(data) {
                        if (data == "session_error") {
                            window.location.href = "index.php";
                        } else {
                            var myLatLng = {lat: -25.363, lng: 131.044};
                            var map = new google.maps.Map(document.getElementById('map'), {
                                zoom: 3,
                                center: myLatLng,
                                mapTypeId: google.maps.MapTypeId.ROADMAP
                            });
                            var parsedData = $.parseJSON(data);
                            var markers = [];
                            $.each(parsedData, function(index, val) {
                                var lat = val['latitude'];
                                var long = val['longitude'];
                                var markerData = val['markerData'];
                                var phoneNumber = val['phoneNumber'];
                                var latLng = new google.maps.LatLng(lat, long);
                                var marker = new google.maps.Marker({
                                    position: latLng,
                                    title: phoneNumber + '\n' + markerData,
                                    map: map
                                });
                                markers.push(marker);

                            });
                            var markerCluster = new MarkerClusterer(map, markers, {imagePath: '/GoogleMaps/images/m'});
                        }
                    }
                });
            }


        </script>
    </head>
    <body>
        <div id="map"></div>
    </body>
</html>