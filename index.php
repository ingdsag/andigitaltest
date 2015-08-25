
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
<label>Search<input type="text" id="query" placeholder="Type your query here"></label>
<input type="button" onclick="getQueryResults()" value="Results">
<div id="map"></div>
<script type="text/javascript">
    var fSData = {};
    fSData.cid = "client_id=0ASH5OORJR0K0HJ33Y0LG2QVYJDZO3WOI201N5ZM1VMDSOOE";
    fSData.cs = "&client_secret=1SVS4PP2THIDE2RLH0KOBFROE1NA140TMP2K4M05NWDBPRHK";
    fSData.llStr = "";
    fSData.query = "";
    fSData.misc = "&v=20140806&m=foursquare";
    var map;
    function initMap()
    {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.397, lng: 150.644},
            zoom: 8
        });
    }

    function queryFourSquare()
    {

        var fSData = window.fSData;
        var query = "https://api.foursquare.com/v2/venues/search?"+fSData.cid+fSData.cs+fSData.llStr+fSData.query+fSData.misc;
        console.log(query);
        $.ajax({
            url: query,
            context: document.body
        }).done(function(e)
        {
            console.log(e);
        });
    }
    function getCoords(position)
    {
        window.fSData.llStr = "&ll="+position.coords.latitude+","+position.coords.longitude;
        queryFourSquare();
    }
    function getQueryResults()
    {
        window.fSData.query = "&query="+encodeURIComponent($("#query").val());
        if (navigator.geolocation)
        {
            navigator.geolocation.getCurrentPosition(getCoords);
        }
        else
        {
            queryFourSquare();
        }

    }


</script>





</body>
</html>