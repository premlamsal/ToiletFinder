<?php
if(isset($_POST['lat']))
{
    $add=$_POST['address'];
    $lat= $_POST['lat'];
    $lng= $_POST['lng'];
	include('db/conn.php');
$sql = "SELECT * FROM data_toilet WHERE lat='$lat' AND lng='$lng' ";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  echo "<p>There is Already Added Toilet in this location. Select different location</p>";
    }
 else {
    	
		$sql = "INSERT INTO data_toilet (address, lat, lng) VALUES ('$add', '$lat', '$lng')";
		
			if (mysqli_query($conn, $sql)) {
			    echo "<p>Toilet Added Successfully</p>";
			} 
			else {
			    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
}

mysqli_close($conn);
}
?>