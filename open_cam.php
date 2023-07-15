<html>
<body>

<?php
include_once "config.php";

if(!$connect){
	echo "Error: " . mysqli_connect_error();
	exit();
}

echo "Connection Success!<br><br>";
$delete = "DELETE FROM floors";
$delresult = mysqli_query($connect,$delete);

$open = $_GET["open"];


$query = "INSERT INTO open_cam (cam_status) VALUES ('$open')";
$result = mysqli_query($connect,$query);

echo "Insertion Success!<br>";



?>
</body>
</html>