<html>
<body>

<?php
include_once "config.php";

if(!$connect){
	echo "Error: " . mysqli_connect_error();
	exit();
}

echo "Connection Success!<br><br>";

$id = $_GET["id"];
$current_floor = $_GET["current_floor"];
$floor_id = $_GET["floor_id"];

$query = "INSERT INTO floor_choosed (id, floor_id) VALUES ('$id', '$floor_id')";
$result = mysqli_query($connect,$query);

$pre_history = "UPDATE pre_history SET from_floor = $current_floor, to_floor = $floor_id";
$result_pre_history = mysqli_query($connect,$pre_history);

$get_pre_history = "SELECT * FROM pre_history";
$result_get_pre_history = $connect->query($get_pre_history);
while($row = $result_get_pre_history->fetch_assoc())
	{
		$rfid_id = $row["rfid_id"];
		$id = $row['id'];
        $name = $row['name'];
        $from = $row['from_floor'];
        $to = $row['to_floor'];
        $date = $row['date'];
		$image = $row['image'];

		$user_history = "INSERT INTO user_history (rfid_id, id, `name`,`from`,`to`,`date`, `image`) VALUES ('$rfid_id', '$id','$name','$from','$to','$date', '$image')";
		$result_user_history = mysqli_query($connect,$user_history);
	}
echo "Insertion Success!<br>";



?>
</body>
</html>