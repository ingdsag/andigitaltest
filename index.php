
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0XtaLdJpsxY0tyeu4Gsy0HwECzlZJDtA&callback=initMap">
    </script>
</head>
<body>

<form>
    <label>Search<input type="text" id="query" placeholder="Type your query here"></label>
    <input type="submit" onclick="getQueryResults(event);" value="Results">
</form>
<div id="map"></div>
<script type="text/javascript">
    var fSData = {};
    fSData.cid = "client_id=0ASH5OORJR0K0HJ33Y0LG2QVYJDZO3WOI201N5ZM1VMDSOOE";
    fSData.cs = "&client_secret=1SVS4PP2THIDE2RLH0KOBFROE1NA140TMP2K4M05NWDBPRHK";
    fSData.llStr = "";
    fSData.query = "";
    fSData.misc = "&v=20140806&m=foursquare&intent=checkin&radius=10000";
    var map;
    function initMap()
    {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.397, lng: 150.644},
            zoom: 13
        });
    }

    function queryFourSquare()
    {
        var fSData = window.fSData;
        var query = "https://api.foursquare.com/v2/venues/search?"+fSData.cid+fSData.cs+fSData.llStr+fSData.query+fSData.misc;
        $.ajax({
            url: query,
            context: document.body
        }).done(function(e)
        {
            var foundLocation = e.response.venues;
            if (typeof(foundLocation[0]) !="undefined")
            {
                moveToLocation(foundLocation[0].location.lat, foundLocation[0].location.lng);
                for(var i=0;i<foundLocation.length;i++)
                {
                    var singleLocation = foundLocation[i];
                    var myLatLng = {lat: singleLocation.location.lat, lng: singleLocation.location.lng};
                    var marker = new google.maps.Marker({
                        position: myLatLng,
                        map: map,
                        title: singleLocation.name
                    });
                    //setMapOnAll.setMap(null);
                    //
                    //location.lat
                    //location.lng
                    console.log(foundLocation[i]);
                }
            }
        });
    }
    function moveToLocation(lat, lng)
    {
        var center = new google.maps.LatLng(lat,lng);
        map.panTo(center);
    }
    function getCoords(position)
    {
        window.fSData.llStr = "&ll="+position.coords.latitude+","+position.coords.longitude;
        window.fSData.lat = position.coords.latitude;
        window.fSData.lon = position.coords.longitude;
        queryFourSquare();
    }
    function getQueryResults(e)
    {
        e.preventDefault();
        window.fSData.query = "&query="+encodeURIComponent($("#query").val());
        if (navigator.geolocation)
        {
            navigator.geolocation.getCurrentPosition(getCoords);
        }
        else
        {

        }

    }


</script>





</body>
</html>