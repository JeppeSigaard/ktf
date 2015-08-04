<?php
	// API nøgle
	$apiKey = 'AIzaSyCmI4BCilAfTazEtdWFJm0k3Cd3V-eXyjs';
	
	$get_featured = 'https://www.googleapis.com/youtube/v3/playlistItems?part=id&playlistId=PL9osYxYjKQy42o2N_WrJO_X7CNNnIpsCq&key='.$apiKey;
	
	// create a new cURL resource
	$ch = curl_init();
	
	// set URL and other appropriate options
	curl_setopt($ch, CURLOPT_URL, $get_featured);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	
	// grab URL and pass it to the browser
	curl_exec($ch);
	
	// close cURL resource, and free up system resources
	curl_close($ch);
?>