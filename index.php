<?php

$url = $_SERVER['REQUEST_URI'];
$url = parse_url($url, PHP_URL_PATH);
$url = substr($url, 1);
$url = explode('/', $url);

require("file_router.php");



error_reporting(-1);
ini_set('display_errors',1);
header('Content-Type: text/html; charset=utf-8');

require('authorization.php');
if (isset($_POST['type']))  require('POST_router.php');




require("top.html");

require("router.php");

require("footer.html");

?>