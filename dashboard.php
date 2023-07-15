<?php
    session_start();
    require_once 'config.php';
    include 'sidebar.php';
?>

<?php
    include_once('esp-database.php');

    $esp_result = getAllOutputs();
    $html_buttons = null;
    $html_buttons_all = null;
    if ($esp_result) {
        while ($row = $esp_result->fetch_assoc()) {
            if ($row["state"] == "1"){
                $button_checked = "checked";
            }
            else {
                $button_checked = "";
            }
            $html_buttons .= '
            <label class="switch"><input type="checkbox" class="e1_checkbox" onchange="updateOutput(this)" id="' . $row["id"] . '" ' . $button_checked . '>
            <span class="slider round"></span></label>';
            $html_buttons_all .= '
            <label class="switch"><input type="checkbox" id="e1_select-all" onchange="updateOutput(this)" id="' . $row["id"] . '" ' . $button_checked . '>
            <span class="slider round"></span></label>';


        }
    }


    $result2 = getAllBoards();
    $html_boards = null;
    if ($result2) {
        $html_boards .= '<h3>Boards</h3>';
        while ($row = $result2->fetch_assoc()) {
            $row_reading_time = $row["last_request"];

            $html_boards .= '<p><strong>Board ' . $row["board"] . '</strong> - Last Request Time: '. $row_reading_time . '</p>';
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href='https://css.gg/css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg/icons/all.css' rel='stylesheet'>
    <link href='https://cdn.jsdelivr.net/npm/css.gg/icons/all.css' rel='stylesheet'>
    <style>
        

        .circle {
            width: 40px;
            height: 40px;
            background-color: white;
            border: solid 1px darkcyan;
            border-radius: 100%;
            text-align: center;
            margin-top: 3px;
            margin-bottom: 3px;
            margin-left: 0px;
    
        }
        .card-header {
            margin-top: 0;
            margin-left: 0;
            margin-right: 0;
            background: rgba(255,103,0,1);
        }

        #text1 {
            margin-top: 6px;
            
        }

        #floor{
            margin-top: 6px;
            margin-bottom: 6px;
            margin-left: 10px;
        }

        /* #e1f3{
            background-color: gold;

        } */
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
        .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
        margin-left: 60px;
        }
        .text_switch {
            margin-left: 30px;
        }

        .switch input { 
        opacity: 0;
        width: 0;
        height: 0;
        }

        .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
        }

        .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
        }

        input:checked + .slider {
        background-color: green;
        }

        input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
        border-radius: 34px;
        }

        .slider.round:before {
        border-radius: 50%;
        }

    </style>
    <script>
        function getDataFromDb()
        {
            $.ajax({ 
                        url: "get_user_history.php" ,
                        type: "POST",
                        data: ''
                    })
                    .success(function(result) { 
                        var obj = jQuery.parseJSON(result);
                            if(obj != '')
                            {
                                    
                                    $("#myBody").empty();
                                    $.each(obj, function(key, val) {
                                            var tr = "<tr><td scope='row'>"+val["rfid_id"]+"</td><td>"+val["id"]+"</td><td>"+val["name"]+"</td><td>"+val["from"]+"</td><td>"+val["to"]+"</td><td>"+val["date"]+"</td><td><a href='user_history_report.php?user_id="+val["id"]+"' class='btn btn-sm btn-primary'>View</a></td></tr>";

                                            $('#myTable > tbody').append(tr);
                                    });
                                
                            }
        
                    });
        
        }
  
  setInterval(getDataFromDb, 1000);   // 1000 = 1 second
    </script>
