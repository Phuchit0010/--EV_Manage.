<?php session_start(); 
ini_set('mysql.connect_timeout', 300);
ini_set('default_socket_timeout', 300);
?>

<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: rgba(0,41,107,1);
      
    }
 
    .container {
      max-width: 400px;
      margin: 0 auto;
      max-width: 600px;
      padding: 20px;
      background-color: #ffffff;
      border: 1px solid #cccccc;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .container2 {
      max-width: 400px;
      margin: 0 auto;
      max-width: 600px;
      padding: 20px;
      background-color: rgba(251,80,18,0.8999999761581421);
      border: 1px solid #cccccc;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h2 {
      text-align: center;
    }
    
    .form-group {
      margin-bottom: 15px;
    }
    
    .form-group label {
      display: block;
      margin-bottom: 5px;
    }
    
    .form-group input {
      width: 100%;
      padding: 5px;
      font-size: 20px;
      border-radius: 3px;
      border: 1px solid #cccccc;
    }
    
    .form-group button {
      margin: 0 auto;
      width: 40%;
      padding: 8px 12px;
      font-size: 20px;
      color: #ffffff;
      background-color: #007bff;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }
    
    .form-group button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
<div class="d-flex col-12 col-md-3 col-lg-2 mb-2 mb-lg-0 flex-wrap flex-md-nowrap justify-content-between">
            <img src="logo.PNG" style="width:140px;height:70px;">
            </div>
            <div class="container2" ;>
            <a class="navbar-brand"  font-weight=  Bold  style="color:white; font-weight: 700; font-size: 40px;">
            ELEVATOR  MANAGE
            </a>
            </div>
  <div class="container">
    <h2>Login</h2>
    <form action="login_db.php" method="post">
   
            <?php if(isset($_SESSION['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </div>
            <?php } ?>
            <div class="form-group">
                <label for="username" class="form-label">  Username</label>
                <input type="text" class="form-control" name="username">
            </div>
            <div class="form-group">
                <label for="password" class="form-label">  Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <?php if(isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>
            <div class="form-group">
            <button type="submit" name="signin" class="btn btn-primary">Sign In</button>
            </div>
            
        </form>
           
  </div>
</body>
</html>