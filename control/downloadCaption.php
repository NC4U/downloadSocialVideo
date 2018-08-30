<?php
	if (isset($_GET['language'])) {
		if (isset($_GET['name']) && $_GET['name'] != "") {
			$captionLink = "https://www.youtube.com/api/timedtext?fmt=vtt&v=".$_GET['videoId']."&lang=".$_GET['language']."&name=".$_GET['name'];
			$captionResource = file_get_contents($captionLink);
		} else {
			$captionLink = "https://www.youtube.com/api/timedtext?fmt=vtt&v=".$_GET['videoId']."&lang=".$_GET['language'];
			$captionResource = file_get_contents($captionLink);
		} 
		$filename = 'result_file.txt';
	    header("Content-Type: text/plain");
	    header('Content-Disposition: attachment; filename="'.$filename.'"');
	    header("Content-Length: " . strlen($captionResource));
	    echo $captionResource;
	    exit;
	}	
?>