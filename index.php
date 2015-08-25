
<!DOCTYPE html>
<html>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
    getLocation();
    var x = document.getElementById("demo");

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        var query = "https://api.foursquare.com/v2/venues/search?client_id=0ASH5OORJR0K0HJ33Y0LG2QVYJDZO3WOI201N5ZM1VMDSOOE&client_secret=1SVS4PP2THIDE2RLH0KOBFROE1NA140TMP2K4M05NWDBPRHK&ll="+position.coords.latitude+","+position.coords.longitude+"&query=sushi&v=20140806&m=foursquare";
        $.ajax({
            url: query,
            context: document.body
        }).done(function(e) {
            console.log(e);
        });


    }
</script>

</body>
</html>