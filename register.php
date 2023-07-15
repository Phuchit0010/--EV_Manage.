<?php
	require_once "config.php";

    if(isset($_POST['reset'])){
        $delete = "DELETE FROM rfiddata";
        $delresult = mysqli_query($connect,$delete);

        $query = "INSERT INTO rfiddata (RFID_ID) VALUES (' ')";
                        $result = mysqli_query($connect,$query);
    }

    if (isset($_POST['submit']) )
    {
        if($_FILES['image']['tmp_name'] == null)
        {
            //echo "<p class='ms-4 '>ยังไม่ได้เพิ่มสินค้า</p>";
            echo "";
        }else{
        
            $image = addslashes($_FILES['image']['tmp_name']);
            $iname = addslashes($_FILES['image']['name']);
            $image = file_get_contents($image);
            $image = base64_encode($image); 

            //$image = $_FILES['image']['name'];
            $rfid = $_POST['rfid_text'];
            $name = $_POST['name'];
            $position = $_POST['position'];
            $floor = $_POST['floor'];
            $exp_date = $_POST['exp_date'];
            $address = $_POST['address'];

            

            if(empty($image)){
                $_SESSION['error'] = 'กรุณาเพิ่มรูปภาพ';								
            } else if (empty($iname)) {
                $_SESSION['error'] = 'กรุณาเพิ่มรูปภาพ';									
            } else if (empty($rfid)) {
                $_SESSION['error'] = 'กรุณาเพิ่มรหัส RFID';									
            } else if (empty($name)) {
                $_SESSION['error'] = 'กรุณากรอกชื่อ';									
            } else if (empty($position)) {
                $_SESSION['error'] = 'กรุณาระบุตำแหน่ง';									
            } else if (empty($floor)) {
                $_SESSION['error'] = 'กรุณาระบุชั้นที่มีสิทธิ์';		
            }else if (empty($exp_date)) {
                $_SESSION['error'] = 'กรุณาระบุวันบัตรหมดอายุ';		
            }else if (empty($address)) {
                $_SESSION['error'] = 'กรุณาระบุที่อยู่';		
            } else {
                
                    // $image_text = mysqli_real_escape_string($con, $_POST['details']);
                     $ext = pathinfo(basename($_FILES['image']['name']), PATHINFO_EXTENSION);
                     $new_image_name = "img_".uniqid().".".$ext;
                     $image_path = "img_db/";
                     $upload_path = $image_path.$new_image_name;
                     $success = move_uploaded_file($_FILES['image']['tmp_name'], $upload_path);
                     if(!$success){
                        echo "ไม่สามารถอัพโหลดรูปภาพได้";
                        exit();
                     }
                    
                    $sql = "INSERT INTO users(image_name, rfid_id, name, position, floor, exp_date, address)
                            VALUES ('$new_image_name', '$rfid', '$name', '$position', '$floor', '$exp_date', '$address')";	
                    $result = mysqli_query($connect,$sql);	
                    echo "Insertion Success!<br>";

                    if($result){
                        $delete = "DELETE FROM rfiddata";
                        $delresult = mysqli_query($connect,$delete);

                        $query = "INSERT INTO rfiddata (RFID_ID) VALUES (' ')";
                        $result = mysqli_query($connect,$query);
                    }
                    
            }
            }

        }
        header("refresh: 0; url=register_form.php");
        //exit(0);
?>