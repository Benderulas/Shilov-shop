<?php

	$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$path = substr($path, 1);


	$cuttedPath = explode('/', $path);

	
	$file = end($cuttedPath);

	$fileExtention = end(explode('.', $file));

	if ($fileExtention == 'jpeg') 
	{
		header("Content-Type: image/jpeg");
		echo file_get_contents($path);
		die();
	}
	if ($fileExtention == 'jpg') 
	{
		header("Content-Type: image/jpg");
		echo file_get_contents($path);
		die();
	}
	if ($fileExtention == 'JPG') 
	{
		header("Content-Type: image/jpg");
		echo file_get_contents($path);
		die();
	}

	if ($fileExtention == 'png') 
	{
		header("Content-Type: image/png");
		echo file_get_contents($path);
		die();
	}

	if ($fileExtention == 'css') 
	{
		header("Content-Type: text/css");
		echo file_get_contents($path);
		die();
	}

	if ($fileExtention == 'js') 
	{
		header("Content-Type: text/javascript");
		echo file_get_contents($path);
		die();
	}

	if ($fileExtention == 'mjs') 
	{
		header("Content-Type: text/javascript");
		echo file_get_contents($path);
		die();
	}

?>