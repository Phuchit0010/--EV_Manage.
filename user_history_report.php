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

        <!-- <script>
        function getDataFromDb()
        {
            $.ajax({ 
                        url: "get_history_report.php" ,
                        type: "POST",
                        data: ''
                    })
                    .success(function(result) { 
                        var obj = jQuery.parseJSON(result);
                            if(obj != '')
                            {
                                    
                                    $("#myBody").empty();
                                    $.each(obj, function(key, val) {
                                            var tr = "<tr><td scope='row'>"+val["id"]+"</td><td>"+val["name"]+"</td><td>"+val["from"]+"</td><td>"+val["to"]+"</td><td>"+val["date"]+"</td></tr>";

                                            $('#myTable > tbody').append(tr);
                                    });
                                
                            }
        
                    });
        
        }
  
        setInterval(getDataFromDb, 1000);   // 1000 = 1 second
    </script> -->
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
    </style>
    </head>
    <body>
        <?php
            if (isset($_REQUEST['user_id'])){
        
                $user_id = $_REQUEST['user_id'];
                
                $sql = "SELECT * FROM user_history WHERE id = $user_id ORDER BY date DESC";
                $result = $connect->query($sql);
                //$intNumField = $result->num_fields();
                $resultArray = array();
                $historyArray = array();
                $fieldinfo = $result -> fetch_fields();
                $arrCol = array();
                   while($row = $result->fetch_assoc())
                   {
                       $rfid_id = $row['rfid_id'];
                       $id = $row['id'];
                       $name = $row['name'];
                       $from = $row['from'];
                       $to = $row['to'];
                       $date = $row['date'];
                       $image = $row['image'];
               
                       $resultArray[] = array("rfid_id" => $rfid_id, "id" => $id, "name" => $name, "from" => $from, "to" => $to, "date" => $date, "image" => $image); 

                       
               
                       
                   }
                } 
        ?>
    <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4" >
    <div class="row">
                    <div class="col">
                        <div class="card">
                            <h5 class="card-header"><?php echo "<b>$user_id</b>"; ?> Usage History </h5>
                            <div class="card-body">
                                <div class="table-responsive" style="height: 550px; overflow: auto;">
                                    <table class="table" id="myTable">
                                        <thead>
                                            <th scope="col" >RFID ID</th>
                                            <th scope="col" >ID</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">From(Floor)</th>
                                            <th scope="col">To(Floor)</th>
                                            <th scope="col">Date</th>
                                            <th scope="col" >Image</th>
                                        
                                            
                                          
                                        </thead>
                                        <tbody id="myBody">
                                          <?php
                                           if (isset($_REQUEST['user_id'])){
        
                                            $user_id = $_REQUEST['user_id'];
                                            
                                            $sql = "SELECT * FROM user_history WHERE id = $user_id ORDER BY date DESC";
                                            $result = $connect->query($sql);
                                            //$intNumField = $result->num_fields();
                                            $resultArray = array();
                                            $historyArray = array();
                                            $fieldinfo = $result -> fetch_fields();
                                            $arrCol = array();
                                               while($row = $result->fetch_assoc())
                                               {
                                                   $rfid_id = $row['rfid_id'];
                                                   $id = $row['id'];
                                                   $name = $row['name'];
                                                   $from = $row['from'];
                                                   $to = $row['to'];
                                                   $date = $row['date'];
                                                   $image = $row['image'];
                                           
                                                   $resultArray[] = array("rfid_id" => $rfid_id, "id" => $id, "name" => $name, "from" => $from, "to" => $to, "date" => $date, "image" => $image); 

                                                   echo "
                                                        <tr>
                                                            <td>".$row['rfid_id']."</td>
                                                            <td>".$row['id']."</td>
                                                            <td>".$row['name']."</td>
                                                            <td>".$row['from']."</td>
                                                            <td>".$row['to']."</td>
                                                            <td>".$row['date']."</td>
                                                            <td><img src=faces/".$row['image']." width=100 height=80></td>
                                                        </tr>
                                                        ";
                                           
                                                   
                                               }
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

   

