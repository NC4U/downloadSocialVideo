<?php
	//check link

// CODE lởm quá, video 4k không lấy đc gì hết, khóa hết link
// ĐỌc trực tiếp link cũng toàn ra link private
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
		$checkYoutube = Validation::checkYoutubeLink($query);
		$checkFacebook = Validation::checkFacebookLink($query);
		$checkInstagram = Validation::checkInstagramLink($query);
	}
	// YOUTUBE
	if (isset($checkYoutube) && $checkYoutube == true) {
		// VIDEO
		
		$youtubeLink = $query;
		// echo "<h2>Right click -> save query as</h2><br>";
		$id = str_replace("https://www.youtube.com/watch?v=", "", $query);
		$downloadquery = str_replace("watch?v=", "get_video_info?video_id=", $query);		
		$data = file_get_contents($downloadquery);
		parse_str($data);
		$arr = explode(",", $url_encoded_fmt_stream_map);
		$videoNumber = 0;
		$text = "
		<div class = 'row' id='result'>
		<div class='col-lg-4' >
			<embed src='https://www.youtube.com/embed/".$id."' allowfullscreen='true' >
		</div>
		<div class = 'col-lg-4'>
			<p class = 'text-center'><b>Information</b></p>
			<div class = 'col-sm-2'><b>Title:</b></div>
			<div class = 'col-sm-10'>$title</div>
			<div class = 'col-sm-2'><b>Views:</b></div>
			<div class = 'col-sm-10'> $view_count</div>
		</div>
		<div class='col-lg-4 text-center' >
			<div id='myDIV'>
			  <button class='btn btn-success' onclick='checkButton(1);'>video-1</button>
			  <button class='btn btn-success' onclick='checkButton(2);'>audio-2</button>
			  <button class='btn btn-success' onclick='checkButton(3);'>caption-3</button>
			</div><hr>
			<div id='1'>
		";

		// VIdeo 4k khoong lay dc kieu nay
	if (isset($url_encoded_fmt_stream_map) && $url_encoded_fmt_stream_map != "") {

		foreach ($arr as $item) {
			parse_str($item);
			$type = str_replace(strstr($type,';'), "", $type);
			$text.= "<a href='../control/downloadVideo.php?videoNumber=$videoNumber&youtubeLink=$youtubeLink'>$quality($type)</a><br><br>";
			$videoNumber++;
		}
		// query 1080  gốc của youtube cũng không có âm thanh @@
		$data1 = file_get_contents($downloadquery);
		parse_str($data1);
		$arr = explode(",", $adaptive_fmts);
		for ($i = 0; $i <count($arr); $i++) {
        	parse_str($arr[$i], $vdata);
        	$vdata['type'] = str_replace(strstr($vdata['type'],';'), "", $vdata['type']);
         	if (isset($vdata['quality_label']) && $vdata['quality_label'] == "1080p") { 
            	$text.= "<a href='".$vdata['url']."'>".$vdata['quality_label']."-video only-".$vdata['type']."</a><br><br>";
        	}
    	}
    	$text.= "</div><div id='2'>";     	
    	for ($i = 0; $i <count($arr); $i++) {
        	parse_str($arr[$i], $vdata);
        	$vdata['type'] = str_replace(strstr($vdata['type'],';'), "", $vdata['type']);
         	if (isset($vdata['type']) && strpos($vdata['type'],"audio") !== false) { 
            	$text.= "<a href='".$vdata['url']."'>".$vdata['type']."</a><br><br>";
        	}
    	}
    	$text.="</div><div id='3'>";
	} else echo $text.= "Video 4k - i havent found out the way to get this video";
		//MP3
		// echo "<iframe style='background: #fff;min-height:120px;min-width:320px' src='http://api.youtube6download.top/fetch/query.php?i=$id' width='auto' marginheight='0' marginwidth='0' scrolling='No' frameborder='0'></iframe><hr>";
    
		//Caption
		$key = "AIzaSyAjP3LcpTikmOGOxrIqJ7F8rOH6hlvydaA";
		$captionquery = "https://www.googleapis.com/youtube/v3/captions?part=snippet&videoId=".$id."&key=".$key;
		$str = file_get_contents($captionquery);
		$json = json_decode($str, true);
		// Them bien caption de kiem tra xem co caption khong
		// Hoac vao kiem tra mang xem co ton tai hay khong cho nhanh
		
		for ($i = 0; $i < count($json['items']); $i++ ) {
		  
			if ($json['items'][$i]['snippet']['trackKind'] == "ASR") {
				$text.= "<a href='downloadCaption.php?language=".$json['items'][$i]['snippet']['language'] ."&name=".$json['items'][$i]['snippet']['name']."&videoId=".$id. "' >Language: ".$json['items'][$i]['snippet']['language']."</a>--";
				$text.= "Phụ đề này được dịch tự động, Lúc có nội dung, lúc không @@<br><br><br>";
			} else {
				$text.= "<a href='downloadCaption.php?language=".$json['items'][$i]['snippet']['language'] ."&name=".$json['items'][$i]['snippet']['name']."&videoId=".$id. "'>Language: ".$json['items'][$i]['snippet']['language']."</a><br><br>";
			}

	  	}
	  	$text.="
	  		</div>
	  	</div>
	  	</div>
	  	";
	  	// $message = array();
	  	// $message = array(
	  	// 	'content' => $text,
	  	// );
	  	// echo json_encode($message);
	  	echo $text;
	  	
	}
