<?php

function generateHash($request, $key)
{
	if (ksort($request, SORT_STRING) === FALSE)
	{
		throw new KooappsServersException("Cannot sort request");
	}

	$params = '';
	foreach ($request as $k => $v)
	{
		if ($k != 'hash')
		{
			$params .= $v;
		}
	}
	
	return md5(md5($key).$params);
}

function getOutputString($values = array())
{
	$output = '';
	foreach ($values as $k => $v)
	{
		$output .= ($k."=".$v.";;;");
	}

	return $output;
}

function getMultiOutputString($values = array())
{
	$output = '';
	foreach ($values as $x)
	{
		$output .= (getOutputString($x)."\n");
	}

	return $output;
}