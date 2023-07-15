<html>
<body>

<?php
include_once "config.php";

if(!$connect){
	echo "Error: " . mysqli_connect_error();
	exit();
}

echo "Connection Success!<br><br>";
$delete = "DELETE FROM rfiddata";
$delresult = mysqli_query($connect,$delete);

$rfid_id = $_GET["rfid_id"];

$query = "INSERT INTO rfiddata (RFID_ID) VALUES ('$rfid_id')";
$result = mysqli_query($connect,$query);

$query2 = "INSERT INTO rfid_input (rfid_id) VALUES ('$rfid_id')";
$result2 = mysqli_query($connect,$query2);


$select = "SELECT rfid_input.*, users.* FROM rfid_input INNER JOIN users ON rfid_input.rfid_id = users.rfid_id ";
$select_result = $connect->query($select);
while($row = $select_result->fetch_assoc()){
	$rfidid = $row['rfid_id'];
	$id = $row['id'];
	$name = $row['name'];
	$floor = $row['floor'];
	$times = $row['times'];

	// $sqll = "INSERT INTO user_history(rfid_id, id, name, from, to, date)
    //                         VALUES ('$rfid_id', '$id', '$name', '$floor', '$floor', '$times')";	
    // $resultt = mysqli_query($connect,$sqll);	

	$insert_data_input = "INSERT INTO data_input (id) VALUES ('$id')";
	$insert_result = mysqli_query($connect,$insert_data_input);

	$delete_select = "DELETE FROM rfid_input";
	$deleteresult = mysqli_query($connect,$delete_select);

	


	echo "$rfidid , $name, $times <br>";
	// $query4 = "INSERT INTO test1 (test,test2,test3,test4,test5,test6) VALUES ('$rfid_id','$id','$name','1','$floor','$times')";
	// $result4 = mysqli_query($connect,$query4);

	
}
$select2 = "SELECT data_input.*, users.* FROM data_input INNER JOIN users ON data_input.id = users.id ";
$select_result2 = $connect->query($select2);

while($row2 = $select_result2->fetch_assoc()){
	$rfid_id = $row2['rfid_id'];
	$id = $row2['id'];
	$name = $row2['name'];
	$floor = $row2['floor'];
	$time = $row2['time'];

	$query5 = "INSERT INTO pre_history (rfid_id, id,`name`,from_floor,to_floor,`date`,`image`) VALUES ('$rfid_id','$id','$name','1','$floor','$times', 'none.jpg')";
	$result5 = mysqli_query($connect,$query5);
}

echo "Insertion Success!<br>";


?>
</body>
</html>