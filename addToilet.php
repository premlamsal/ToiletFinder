<!DOCTYPE html>
<html>
<head>
	<title>Map</title>
	<style>
#myMap {
   height: 350px;
   width: 680px;
}
</style>
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC4TTm61R0CzyACTuJ7iE9SE_B0ElMmwxc&sensor=false">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
</script>
<script type="text/javascript"> 
	var lat1;
	var lng1;
	var map;
var marker;
var myLatlng;
var geocoder;
var infowindow 
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
      alert("Please! Allow Location Permission");
    }
function showPosition(position) {
    lat1= position.coords.latitude; 
    lng1= position.coords.longitude;


 myLatlng = new google.maps.LatLng(lat1,lng1);
 geocoder = new google.maps.Geocoder();
 infowindow = new google.maps.InfoWindow();
function initialize(){
var mapOptions = {
zoom: 16,
center: myLatlng,
mapTypeId: google.maps.MapTypeId.ROADMAP
};

map = new google.maps.Map(document.getElementById("myMap"), mapOptions);

marker = new google.maps.Marker({
map: map,
position: myLatlng,
draggable: true 
}); 

geocoder.geocode({'latLng': myLatlng }, function(results, status) {
if (status == google.maps.GeocoderStatus.OK) {
if (results[0]) {
$('#latitude,#longitude').show();
$('#address').val(results[0].formatted_address);
$('#latitude').val(marker.getPosition().lat());
$('#longitude').val(marker.getPosition().lng());
infowindow.setContent(results[0].formatted_address);
infowindow.open(map, marker);
}
}
});

google.maps.event.addListener(marker, 'dragend', function() {

geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
if (status == google.maps.GeocoderStatus.OK) {
if (results[0]) {
$('#address').val(results[0].formatted_address);
$('#latitude').val(marker.getPosition().lat());
$('#longitude').val(marker.getPosition().lng());
infowindow.setContent(results[0].formatted_address);
infowindow.open(map, marker);
}
}
});
});

}
google.maps.event.addDomListener(window, 'load', initialize);
}
</script>

</head>
<body>

<?php
include('includes/header.php');
?>
<div id="myMap" style="width: 100%"></div>
<form method="post" action="addToilet_process.php">
<input id="address" type="text" style="width:600px;" name="address" /><br/>
<input type="text" id="latitude" placeholder="Latitude" name="lat" />
<input type="text" id="longitude" placeholder="Longitude" name="lng" />
<input type="submit" value="Add a Missing Place" class="btn btn-primary">
</form>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

</body>
</html>