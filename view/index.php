<?php

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<?php
		include 'header.php';
	?>
	<link rel="shortcut icon" href="../favicon.ico">
</head>
<body>
	<div>
		<div id="header">
			<?php
				include 'navbar.php';
			?>	
		</div>
		<div >
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-2"></div>
					<div class="col-lg-8" style="">
						<h2 align="center">Currently, you can download video from: Youtube, Facebook, Instagram</h2>
						<form  action="" method="" align="center">
						  <input type="text" placeholder="Search.." name="search" id="link" >
						</form>	
						<hr>			
						<div id="result-download"></div>
						
					</div>
					<div class="col-lg-2">
						<br>
						<a href="instagramPictureDownload.php" class = "btn btn-success" role = "button">Get Picture From Instagram</a>
					</div>
				</div>
			</div>
		</div>
		
		<div class="well">
		    <div class="centered">
		      <span style="text-align:center;display:block;"> Created by HieuPham</span>
		    </div>
		</div>
  		<div id="footer">
		</div>
	</div>
	
	
</body>
<script>
	document.getElementById('2').style.display = "none";
	document.getElementById('3').style.display = "none";
	function checkButton(n) {
		for (var i = 1; i <=3; i++) {
			if ( i != n ) {
				document.getElementById(i).style.display = "none";
			}
			else {
				document.getElementById(i).style.display = "block";
			}
		}
	}
</script>
</html>
<script>
	$(document).ready(function()
	{
	 load_data();
	 function load_data(search)
	 {
	  $.ajax({
	   url:"../control/control.php",
	   method:"POST",
	   data:{query:search},
	   success:function(data)
	   {
	   	console.log(data);
	    $('#result-download').html(data);
	    $('#result').css("background-color","gainsboro");
	   }
	  });
	 }
	 $('#link').keyup(function(){
	  var search = $(this).val();
	  if(search != '')
	  {
	   load_data(search);
	  }
	  else
	  {
	   load_data();
	  }
	 });
	});
</script>