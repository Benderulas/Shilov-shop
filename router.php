<?php 

	$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

	$cuttedPath = explode('/', $path);

	$lastCatalog = end($cuttedPath);

	$filePath = "pages" . $path;

	if ($lastCatalog)
	{
		$filePath = $filePath . "/$lastCatalog.html";
	}
	else $filePath = $filePath . "/main/main.html";

	require($filePath);