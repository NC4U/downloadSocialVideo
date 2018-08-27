<?php
$url = 'https://www.instagram.com/p/BmtRBRAlut-/?taken-by=ig_fotografdiyari';
		$data = file_get_contents($url);
		print_r($data);
		// function getVideoInstagram($curl_content)
		// {

		//     $regex = '/"video_url":"([^"]+)"/';
		//     if (preg_match($regex, $curl_content, $match)) {
		//         return $match[1];

		//     } else {return "ccccccccc";}
		// }
		// $video_url = getVideoInstagram($data);
		// echo "<a href = '$video_url'>dow</a>";
?>