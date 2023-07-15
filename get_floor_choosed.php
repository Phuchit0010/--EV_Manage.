<?php
    require_once "config.php";
    $sql = "SELECT * FROM floor_choosed ";
    $result = $connect->query($sql);
    $resultArray = array();
    while($row = $result->fetch_assoc())
    {
        $id = $row['id'];
        $floor_id = $row['floor_id'];

        $resultArray = array("id" => $id, "floor_id" => $floor_id); 
    } 
    echo json_encode($resultArray);

?>