
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0XtaLdJpsxY0tyeu4Gsy0HwECzlZJDtA&callback=initMap">
    </script>
</head>
<body>
<div class="container">


    <div class="col-md-3"></div>
    <div class="col-md-6 centered">
        <h1 class="centered">ANDigital Test Solved</h1>
        <br>
        <form>
            <label><input type="text" id="query" placeholder="Type your query here" class="form-control"></label>
            <input type="submit" onclick="getQueryResults(event);" value="Results" class="btn btn-primary">
        </form>
        <br>
        <br>
    </div>
    <div class="col-md-3"></div>
    <div class="clearfix"></div>

    <div class="col-md-3"></div>
    <div class="col-md-6 centered msg-height">
        <div class="alert alert-danger">
            Alert Dummy
        </div>
    </div>
    <div class="col-md-3"></div>
    <div class="clearfix"></div>

    <div class="col-md-3"></div>
    <div class="col-md-6 map-holder">
        <div id="map"></div>
    </div>
    <div class="col-md-3"></div>
    <div class="clearfix"></div>



    <script type="text/javascript" src="js/scripts.js"></script>
</div>
</body>
</html>