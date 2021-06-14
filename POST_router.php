<?php

header('Content-Type: application/json; charset=utf-8');



$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = substr($path, 1);

require($path);

die();

?>