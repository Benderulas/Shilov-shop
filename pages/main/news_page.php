<?php

require("classes/News.php");

$news = News::GetAllFromDB($mysqli);

$newsCount = count($news);

?>