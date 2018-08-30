<?php

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<?php
		include 'header.php';
	?>
	<style type="text/css">
		body
		{
			background-color: #E6E6FA;
			color: #2F4F4F;
		}
		#instruction
		{
			white-space: pre;
		}
		img 
		{
			height: 50px;
			width: 50px;
		}
		a > img
		{
			height: 70px;
			width: 70px;
		} 
		#custom-search-input{
		    padding: 3px;
		    border: solid 1px #E4E4E4;
		    border-radius: 6px;
		    background-color: #fff;
		}

		#custom-search-input input{
		    border: 0;
		    box-shadow: none;
		}

		#custom-search-input button{
		    margin: 2px 0 0 0;
		    background: none;
		    box-shadow: none;
		    border: 0;
		    color: #666666;
		    padding: 0 8px 0 10px;
		    border-left: solid 1px #ccc;
		}

		#custom-search-input button:hover{
		    border: 0;
		    box-shadow: none;
		    border-left: solid 1px #ccc;
		}

		#custom-search-input .glyphicon-search{
		    font-size: 23px;
		}
	</style>
</head>
<body>
	<div>
		<div class="container-fluid" id="header">
			<div class="row">
				<div class="col-lg-2"></div>
				<div class="col-lg-8">
					<?php
					include 'navbar.php';
					?>
				</div>	
				<div class="col-lg-2"></div>
			</div>
		</div>
		
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-2"></div>
					<div class="col-lg-8" style="background-color: #F8F8FF">
						<h2 align="center" style="color: #2F4F4F"> Downloading video and audio now is so easy!</h2>
						<div class="text-center">
							<img src="../image/youtube.png">
							<img src="../image/facebook.png">
							<img src="../image/instagram.png">
						</div><br>
						<form  action="" method=""  class="d-flex justify-content-center" >
							<!-- <input type="text" placeholder="Search here..." name="search" id="link" width="500px" height="50px" required>
							<button type="submit" class="btn btn-primary">GO!</button> -->
							 <div id="custom-search-input">
				                <div class="input-group ">
				                    <input type="text" class="form-control " placeholder="Search here..." name="search" id="link" size="40">
				                    <span class="input-group-btn">
				                        <button class="btn btn-success" type="button" onclick="var data = document.getElementById('link').value; if (data == '') alert('You have not filled out the link!'); else {document.getElementById;getButtonName();}">
				                            <b class="glyphicon glyphicon-search" id="getButtonName">GO!</b>
				                        </button>
				                    </span>
				                </div>
				            </div>
						  

						</form>	
						<hr>			
						<div id="result-download"></div>

						<div id="instruction">
							<b>Step 1:</b> Copy your link of video that you want to download from Yo
								utube, Instagram, Facebook.
								Ex: <u>https://www.youtube.com/watch?v=es2T6KY45cA</u>
								or Copy your link of picture from Instagram.
								Ex: <u>https://www.instagram.com/p/BnGDarpHVwU/?taken-by=ig_fotografdiyari</u>
							<b>Step 2:</b> Wait a few seconds...
								Actually, we also support you to get caption from Youtube
								Just click on button caption, next to button audio,
							<b>Step 3:</b> Click on the link with quality you want, then click on download
								(<span style="color: red">Easily you can just "right click" on the link and choose "Save link as"</span>)
							<b>Step 4: Enjoy it!</b>
							If you have any problem or want to download 1080 video or higher, please <a href="#footer">contact us</a>.
						</div>
						
					</div>
					<div class="col-lg-2"></div>
				</div>
			</div>
		
		<hr>
		
		<div id="footer">
			<?php
				include 'footer.php';
			?>
		</div>
	</div>
	
	
</body>
<script>
	document.getElementById('2').style.display = "none";
	document.getElementById('3').style.display = "none";
	function checkButton(n) {
		for (var i = 1; i <=3; i++) {
			var button = "button" + i;
			if ( i != n ) {
				document.getElementById(i).style.display = "none";
				
				document.getElementById(button).style.background = "gray";
			}
			else {
				document.getElementById(i).style.display = "block";
				document.getElementById(button).style.background = "red";
			}
		}
	}
	function getButtonName() {
		var searchText = document.getElementById('link').value;

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
	   dataType:'json',
	   data:{query:search},
	   success:function(data)
	   {
	   	console.log(data);
	    $('#result-download').html(data.content);
	    // $('#result-youtube').css("background-color","gainsboro");
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