<!DOCTYPE html>
<html>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
	var lat;
	var lng;
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
      alert("Please! Allow Location Permission");
    }
function showPosition(position) {
    lat= position.coords.latitude; 
    lng= position.coords.longitude;

    window.location.href = "index_back.php?lat=" + lat +"&lng=" +lng;

}
</script>
<p>Allow the location permission</p>
</body>
</html>
