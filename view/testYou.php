<?php
	
	$url = "https://www.youtube.com/get_video_info?video_id=2Vv-BfVoq4g";
	$data = file_get_contents($url);
	parse_str($data);
		// $arr = explode(" ", $url_encoded_fmt_stream_map);
	if ($url_encoded_fmt_stream_map=="") echo "cc";
?>                                              