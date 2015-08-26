
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
    fSData.radius = "&radius=10000"
    fSData.misc = "&v=20140806&m=foursquare&intent=checkin";
    var markersArray = [];

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
        //Get query location without coordinates, after this, if successfull, we will get the coordinates, else we will get an error message
        var fSData = window.fSData;
        window.fSData.llStr = "&ll="+0+","+0;
        var query = "https://api.foursquare.com/v2/venues/search?"+fSData.cid+fSData.cs+fSData.query+fSData.misc;
        console.log(query);
        $.ajax({
            url: query,
            context: document.body
        }).done(function(e)
        {
            var foundLocation = e.response.venues;
            if (typeof(foundLocation[0]) !="undefined")
            {
                //If successfull, we will get all venues with the new found coordinates
                window.fSData.llStr = "&ll="+foundLocation[0].location.lat+","+foundLocation[0].location.lng;
                window.fSData.lat = foundLocation[0].location.lat;
                window.fSData.lng = foundLocation[0].location.lng;
                //Centering the map in the new coordinates
                moveToLocation();
                //Getting all the locations and stablishing the markers
                getAllVenuesCloseToLocation()
            }
            else
            {
                showMessage("Sorry, no locations found by that name")
            }
        });
    }
    function getAllVenuesCloseToLocation()
    {
        //Again, another ajax query, but this time without the query variable, so that it wont mess with our search, this time, with a radius limitation
        var query = "https://api.foursquare.com/v2/venues/search?"+fSData.cid+fSData.cs+fSData.llStr+fSData.misc+fSData.radius;
        $.ajax({
            url: query,
            context: document.body
        }).done(function(e)
        {
            var foundLocation = e.response.venues;
            //Clean all the markers, everytime the user makes a query
            for(var i=0;i<markersArray.length;i++)
            {
                markersArray[i].setMap(null);
            }
            markersArray = null;
            //Brand new healthy markers Array
            markersArray = [];
            //Add the new markers, if at least one location is found
            if (typeof(foundLocation[0]) !="undefined")
            {
                for(i=0;i<foundLocation.length;i++)
                {
                    var singleLocation = foundLocation[i];
                    var myLatLng = {lat: singleLocation.location.lat, lng: singleLocation.location.lng};
                    var marker = new google.maps.Marker({
                        position: myLatLng,
                        map: map,
                        title: singleLocation.name
                    });
                    //organize the markers
                    markersArray.push(marker);
                }
            }
        });
    }
    function moveToLocation()
    {
        var center = new google.maps.LatLng(window.fSData.lat,window.fSData.lng);
        map.panTo(center);
    }
    function getCoords(position)
    {
        queryFourSquare();
    }
    function getQueryResults(e)
    {
        //Click or submit query
        e.preventDefault();
        window.fSData.query = "&near="+encodeURIComponent($("#query").val());
        queryFourSquare();
    }
    function showMessage(msg)
    {

    }

</script>





</body>
</html>