// CHECK FACRBOOK LINK

	if (isset($checkFacebook) && $checkFacebook == true) {
		$url = $_POST['query'];
		$context = [
		    'http' => [
		        'method' => 'GET',
		        'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.47 Safari/537.36",
		    ],
		];
		$context = stream_context_create($context);
		$data = file_get_contents($url, false, $context);

		function cleanStr($str)
		{
		    return html_entity_decode(strip_tags($str), ENT_QUOTES, 'UTF-8');
		}

		function hd_no_ratelimit($curl_content)
		{

		    $regex = '/hd_src_no_ratelimit:"([^"]+)"/';
		    if (preg_match($regex, $curl_content, $match)) {
		        return $match[1];

		    } else {return;}
		}

		function sd_no_ratelimit($curl_content)
		{

		    $regex = '/sd_src_no_ratelimit:"([^"]+)"/';
		    if (preg_match($regex, $curl_content, $match)) {
		        return $match[1];

		    } else {return;}
		}

		function sd($curl_content)
		{

		    $regex = '/sd_src:"([^"]+)"/';
		    if (preg_match($regex, $curl_content, $match)) {
		        return $match[1];

		    } else {return;}
		}

		function hd($curl_content)
		{

		    $regex = '/hd_src:"([^"]+)"/';
		    if (preg_match($regex, $curl_content, $match)) {
		        return $match[1];

		    } else {return;}
		}

		function getTitle($curl_content)
		{
		    $title = null;
		    if (preg_match('/h2 class="uiHeaderTitle"?[^>]+>(.+?)<\/h2>/', $curl_content, $match)) {
		        $title = $match[1];
		    } elseif (preg_match('/title id="pageTitle">(.+?)<\/title>/', $curl_content, $match)) {
		        $title = $match[1];
		    }
		    return cleanStr($title);
		}

		$hd_max = hd_no_ratelimit($data);
		$sd_max = sd_no_ratelimit($data);
		$hd = hd($data);
		$sd = sd($data);
		$title = gettitle($data);
		$content = "
			<div class = 'row' id = 'result'>
				<div class = 'col-lg-4'>
					<p class = 'text-center'><b>Video</b></p>
					<p class = 'text-center'>
						<iframe 
							src='https://www.facebook.com/plugins/video.php?href=".$url."&show_text=0' 
				  			style='border:none;overflow:hidden' 
				  			scrolling='no' frameborder='0' allowTransparency='true' allowFullScreen='true'
						></iframe>
					</p>
				</div>
				<div class = 'col-lg-4'>
					<p class = 'text-center'><b>Information</b></p>
					<div class = 'col-sm-2'>Title:</div>
					<div class = 'col-sm-10'><b>$title</b></div>
					<div class = 'col-sm-2'>Source:</div>
					<div class = 'col-sm-10'><a href = '$url'>$url</a></div>
				</div>
				<div class = 'col-lg-4'>
					<p class = 'text-center'><b>Download Link</b></p>
		";
		if ($sd_max != "") {
			$sd_final = $sd_max;
		} else {
			$sd_final = $sd;
		}
		if ($hd_max != "") {
			$hd_final = $hd_max;
		} else {
			$hd_final = $hd;
		}
		$content.= "
					<p class = 'text-center'><a href = '$hd_final'>Video-HD</a></p>
					<p class = 'text-center'><a href = '$sd_final'>Video-SD</a></p>
				</div>
			</div>
		";
		// $message = array();

		// if ($sd_max != "") {
		//     $message = array(
		//         'type' => 'success',
		//         // 'title' => $title,
		//         // 'hd_download_url' => $hd_max,
		//         // 'sd_download_url' => $sd_max,
		        
		//         // ~~~~~~~~~~~~~~~~~~~~~
		//         'content' =>  $content,

		//     );
		// } else {
		//     $message = array(
		//         'type' => 'failure',
		//         'message' => 'Error retrieving the download link for the url. Please try again later',
		//     );
		// }
		// echo json_encode($message);
		echo $content;

	}

	// INSTAGRAM
	if (isset($checkInstagram) && $checkInstagram == true) {
		$url = $_POST['query'];
		$data = file_get_contents($url);
		function getVideoInstagram($curl_content)
		{

		    $regex = '/"video_url":"([^"]+)"/';
		    if (preg_match($regex, $curl_content, $match)) {
		        return $match[1];

		    } else {return;}
		}
		function getUserNameInstagram($curl_content)
		{

		    $regex = '/@/';
		    if (preg_match($regex, $curl_content, $match)) {
		        return $match[0];

		    } else {return;}
		}
		$video_url = getVideoInstagram($data);
		$username = getUserNameInstagram($data);
		$content = "
			<div class = 'row' id = 'result'>
				<div class = 'col-lg-4'>
					<p class = 'text-center'><b>Video</b></p>
					<p class = 'text-center'>
						<iframe 
							src='$video_url' 
				  			style='border:none;overflow:hidden' 
				  			scrolling='no' frameborder='0' allowTransparency='true' allowFullScreen='true' 
						></iframe>
					</p>
				</div>
				<div class = 'col-lg-4'>
					<p class = 'text-center'><b>Information</b></p>
					<div class = 'col-sm-2'>From:</div>
					<div class = 'col-sm-10'><b>$username</b></div>
					<div class = 'col-sm-2'>Source:</div>
					<div class = 'col-sm-10'><a href = '$url'>$url</a></div>
				</div>
				<div class = 'col-lg-4'>
					<p class = 'text-center'><b>Download Link</b></p>
					<p class = 'text-center'><a href = '$video_url'>Default quality</a></p>
				</div>
			</div>
		";
		echo $content;
	} 
?>