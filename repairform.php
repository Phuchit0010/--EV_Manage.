<?php	
    require_once 'config.php';
	include 'sidebar.php';
	//include "nav.php";
	date_default_timezone_set('Asia/Bangkok');
	ini_set('mysql.connect_timeout', 300);
    ini_set('default_socket_timeout', 300);
?>	

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Register</title>
	<style>	
		.card-body-server {
			height: 580px;
			overflow-y: scroll;
			
		}
		input, select {
			margin-bottom: 10px;
		}
		button {
			margin-top: 10px;
		}

		#productDisplay {
			border-radius: 100%;
		}
	</style>

<script>
  
  function getDataFromDb()
  {
      $.ajax({ 
                  url: "get_rfid_data.php" ,
                  type: "POST",
                  data: ''
              })
              .success(function(result) { 
                  var obj = jQuery.parseJSON(result);
                      if(obj != '')
                      {

                            $("#myBody").empty();
                            $.each(obj, function(key, val) {
                                      var tr = "<input type='text' name='rfid_text' id='rfid_text' class='form-control' value='"+val["RFID_ID"]+" '>";
                                      
                                      $('#myRFID > span').append(tr);
                            });
                           
                      }
  
              });
  
  }
  
  setInterval(getDataFromDb, 100);   // 1000 = 1 second
</script>
</head>
<body class="font-mali">
<main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
<h3 style="font-weight:bold;">Add Repair History</h3>
    <h7 class="h5">Add of Repair History</h7>
				<div class="container mb-2" style="width:60%;">
		<div class="row mt-2 ">
			<div class="col" >
				<div class="card">
					<center><h4 class="card-header bg-danger text-white">Add Users</h4></center>
					<div class="card-body">
						<form action="registerRP.php" method="POST" enctype="multipart/form-data">
								
                                    <span id="myBody"></span> 

							<div class="form-group">
								<label for="">รหัสการซ่อมเเซม</label>
								<input type="text" name="ID" class="form-control" value=" " required>
							</div>
			
							<div class="form-group">
								<label for="">รายการซ่อม</label>
								<input type="text" name="repair_list" class="form-control" value=" " required>
							</div>
							<div class="form-group">
								<label for="">ผู้รับมอบ</label>
								<input type="text" name="signation" class="form-control" value=" " required>
							</div>		
								
							<button class="btn btn-success" type="submit" name="submit" id="submit" >บันทึก</button>
							<button class="btn btn-primary" type="submit" name="showstock" formaction="repair.php" >ดูบัญชีผู้ใช้งาน</button>
						</form>
					</div>
				</div>
			</div>

</main>
	

	<script>
		function myFunction() {
  // Get the text field
		var copyText = document.getElementById("rfid_text");

		// Select the text field
		copyText.select();
		copyText.setSelectionRange(0, 99999); 

		navigator.clipboard.writeText(copyText.value);

	
		}
	</script>		
	<script src="imageDisplay.js"></script>
	<?php
	?>
</body>
</html>

