<?php

$path = 'CSS/' . $url[1];

header("Content-Type: text/css");
echo file_get_contents($path);

die();
?>