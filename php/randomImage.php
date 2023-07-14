<?php
//Api key in backend = much more secure
$api_key = "3f1krjomBOrGCzqXRot4uZtjRtwCw49VbBqdiagcISd91VKh9NUmUZdu";
$api_url = "https://api.pexels.com/v1/";

$http_options = array(
	'http' => array (
		'method' => "GET",
		'header' => "Authorization: " . $api_key
	)
);

//debug data to prevent blowing up my api limit
// echo '{"page":48,"per_page":1,"photos":[{"id":1011437,"width":2743,"height":2743,"url":"https://www.pexels.com/photo/aerial-photo-of-white-boat-1011437/","photographer":"Deva Darshan","photographer_url":"https://www.pexels.com/@darshan394","photographer_id":325118,"avg_color":"#292B29","src":{"original":"https://images.pexels.com/photos/1011437/pexels-photo-1011437.jpeg","large2x":"https://images.pexels.com/photos/1011437/pexels-photo-1011437.jpeg?auto=compress\u0026cs=tinysrgb\u0026dpr=2\u0026h=650\u0026w=940","large":"https://images.pexels.com/photos/1011437/pexels-photo-1011437.jpeg?auto=compress\u0026cs=tinysrgb\u0026h=650\u0026w=940","medium":"https://images.pexels.com/photos/1011437/pexels-photo-1011437.jpeg?auto=compress\u0026cs=tinysrgb\u0026h=350","small":"https://images.pexels.com/photos/1011437/pexels-photo-1011437.jpeg?auto=compress\u0026cs=tinysrgb\u0026h=130","portrait":"https://images.pexels.com/photos/1011437/pexels-photo-1011437.jpeg?auto=compress\u0026cs=tinysrgb\u0026fit=crop\u0026h=1200\u0026w=800","landscape":"https://images.pexels.com/photos/1011437/pexels-photo-1011437.jpeg?auto=compress\u0026cs=tinysrgb\u0026fit=crop\u0026h=627\u0026w=1200","tiny":"https://images.pexels.com/photos/1011437/pexels-photo-1011437.jpeg?auto=compress\u0026cs=tinysrgb\u0026dpr=1\u0026fit=crop\u0026h=200\u0026w=280"},"liked":false,"alt":"Aerial Photo of White Boat"}],"total_results":371,"next_page":"https://api.pexels.com/v1/search/?orientation=square\u0026page=49\u0026per_page=1\u0026query=ocean","prev_page":"https://api.pexels.com/v1/search/?orientation=square\u0026page=47\u0026per_page=1\u0026query=ocean"}';
// return;

echo getImage(null, $http_options, $api_url);

function getImage($imageId, $options, $url) {
	if (is_null($imageId)) { //get random image ID first
		$context = stream_context_create($options);
		$request = fopen($url . '/search?query=ocean&orientation=square', 'r', false, $context);
		$data = json_decode(stream_get_contents($request));
		fclose($request);

		$randomImage = rand(1, $data->total_results);
		return getImage($randomImage, $options, $url); //recursion woo!
	}
	$context = stream_context_create($options);
	$request = fopen($url . '/search?query=ocean&orientation=square&per_page=1&page=' . $imageId, 'r', false, $context);
	$data = stream_get_contents($request); //keep json encoding for javascript
	fclose($request);
	return $data;
}
?>