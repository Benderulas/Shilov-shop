<?php

require("classes/News.php");

$news = News::GetAllFromDB();

$newsCount = count($news);

?>