</head>
<body>
    <?php
        $check_data = "SELECT * FROM admin_user ";
        $result = $connect->query($check_data);
        $row = $result->fetch_assoc();
        $x = 1;
        $y = 3;
    ?>
    
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-1">
                
                <h3 style="font-weight:bold;">Dashboard</h3>
                <h7 class="h5">Manage and control elevators</h7>

                <div class="row my-4" style="border: solid none;">
                    <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0" >
                        <div class="card" >
                            <h5 class="card-header">Open and close the elevator floor</h5>
                            <div class="card-body">
                              <h5 class="card-title"></h5>
                              <p class="card-text">Floor 1
                              <label class="switch"><input type="checkbox" class="e1_checkbox" onchange="updateOutput(this)" id="1">
                              <span class="slider round"></span></label>
                              </p>
                              <p class="card-text">Floor 2
                              <label class="switch"><input type="checkbox" class="e1_checkbox" onchange="updateOutput(this)" id="2">
                              <span class="slider round"></span></label>
                              </p>
                              <p class="card-text">Floor 3
                              <label class="switch"><input type="checkbox" class="e1_checkbox" onchange="updateOutput(this)" id="3">
                              <span class="slider round"></span></label>
                              </p>
                              <p class="card-text">Floor 4
                              <label class="switch"><input type="checkbox" class="e1_checkbox" onchange="updateOutput(this)" id="4">
                              <span class="slider round"></span></label>
                              </p>
                              <p class="card-text">Close All
                              <label class="switch" style="margin-left: 50px;"><input type="checkbox" class="e1_checkbox"  onchange="closed(this)" id="e1_select-all">
                              <span class="slider round"></span></label>
                              </p>
                            </div>
                        </div>
                    </div>
                    
                 
                    <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3" style="border: solid none;">
                        <div class="row" style="border: solid none;">
                        <div class="card ">
                            <h5 class="card-header" style="background-color: none;">position</h5>
                            <div class="row" id="floor">
                                    <div class="col-3" >
                                        <div class="floor"><div id="text1">Floor</div></div>  
                                    </div>
                                    <?php
                                        if ($x == 1){
                                            echo '  
                                                    <div class="col-2" >
                                                        <div class="circle" id="e1f1" style="background-color: gold;"><div id="text1">1</div></div>  
                                                    </div>

                                                    <div class="col-2" >
                                                        <div class="circle" id="e1f2"><div id="text1">2</div></div>  
                                                    </div>

                                                    <div class="col-2" >
                                                        <div class="circle" id="e1f3"><div id="text1">3</div></div>  
                                                    </div>

                                                    <div class="col-2" >
                                                        <div class="circle" id="e1f4"><div id="text1">4</div></div>  
                                                    </div>
                                                    ';
                                        }
                                        elseif($x == 2){
                                            echo '  
                                                    <div class="col-2" >
                                                        <div class="circle" id="e1f1"><div id="text1">1</div></div>  
                                                    </div>

                                                    <div class="col-2" >
                                                        <div class="circle" id="e1f2" style="background-color: gold;"><div id="text1">2</div></div>  
                                                    </div>
                                                    
                                                    <div class="col-2" >
                                                        <div class="circle" id="e1f3"><div id="text1">3</div></div>  
                                                    </div>

                                                    <div class="col-2" >
                                                        <div class="circle" id="e1f4"><div id="text1">4</div></div>  
                                                    </div>
                                                    ';
                                        }
                                        elseif($x == 3){
                                            echo '  
                                                    <div class="col-2" >
                                                        <div class="circle" id="e1f1"><div id="text1">1</div></div>  
                                                    </div>

                                                    <div class="col-2" >
                                                        <div class="circle" id="e1f2"><div id="text1">2</div></div>  
                                                    </div>

                                                    <div class="col-2" >
                                                        <div class="circle" id="e1f3" style="background-color: gold;"><div id="text1">3</div></div>  
                                                    </div>

                                                    <div class="col-2" >
                                                        <div class="circle" id="e1f4"><div id="text1">4</div></div>  
                                                    </div>
                                                    ';
                                        }
                                        elseif($x == 4){
                                            echo '  
                                                    <div class="col-2" >
                                                        <div class="circle" id="e1f1"><div id="text1">1</div></div>  
                                                    </div>

                                                    <div class="col-2" >
                                                        <div class="circle" id="e1f2"><div id="text1">2</div></div>  
                                                    </div>

                                                    <div class="col-2" >
                                                        <div class="circle" id="e1f3"><div id="text1">3</div></div>  
                                                    </div>

                                                    <div class="col-2" >
                                                        <div class="circle" id="e1f4" style="background-color: gold;"><div id="text1">4</div></div>  
                                                    </div>
                                                    ';
                                        }
                                        else{
                                            echo '  
                                                    <div class="col-2" >
                                                        <div class="circle" id="e1f1"><div id="text1">1</div></div>  
                                                    </div>

                                                    <div class="col-2" >
                                                        <div class="circle" id="e1f2"><div id="text1">2</div></div>  
                                                    </div>

                                                    <div class="col-2" >
                                                        <div class="circle" id="e1f3"><div id="text1">3</div></div>  
                                                    </div>

                                                    <div class="col-2" >
                                                        <div class="circle" id="e1f4"><div id="text1">4</div></div>  
                                                    </div>                                            
                                                    ';
                                        }
                                    ?>
                                   
                                
                            </div> 
                        </div>
                        </div>

                        <div class="row" style="border: solid none; margin-top: 5px;">
                        <div class="card ">
                            <h5 class="card-header">Number of Users</h5>
                            <div class="row" id="floor">
                                        
                                    <div class="col-3" >
             
                                   
                                
                            </div> 
                        </div>
                        </div>
                        
                        
                                                    ?>
                    </div>
              
                                
                            </div> 
                        </div>
                        </div>
                    </div>
                                    
                </div>
              


                <div class="row">
                    <div class="col">
                        <div class="card" >
                        
             
                            <div class="card-body">
                            
                                <div class="table-responsive" style="height: 500px; overflow: auto;">
                             
                                    <table class="table" id="myTable" style="width:100%">
                                        <thead>
                                            <th scope="col" style="width:15%">RFID ID</th>
                                            <th scope="col" style="width:15%">ID</th>
                                            <th scope="col" style="width:15%">Username</th>
                                            <th scope="col" style="width:15%">From(Floor)</th>
                                            <th scope="col" style="width:15%">To(Floor)</th>
                                            <th scope="col" style="width:15%">Date</th>
                                            <th scope="col" style="width:10%">Info</th>
                                            
                                          
                                        </thead>
                                        <tbody id="myBody">
                                          
                                        </tbody>
                                    </table>
                                </div>
                                <a href="usage_history.php" class="btn btn-block btn-light">View all</a>
                                <!-- Scrollable modal -->
                            </div>
                        </div>
                    </div>
                </div>
                                        </div>
      
            </main>
        </div>
    </div>

    
    <script>
        $('#e1_select-all').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        
        $('.e1_checkbox').each(function() {
            this.checked = true;               
        });
    } else {
        
        $('.e1_checkbox').each(function() {
            this.checked = false;                    
        });
    }
});
    </script>

     <script>
        var xhr = new XMLHttpRequest();
        $('#e2_select-all').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        $('.e2_checkbox').each(function() {
            this.checked = true;              
        });
    } else {
        $('.e2_checkbox').each(function() {
            this.checked = false;                 
        });
    }
});

    </script>
    

