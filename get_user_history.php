<?php
	require_once "config.php";
	
	$sql = "SELECT * FROM user_history ORDER BY date DESC";
    $result = $connect->query($sql);
	//$intNumField = $result->num_fields();
	$resultArray = array();
	$historyArray = array();
   // $fieldinfo = $result -> fetch_fields();
    $arrCol = array();
	while($row = $result->fetch_assoc())
	{
		$rfid_id = $row["rfid_id"];
		$id = $row['id'];
        $name = $row['name'];
        $from = $row['from'];
        $to = $row['to'];
        $date = $row['date'];
		$image = $row['image'];

        $resultArray[] = array("rfid_id" => $rfid_id, "id" => $id, "name" => $name, "from" => $from, "to" => $to, "date" => $date, "image" => $image); 	
	} 
	
	
	//mysql_close($objConnect);
	
	echo json_encode($resultArray);

    ?>