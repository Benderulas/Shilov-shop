<?php
$host='shilov-shop'; // имя хоста (уточняется у провайдера)
$database='web store'; // имя базы данных, которую вы должны создать
$user='root'; // заданное вами имя пользователя, либо определенное провайдером
$pswd='root'; // заданный вами пароль
 
$mysqli = new mysqli($host, $user, $pswd, $database) or die("Не могу соединиться с MySQL.");