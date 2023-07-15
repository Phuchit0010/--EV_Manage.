<html>
<body>

<?php
include_once "config.php";

if(!$connect){
	echo "Error: " . mysqli_connect_error();
	exit();
}

echo "Connection Success!<br><br>";
$delete = "DELETE FROM floor_data";
$delresult = mysqli_query($connect,$delete);

$floor_id = $_GET["floor_id"];
$query = "INSERT INTO floor_data (floor_id) VALUES ('$floor_id')";
$result = mysqli_query($connect,$query);

echo "Insertion Success!<br>";



?>
</body>
</html>