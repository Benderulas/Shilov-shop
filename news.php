<?php

$res = $mysqli->query("SELECT COUNT(*) as count FROM news");
if ($res) $newsCount = intval($res->fetch_assoc()['count']);
else echo("Ошибка запроса количества новостей");


$res = $mysqli->query("SELECT title, text, immage FROM news ");

if (!$res) 
{
    echo("Ошибка запроса новостей");
}




?>