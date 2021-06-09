<?php

$path = 'images/' . $url[1];

header("Content-Type: image/jpg");
echo file_get_contents($path);

die();
?>