<?php

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


require( "POST" . $path . '/' . $_POST['type'] . ".php");

?>