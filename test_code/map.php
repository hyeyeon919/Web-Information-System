<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min/js"></script>
    <style>
        #map {
            height : 400px;
            width : 400px;
        }
        </style>
</head>
<body>
	<!-- adding map with google -->
    <h3> UQ St Lucia Campus</h3>
    <div id="map"></div>
    <script>
        function initMap() {
            var INFS3202 = {lat : -27.4983477, lng : 153.0123124};
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom : 15,
                center : INFS3202
            });
            var marker = new google.maps.Marker({
                position : INFS3202,
                map : map
            });
        }
        </script>
        <script async defer
        src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyBU5hXjOkDhFxlKM-psINPlpGKrrugZMB!&callback=initMap">
        </script>
</body>