<script>
feather.replace()
</script>

<script>
        function updateOutput(element) {
            var xhr = new XMLHttpRequest();
            if(element.checked){
                xhr.open("GET", "esp-outputs-action.php?action=output_update&id="+element.id+"&state=1", true);
            }
            else {
                xhr.open("GET", "esp-outputs-action.php?action=output_update&id="+element.id+"&state=0", true);
            }
            xhr.send();
        }
        function closed(element) {
            var xhr = new XMLHttpRequest();
            if(element.checked){
                xhr.open("GET", "esp-outputs-action.php?action=closed_update&cstate=1&board=1", true);
            }
            else {
                xhr.open("GET", "esp-outputs-action.php?action=closed_update&cstate=0&board=1", true);
            }
            xhr.send();
        }

        function deleteOutput(element) {
            var result = confirm("Want to delete this output?");
            if (result) {
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "esp-outputs-action.php?action=output_delete&id="+element.id, true);
                xhr.send();
                alert("Output deleted");
                setTimeout(function(){ window.location.reload(); });
            }
        }

        function createOutput(element) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "esp-outputs-action.php", true);

            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function() {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    alert("Output created");
                    setTimeout(function(){ window.location.reload(); });
                }
            }
            var outputName = document.getElementById("outputName").value;
            var outputBoard = document.getElementById("outputBoard").value;
            var outputGpio = document.getElementById("outputGpio").value;
            var outputState = document.getElementById("outputState").value;
            var httpRequestData = "action=output_create&name="+outputName+"&board="+outputBoard+"&gpio="+outputGpio+"&state="+outputState;
            xhr.send(httpRequestData);
        }
    </script>
</body>
</html>

