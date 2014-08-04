<?php

function generateRequestUrl($url, $params)
{
	$paramString = '';
	
	foreach ($params as $k => $v)
	{
		$paramString = $paramString.'&'.$k.'='.$v;
	}
	
	return $url.'?'.$paramString;
}

function convertResponseKVToStructuredObject($response)
{
	$dataType = '';
	$sqlData = array();

	// Convert to sql data format
	foreach ($response as $line)
	{
		if (strpos($line, 'dataType=') !== false)
		{
		    $tempArray = array();
		    $tempArray = explode('=', $line);
			$dataType = trim($tempArray[1]);
		}
		else if (strpos($line, 'dataValue=') !== false)
		{
			$lineObj['dataType'] = $dataType;
			$lineObj['dataValue'] = substr($line, strlen('dataValue='));
			array_push($sqlData, $lineObj);
		}
	}
	
	return convertSQLDataToStructuredObject($sqlData, function() { return FALSE; });
}


// Functions from KooappsFlights
function convertSQLDataToStructuredObject($results, $funcKeyFromType)
{
	$data = array();
	foreach ($results as $row)
	{
		isset($data[$row['dataType']]) == false ? $data[$row['dataType']] = array() : null;
		$newItem = convertValueStringToStructuredObject($row['dataValue']);			
		array_push($data[$row['dataType']], $newItem);
	}
	
	foreach ($data as $type => $rows)
	{
		$sortKey = $funcKeyFromType($type, isset($rows[0]['id']));
		if ($sortKey !== FALSE)
		{
			array_multisort(mapSelectKey($rows, $sortKey, 10000), $rows);
		}
		$data[$type] = $rows;
	}

	return $data;
}

function convertValueStringToStructuredObject($valueString)
{
	$newItem = array();
	$values = array_map('trim', explode(';', trim($valueString)));
	foreach ($values as $pair)
	{
		if ($pair != "")
		{
			$kv = array_map('trim', explode('=', $pair));
			$newItem[$kv[0]] = $kv[1];
		}
	}
	return $newItem;
}

function getLinkIcon($array, $appKey) {

    foreach ($array as $app) {
        if ($app['appkey'] === $appKey) {
            return 'http://' . urldecode($app['icon']);
        }
    }
    return 'assets/faqs/generalFAQsIcon.png';
}

?>
