<?php

?>
<!DOCTYPE html>
<html>
<head>
	<title>Total Video Download from Facebook, Youtube ...</title>
	<?php
		include 'header.php';
	?>
	<style type="text/css">
		body
		{
			background-color: #DDDDDD;
			color: #2F4F4F;
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
					<div class="col-lg-8" style="background-color: #EEEEEE; border-radius: 10px">
						<h2 align="center" style="color: #2F4F4F; margin-top: 30px"> Total Video Download from Facebook, Youtube ...</h2>
						<div class="text-center">
							<img src="../image/youtube.png">
							<img src="../image/facebook.png">
							<img src="../image/instagram.png">
						</div><br>
						<div class="row">
							<div class="col-lg-2"></div>
						<div class="col-lg-8 " align="center">
							<form  action="" method=""  class="d-flex justify-content-center" >
							<!-- <input type="text" placeholder="Search here..." name="search" id="link" width="500px" height="50px" required>
							<button type="submit" class="btn btn-primary">GO!</button> -->
							 
				                <div class="input-group ">
				                    <input type="text" class="form-control " placeholder="Copy link..." name="search" id="link" size="30">
				                    
				                </div>

				         
				            <span class="input-group-btn">
				                        <button class="btn btn-success" type="button" style="background-color: #CC0000; border: none;" onclick="var data = document.getElementById('link').value; if (data == '') alert('You have not filled out the link!'); else {document.getElementById;getButtonName();}">
				                            <span class="glyphicon glyphicon-search" id="getButtonName" style="color: white; font-size: 13px">&nbsp;&nbsp;Search!&nbsp;&nbsp;</span>
				                        </button>
				                    </span>
						  

						</form>	
						</div>
						<div class="col-lg-2"></div>
						</div>
						<hr>			
						<div id="result-download"></div>

						<div id="instruction">
							<h3 align="center">Instructions</h3>
							<b>Step 1:</b> Copy your link of video that you want to download from Yo
								utube, Instagram, Facebook.<br>
									  &nbsp;&nbsp;Ex: <u>https://www.youtube.com/watch?v=es2T6KY45cA</u><br>
									  &nbsp;&nbsp;or Copy your link of picture from Instagram.<br>
									  &nbsp;&nbsp;Ex: <u>https://www.instagram.com/p/BnGDarpHVwU/?taken-by=ig_fotografdiyari</u><br><br>
							<b>Step 2:</b> Wait a few seconds...<br>
									  &nbsp;&nbsp;Actually, we also support you to get caption from Youtube<br>
									  &nbsp;&nbsp;Just click on button caption, next to button audio,<br><br>
							<b>Step 3:</b> Click on the link with quality you want, then click on download<br>
								(<span style="color: red">	Easily you can just "right click" on the link and choose "Save link as"</span>)<br><br>
							<b>Step 4: Enjoy it!</b><br>
								  &nbsp;&nbsp;If you have any problem or want to download 1080 video or higher, please <a href="#footer">contact us</a>.<br>
						</div>
						<hr>
						<div class="row row-padded homepage-grid text-center m-t p-l-md p-r-md featured">
							<div class="col-sm-4">
							<i class="fas fa-gift" style="font-size: 40px"></i><br><br>
							<h4 style="color: #C62828"><strong>Free Download</strong></h4>
							<span>Unlimitedly free conversions and downloads.</span><br>
							</div>
							<div class="col-sm-4">
							<i class="fas fa-video" style="font-size: 40px"></i><br><br>
							<h4 style="color: #C62828"><strong>Video & Audio</strong></h4>
							<span>Directly Download Video & Music.</span><br>
							 </div>
							<div class="col-sm-4">
							<i class="far fa-check-circle" style="font-size: 40px"></i><br><br>
							<h4 style="color: #C62828"><strong>Easy Download</strong></h4>
							<span>Fully compatible with all browsers.</span><br>
							</div>
						</div>
						<br><br>
						
					</div>
					<div class="col-lg-2"></div>
				</div>
			</div>
		
		<br>
		
		<div id="footer">
			<?php
				include 'footer.php';
			?>
		</div>
	</div>
	
	
</body>
<script>
	// document.getElementById('2').style.display = "none";
	// document.getElementById('3').style.display = "none";
	function checkButton(n) {
		for (var i = 1; i <=3; i++) {
			var button = "button" + i;
			if ( i != n ) {
				document.getElementById(i).style.display = "none";
				
				document.getElementById(button).style.background = "#dedede";
			}
			else {
				document.getElementById(i).style.display = "block";
				document.getElementById(button).style.background = "#CC0000";
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
