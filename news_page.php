<?php

require("classes/News.php");

$res = $mysqli->query("SELECT * FROM news");

if ($res) $newsCount = $res->num_rows;
else $newsCount = 0;

$news = false;

for ($i = 0; $i < $newsCount; $i++)
{
    $res->data_seek($i);
    $news[$i] = new News();
    $news[$i]->SetFromDB($res->fetch_assoc());
}

?>