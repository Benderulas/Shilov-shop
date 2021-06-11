<?php 

	$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

	$cuttedPath = explode('/', $path);

	$lastCatalog = end($cuttedPath);

	$filePath = "pages" . $path;

	if ($lastCatalog)
	{
		$filePath = $filePath . "/$file.html";
	}
	else $filePath = $filepath . "/main/main.html";

	require($filePath);