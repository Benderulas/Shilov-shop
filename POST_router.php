<?php

header('Content-Type: application/json; charset=utf-8');



$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (isset($_POST['type'])) $path = $path . '/' . $_POST['type'];

require( "POST" . $path . ".php");

?>