<?php
	class YouTubeDownloader {

    private $video_id;

    private $video_title;
     
   
    private $video_url;
    
    private $link_pattern;
    
    public function __construct(){
        $this->link_pattern = "/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed)\/))([^\?&\"'>]+)/";
    }
    
    // pham
    public function setUrl($url){
        $this->video_url = $url;
    }
    
    // minh
    private function getVideoInfo(){
        return file_get_contents("https://www.youtube.com/get_video_info?video_id=".$this->extractVideoId($this->video_url)."&cpn=CouQulsSRICzWn5E&eurl&el=adunit");
    }
     
   
    private function extractVideoId($video_url){
        $parsed_url = parse_url($video_url);
        if($parsed_url["path"] == "youtube.com/watch"){
            $this->video_url = "https://www.".$video_url;
        }elseif($parsed_url["path"] == "www.youtube.com/watch"){
            $this->video_url = "https://".$video_url;
        }
        
        if(isset($parsed_url["query"])){
            $query_string = $parsed_url["query"];
            parse_str($query_string, $query_arr);
            if(isset($query_arr["v"])){
                return $query_arr["v"];
            }
        }   
    }
    
    // hieu
    public function getDownloader($url){
        if(preg_match($this->link_pattern, $url)){
            return $this;
        }
        return false;
    }
     
    // hsgs
    public function getVideoDownloadLink(){
        parse_str($this->getVideoInfo(), $data);
        $this->video_title = $data["title"];
        $stream_map_arr = $this->getStreamArray();
        $final_stream_map_arr = array();
        foreach($stream_map_arr as $stream){
            parse_str($stream, $stream_data);
            $stream_data["title"] = $this->video_title;
            $stream_data["mime"] = $stream_data["type"];
            $mime_type = explode(";", $stream_data["mime"]);
            $stream_data["mime"] = $mime_type[0];
            $start = stripos($mime_type[0], "/");
            $format = ltrim(substr($mime_type[0], $start), "/");
            $stream_data["format"] = $format;
            unset($stream_data["type"]);
            $final_stream_map_arr [] = $stream_data;         
        }
        return $final_stream_map_arr;
    }
     
  
    private function getStreamArray(){
        parse_str($this->getVideoInfo(), $data);
        $stream_link = $data["url_encoded_fmt_stream_map"];
        return explode(",", $stream_link); 
    }
     
   
    public function hasVideo(){
        $valid = true;
        parse_str($this->getVideoInfo(), $data);
        if($data["status"] == "fail"){
            $valid = false;
        } 
        return $valid;
    }
     
}
if (isset($_GET['videoNumber'])) {
	$i = $_GET['videoNumber'];
	$handler = new YouTubeDownloader();
	$youtubeURL = $_GET['youtubeLink'];
	if(!empty($youtubeURL) && !filter_var($youtubeURL, FILTER_VALIDATE_URL) === false){
	    $downloader = $handler->getDownloader($youtubeURL);
	    $downloader->setUrl($youtubeURL);
	    if($downloader->hasVideo()){
	        $videoDownloadLink = $downloader->getVideoDownloadLink();	        
	        $videoTitle = $videoDownloadLink[$i]['title'];
	        $videoQuality = $videoDownloadLink[$i]['quality'];
	        $videoFormat = $videoDownloadLink[$i]['format'];
	        $videoFileName = strtolower(str_replace(' ', '_', $videoTitle)).'.'.$videoFormat;
	        $downloadURL = $videoDownloadLink[$i]['url']; 
	        $fileName = preg_replace('/[^A-Za-z0-9.\_\-]/', '', basename($videoFileName));
	        if(!empty($downloadURL)){
	            //  headers. test 26-08-2018
	            header("Cache-Control: public");
	            header("Content-Description: File Transfer");
	            header("Content-Disposition: attachment; filename=$fileName");
	            header("Content-Type: application/zip");
	            header("Content-Transfer-Encoding: binary");  
	            readfile($downloadURL);
	        }
	    }else{
	        echo "The video is not found, please check YouTube URL.";
	    }
	}else{
	    echo "Please provide valid YouTube URL.";
	}
}
?>