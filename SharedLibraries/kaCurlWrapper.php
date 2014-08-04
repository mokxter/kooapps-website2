<?php

function kaCurlGet($url, $timeout, $header)
{
	$curl = curl_init();
	curl_setopt ($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HEADER, $header);
	curl_setopt($curl, CURLOPT_VERBOSE, 1);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
	$result = curl_exec ($curl);
	$error = curl_errno($curl);
	curl_close($curl);
	return !$error ? $result : FALSE;
}

function kaCurlPost($url, $timeout, $value)
{
	$curl = curl_init();
	curl_setopt ($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_VERBOSE, 1);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $value);
	$result = curl_exec ($curl);
	$error = curl_errno($curl);
	curl_close($curl);
	return !$error ? $result : FALSE;
}

?>