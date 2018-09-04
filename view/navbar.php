<nav style="margin-bottom: 10px">
	<div style="margin-top: 10px;">
	<a href="index.php"><img src="../image/youtube-downloader.png" height="70px" width="70px"></a>
	
		<h4 style="color: #2F4F4F; position: absolute; bottom: 5px; margin-left: 70px">totalvideo.net 
		</h4>
		
	
        <div class="dropdown" style="color: #2F4F4F; ; float: right; bottom: 0px; margin-top: 40px; margin-left: 5px; border: 0px">
          	<?php
          		
          		if ( $_SERVER['PHP_SELF'] == '/youtube/view/index.php') {
          	?>
          	<a  class="nav-link  dropdown-toggle" data-toggle="dropdown">
            English
          	</a>
          	<?php
           		} elseif ($_SERVER['PHP_SELF'] == '/youtube/view/index.php/vi') {
          	?>
      		<a  class="nav-link  dropdown-toggle" data-toggle="dropdown">
            Tieng Viet
          	</a>
          	<?php
          		} else {
          	?>
          	<a  class="nav-link  dropdown-toggle" data-toggle="dropdown">
	            English
	          	</a>
          	<?php
          		}
          	?>
          <div class="dropdown-menu" style="background-color: #DDDDDD;">
            <a class="dropdown-item" href="index.php/en" style="width:auto;" id="vi" onmouseenter="document.getElementById('en').style.background='#EEEEEE'" onmouseleave="document.getElementById('en').style.background='#DDDDDD'">English</a>
            <a class="dropdown-item" href="index.php/vi" onmouseenter="document.getElementById('vi').style.background='#EEEEEE'" onmouseleave="document.getElementById('vi').style.background='#DDDDDD'" id="en">Tieng Viet</a>
          </div>
        </div>
        </li>
	

	
	
	</div>
</nav>
