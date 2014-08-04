<?php

require_once(dirname(__FILE__) . '/SharedLibraries/KooappsUtils.php');
require_once(dirname(__FILE__) . '/SharedLibraries/kaCurlWrapper.php');
require_once(dirname(__FILE__) . '/applicationlib/utils.php');

try
{
	$request = array(
		'appName' => 'marketing.kooappswebsite',
		'flight' => 'live',
		'version' => '1.0',
		'udid' => 'kooappswebsite',
	);
	
	$request['hash'] = generateHash($request, $request['udid']);
	$url = generateRequestUrl('http://www.kooappsservers.com/kooappsFlights/getData.php', $request);
	$response = kaCurlGet($url, 30, 'Content-Type: application/plain');

	$response = str_replace(';;;;', ';;;', $response);
	$keyvalue = array_map('trim', explode(";;;", $response));
	
	// Verify response
	($keyvalue[0] === 'status=ok') || die('invalid response from flights');
	(strpos($keyvalue[1], 'flight=') === 0) || die('invalid response from flights');
	($keyvalue[1] === $keyvalue[count($keyvalue) - 1]) 
		|| ($keyvalue[1] === $keyvalue[count($keyvalue) - 2]) 
		|| die('invalid response from flights');
	
	// Data to objects
	$websiteData = convertResponseKVToStructuredObject($keyvalue);
}
catch (Exception $e)
{
	// Email error to admin : )
}

?>
<html>
	<head>
		<title> Kooapps | Make games we wanna show our friends</title>
	</head>
	<body>
		<h1>Banners</h1>
		<pre>
		<?php
		foreach ($websiteData['banners'] as $banner)
		{
			var_dump($banner);
		}
		?>
		</pre>
		
		<h1>FAQs</h1>
		<pre>
		<?php
		foreach ($websiteData['faqs'] as $faqs)
		{
			var_dump($faqs);
		}
		?>
		</pre>
		
		<h1>Games</h1>
		<pre>
		<?php
		foreach ($websiteData['games'] as $games)
		{
			var_dump($games);
		}
		?>
		</pre>
	</body>
</html>
