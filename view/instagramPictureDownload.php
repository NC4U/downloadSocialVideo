<!DOCTYPE html>
<html>
<head>
	<title>More</title>
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
						<h2 align="center">You can get any picture from: Instagram @.@</h2>
						<form  action="" method="" align="center">
						  <input type="text" placeholder="Search.." name="search" id="link" >
						</form>	
						<hr>			
						<div id="result-download"></div>
						
					</div>
					<div class="col-lg-2"></div>
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
	<script>
		$(document).ready(function()
		{
		 load_data();
		 function load_data(search)
		 {
		  $.ajax({
		   url:"../control/instaPic.php",
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
</body>
</html>