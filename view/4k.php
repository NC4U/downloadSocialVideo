<?php
function get_youtube($id)
{
    $data = file_get_contents('http://youtube.com/get_video_info?video_id=' . $id . '&el=vevo&fmt=37&asv=2&hd=1');
    $d = parse_str($data);
    // parse_str($data , $details);
    print_r($data);exit();
    $my_formats_array = explode(',' , $adaptive_fmts);
    $avail_formats[] = '';
    $i = 0;
    $ipbits = $ip = $itag = $sig = $quality_label = '';
    $expire = time();

    foreach ($my_formats_array as $format) {
         parse_str($format);
         $avail_formats[$i]['itag'] = $itag;
         $avail_formats[$i]['quality'] = $quality_label;
         $type = explode(';', $type);
         $avail_formats[$i]['type'] = $type[0];
         $avail_formats[$i]['url'] = urldecode($url) . '&signature=' . $sig;
         parse_str(urldecode($url));
         $avail_formats[$i]['expires'] = date("G:i:s T", $expire);
         $avail_formats[$i]['ipbits'] = $ipbits;
         $avail_formats[$i]['ip'] = $ip;
         $i++;
     }
     return $avail_formats;
}
$qualitys = get_youtube("2Vv-BfVoq4g");

foreach($qualitys as $video)
{
    //echo "<a href='" . $video['url'] . "'>" . $video['quality'] . "-" . $video['type'] .  "</a></br>"; //print all resolution
    // for getting 1080p only
    if($video['quality']=='1080p' && $video['type']=='video/mp4'){
        echo "<a href='" . $video['url'] . "'>" . $video['quality'] . "-" . $video['type'] .  "</a></br>";
    }
}
?>