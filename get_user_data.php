<?php
	require_once "config.php";
	
	$sql = "SELECT data_input.*, users.* FROM data_input INNER JOIN users ON data_input.id = users.id ";
    $result = $connect->query($sql);
	//$intNumField = $result->num_fields();
	$resultArray = array();
	$historyArray = array();
   // $fieldinfo = $result -> fetch_fields();
    $arrCol = array();
	while($row = $result->fetch_assoc())
	{
		$id = $row['id'];
        $name = $row['name'];
        $position = $row['position'];
        $floor = $row['floor'];
        $floor_nd = $row['floor_nd'];
        $floor_rd = $row['floor_rd'];
        $floor_sp = $row['floor_sp'];

        $resultArray = array("id" => $id, "name" => $name, "position" => $position, "floor" => $floor, "floor_nd" => $floor_nd, "floor_rd" => $floor_rd, "floor_sp" => $floor_sp); 	
	} 
	
	
	//mysql_close($objConnect);
	
	echo json_encode($resultArray);

    ?>