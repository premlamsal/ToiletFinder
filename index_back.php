<!DOCTYPE html>
<html>
<head>
	<title>Map</title>
	<style>
#myMap {
   height: 350px;
   width: 680px;
}
#data{
	display: none;

}
</style>
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<script src="https://maps.google.com/maps/api/js?key=AIzaSyC4TTm61R0CzyACTuJ7iE9SE_B0ElMmwxc&sensor=false"></script>
         
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>

<?php
include('includes/header.php');
?>
<?php
include('db/conn.php');
if (isset($_GET['lat'])) {

  $lat=$_GET['lat'];
  $lat = substr($lat, 0, 4);
  $lng=$_GET['lng'];
  $lng = substr($lng, 0, 4);
$sql="SELECT address,lat,lng,id FROM data_toilet WHERE lat LIKE '$lat%' AND lng LIKE '$lng%' ";
$result=mysqli_query($conn,$sql);

// Fetch all
$res=mysqli_fetch_all($result,MYSQLI_ASSOC);

$res=json_encode($res,true);
echo '<div id="data">'. $res . '</div>';
mysqli_close($conn);
}
?>
     <div id="map" style="width: 100%; height: 400px;"></div>

  <script type="text/javascript">
  	var yourlat,yourlng;
  	if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        document.write("Geolocation is not supported by this browser.");
    }
    function showPosition(position) {
   yourlat=position.coords.latitude;
    yourlng=position.coords.longitude;

  	var locations= JSON.parse(document.getElementById('data').innerHTML);
 
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 16,
      center: new google.maps.LatLng(yourlat, yourlng),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
      
        position: new google.maps.LatLng(locations[i].lat, locations[i].lng),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i].address);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
}
  </script>
  <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>


</body>
</html>