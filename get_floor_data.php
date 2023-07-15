<?php
    require_once "config.php";
    $sql = "SELECT * FROM floor_data ";
    $result = $connect->query($sql);
    $resultArray = array();
    while($row = $result->fetch_assoc())
    {
        $floor_id = $row['floor_id'];
        $resultArray = array("floor_id" => $floor_id); 
    } 
    echo json_encode($resultArray);

?>