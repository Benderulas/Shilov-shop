<?php

session_start();
require_once("DataBase.php");
require_once("classes/User.php");

if(isset($_SESSION['is_auth']) == false) $_SESSION['is_auth'] = false;

if($_SESSION['is_auth']) 
{
	
	$user = new User();
	$user->SetByLogin($_SESSION['login']);

	if ($user->id == NULL) echo("Identifier ERROR, can't find user in DB");
}
else
{
	$user = false;
}

?>