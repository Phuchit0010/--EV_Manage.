

        
   
<?php
	require_once "config.php";

    if (isset($_POST['submit']) )
    {        if(empty($name))
       									
   {
        $ID = $_POST['ID']; 
        $repair_list = $_POST['repair_list'];
        $signation = $_POST['signation'];
        $sql = "INSERT INTO repair_history(ID,repair_list,signation)
        VALUES ( '$ID', '$repair_list','$signation')";	
                $result = mysqli_query($connect,$sql);	
                echo "Insertion Success!<br>";       
            }
        }
    
            //exit(0);
            header("refresh: 0; url=repair.php");
            //exit(0);
            ?>

        
   
    