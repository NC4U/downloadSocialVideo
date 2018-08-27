<?php
	$url = 'https://www.facebook.com/subfactoryVN/videos/280764929419752/';
	$context = [
    'http' => [
        'method' => 'GET',
        'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.47 Safari/537.36",
    ],
];
$context = stream_context_create($context);
$data = file_get_contents($url, false, $context);
print_r($data);
// $data = file_get_contents($url);
// parse_str($data);
// print_r($data);
?>
