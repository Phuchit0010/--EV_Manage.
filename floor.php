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

$id = $_GET["id"];
$floor_id = $_GET["floor_id"];
$delete_floor_list = $_GET["delete"];

$query = "INSERT INTO floors (id, floor_id) VALUES ('$id', '$floor_id')";
$result = mysqli_query($connect,$query);

if($delete_floor_list == "true"){
	$delete2 = "DELETE FROM data_input";
	$delresult2 = mysqli_query($connect,$delete2);
	$delete3 = "DELETE FROM floor_choosed";
	$delresult3 = mysqli_query($connect,$delete3);
}


echo "Insertion Success!<br>";



?>
</body>
</html>