<?php
	class Validation {

		// use pre_match is another way :D

		function checkYoutubeLink($youtubeLink) {
			$arr = parse_url($youtubeLink);
			if (isset($arr['host']) && isset($arr['scheme']) && isset($arr['path']) && isset($arr['query']) && $arr['host'] == "www.youtube.com" && $arr['path'] == "/watch" && $arr['scheme'] == "https" && strlen($arr['query']) == 13) {
				
					return true;
				
			} else return false;
		}
		function checkFacebookLink($facebookLink) {
			$arr = parse_url($facebookLink);
			if (isset($arr['host']) && isset($arr['scheme']) && isset($arr['path']) && $arr['host'] == "www.facebook.com" && $arr['scheme'] == "https") {
				return true;
			} else return false;
		}
		function checkInstagramLink($instagramLink) {
			$arr = parse_url($instagramLink);
			// $path and $query, and $query usually is explore=true
			if (isset($arr['host']) && isset($arr['scheme']) && $arr['host'] == "www.instagram.com" && $arr['scheme'] == "https") {
				return true;
			} else return false;
		}
	}
	if (isset($_POST['query'])) {
		$query = $_POST['query'];
		$checkInstagram = Validation::checkInstagramLink($query);
	}	
	if (isset($checkInstagram) && $checkInstagram == true) {
		$url = $_POST['query'];
		$data = file_get_contents($url);
		function getPictureInstagram($curl_content)
		{

		    $regex = '/"src":"([^"]+)"/';
		    if (preg_match($regex, $curl_content, $match)) {
		    	$n = count($match);
		        return $match[$n-1];

		    } else {return;}
		}
		$picture_url = getPictureInstagram($data);
		$content = "
			<div class = 'row' id = 'result'>
				<div class = 'col-lg-8'>
					<p class = 'text-center'><b>Image</b></p>
					<img src = '$picture_url'>
				</div>
				<div class = 'col-lg-4'>
					<div class = 'text-center'><b>From:</b></div><br>
					<div class = 'text-center'><b>Source:</b></div><br>
					<div class = 'col-sm-10'><a href = '$url'>$url</a></div><br>
					<p class = 'text-center'><b>Download Link</b>(Save link as)</p>
					<p class = 'text-center'><a href = '$picture_url'>Highest quality</a></p>
				</div>
			</div>
		";
		echo $content;
	} 
?>