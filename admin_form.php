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
<h3 style="font-weight:bold;">Register Admin</h3>
    <h7 class="h5">Add a elevators admin account </h7>
				<div class="container mb-2" style="width:60%;">
		<div class="row mt-2 ">
			<div class="col" >
				<div class="card">
					<center><h4 class="card-header bg-danger text-white">Add Users</h4></center>
					<div class="card-body">
						<form action="registerA.php" method="POST" enctype="multipart/form-data">
								
                                    <span id="myBody"></span> 

							<div class="form-group">
								<label for="">ชื่อและนามสกุล</label>
								<input type="text" name="name" class="form-control" value=" " required>
							</div>
							<div class="form-group">
								<label for="">ตำแหน่ง</label><br>
								<select name="role" id="" class="form-select" aria-label="Default select example" >
									<option value="">---เลือก---</option>
									<option value="admin">admin</option>
								
								</select>
							</div>
							<div class="form-group">
								<label for="">username</label>
								<input type="text" name="username" class="form-control" value=" " required>
							</div>
							<div class="form-group">
								<label for="">Password</label>
								<input type="text" name="password" class="form-control" value=" " required>
							</div>							
							<button class="btn btn-success" type="submit" name="submit" id="submit" >บันทึก</button>
							<button class="btn btn-warning" type="submit" name="reset" id="reset"  >รีเซ็ต</button>
							<button class="btn btn-primary" type="submit" name="showstock" formaction="adminL.php" >ดูบัญชีผู้ใช้งาน</button>
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

