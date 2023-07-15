<?php
	require_once "config.php";

    if (isset($_POST['submit']) )
    {        if(empty($name)){
        $_SESSION['error'] = 'กรุณาเพิ่มชื่อ';								
    } else if (empty($username)) {
        $_SESSION['error'] = 'กรุณาเพิ่มรID';									
    } else if (empty($password)) {
        $_SESSION['error'] = 'กรุณาเพิ่มรหัส password';									
    } else if (empty($role)) {
        $_SESSION['error'] = 'กรุณากรอกrole';									
    } else {
            $name = $_POST['name']; 
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role = $_POST['$role'];              
            $sql = "INSERT INTO admin_user( name,username,password,role)
            VALUES ( '$name', '$username','$password','admin')";	
                    $result = mysqli_query($connect,$sql);	
                    echo "Insertion Success!<br>";
                    
            }
        }
            header("refresh: 0; url=admin_form.php");
            //exit(0);
            ?>

        
   
    