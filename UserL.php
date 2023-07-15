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
    <h3 style="font-weight:bold;">User List</h3>
    <h7 class="h5">List of all elevator users</h7>
    <div class="row">
                    <div class="col">
                        <div class="card">
                            <h5 class="card-header">User List</h5>
                            <div class="card-body">
                                <div class="table-responsive" style="height: 550px; overflow: auto;">
                                    <table class="table" id="myTable">
                                        <thead>
                                            <th scope="col" >RFID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Position</th>
                                            <th scope="col">Floor</th>
                                            <th scope="col">Add Date</th>
                                            <th scope="col">Exp Date</th>
                                            <th scope="col">address</th>
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
                                            $query = "SELECT * FROM users";
                                            $result = mysqli_query($connect, $query);
                                               while($row = mysqli_fetch_array($result))
                                               {
                                                   $rfid_id = $row['rfid_id'];
                                                   $name = $row['name'];
                                                   $position= $row['position'];
                                                   $floor = $row['floor'];
                                                   $add_date = $row['add_date'];
                                                   $exp_date = $row['exp_date'];
                                                   $address = $row['address'];
                                                   $resultArray[] = array("rfid_id" => $rfid_id, "name" => $name, "position" => $position ,"floor" => $floor, "add_date" => $add_date, "exp_date" => $exp_date, "address" => $address); 

                                                   echo "
                                                        <tr>
                                                            <td>".$row['rfid_id']."</td>
                                                            <td>".$row['name']."</td>
                                                            <td>".$row['position']."</td>  
                                                            <td>".$row['floor']."</td>                       
                                                            <td>".$row['add_date']."</td>
                                                            <td>".$row['exp_date']."</td>
                                                            <td>".$row['address']."</td>
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

   

