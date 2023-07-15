<?php
  include "sidebar.php";
  require_once "config.php";
?>


<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User History</title>
        <link href='https://css.gg/css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg/icons/all.css' rel='stylesheet'>
    <link href='https://cdn.jsdelivr.net/npm/css.gg/icons/all.css' rel='stylesheet'>

        <script>
        function getDataFromDb()
        {
            $.ajax({ 
                        url: "get_history_report.php" ,
                        type: "POST",
                        data: ''
                    })
                    
        
        }
  
        setInterval(getDataFromDb, 1000);   // 1000 = 1 second
    </script>
    <style>
        th, td {
            text-align: center;
        }
        thead {
            background: white;
            position: sticky;
            top: 0;
    
        }

        th, td {
            padding: 0.25rem;
        }
        .card-header {
            margin-top: 0;
            margin-left: 0;
            margin-right: 0;
        }
        .sidenav {
        height: 100%;
        width: 160px;
        position: fixed;
        z-index: 2;
        top: 10;
        left: 0;
        background-color: #111;
 
        padding-top: 10px;
        }

        .sidenav a {
        padding: 6px 8px 6px 16px;
        text-decoration: none;
        font-size: 17px;
        color: #818181;
        display: block;
        }

        .sidenav a:hover {
        color: #f1f1f1;
        }
      

        @media screen and (max-height: 450px) {
        .sidenav {padding-top: 15px;}
        .sidenav a {font-size: 18px;}
        }
    </style>
    </head>
    <body>

    

    <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
    <h3 style="font-weight:bold;">Admin List</h3>
    <h7 class="h5">List of all elevator Admins</h7>
    <div class="row">
                    <div class="col">
                        <div class="card">
                            <h5 class="card-header">Admin List</h5>
                            <div class="card-body">
                                <div class="table-responsive" style="height: 550px; overflow: auto;">
                                    <table class="table" id="myTable">
                                        <thead>
                                         
                                            <th scope="col">name</th>
                                            <th scope="col">username</th>
                                            <th scope="col">role</th>
                                            <th scope="col">create_at</th>
                                        </thead>
                                        <tbody id="myBody">
                                          <?php
                                            $servername = "localhost";
                                            $username = "root";
                                            $password = "";
                                            $db = "project65";
                                            $connect = new mysqli($servername, $username, $password,$db);
                                            if ($connect->connect_error) {
                                              die("Connection failed: " . $connect->connect_error);
                                            }                                          
                                            $query = "SELECT  `name`, `username`, `role`, `create_at` FROM `admin_user` ";
                                            $result = mysqli_query($connect, $query);
                                               while($row = mysqli_fetch_array($result))
                                               {
                                                   $name = $row['name'];
                                                   $username = $row['username'];
                                                   $role= $row['role'];
                                                   $create_at = $row['create_at'];
                            
                                                   $resultArray[] = array("name" => $name, "username" => $username, "role" => $role ,"create_at" => $create_at); 

                                                   echo "
                                                        <tr>
                                                            <td>".$row['name']."</td>
                                                            <td>".$row['username']."</td>
                                                            <td>".$row['role']."</td>  
                                                            <td>".$row['create_at']."</td>                       
                         
                                                        </tr>
                                                        ";
                                            }        
                                          ?>
                                        </tbody>
                                    </table>
                                </div>
                            
                                <!-- Scrollable modal -->





                            </div>
                        </div>
                    </div>
                </div>
                                        </main>
    </body>
    </html>

   

