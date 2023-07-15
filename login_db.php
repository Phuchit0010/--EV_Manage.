<?php 
    session_start();
    require_once 'config.php';
    ini_set('mysql.connect_timeout', 300);
    ini_set('default_socket_timeout', 300);

    if (isset($_POST['signin'])) {
        $username = $_POST['username'];
        $password = $_POST['password']; 
          
        if (empty($username)) {
            $_SESSION['error'] = 'กรุณากรอก username';
            header("location: index.php");
        } else if (empty($password)) {
            $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
            header("location: index.php");
        } else {
            try {
                $check_data = "SELECT * FROM admin_user WHERE username = '".$username."'";
                $result = $connect->query($check_data);
                $row = $result->fetch_assoc();
                $rowcount=mysqli_num_rows($check_data);
                    if ($username == $row['username']) {
                        if ($password == $row['password']) {
                            if ($row['role'] == 'admin') {
                                $_SESSION['admin_login'] = $row['username'];
                                header("location: dashboard.php");
                            } else {
                                $_SESSION['db_login'] = $row['username'];
                                header("location: get_rfid_data.php");
                            }
                        } else {
                            $_SESSION['error'] = $row['password'];
                            header("location: index.php");
                        }
                    } else {
                        $_SESSION['error'] = 'username ผิด';
                        header("location: index.php");
                    }
               
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>