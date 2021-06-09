<?php

session_start();
require('bd.php');

if(isset($_SESSION['is_auth']) == false) $_SESSION['is_auth'] = false;

if($_SESSION['is_auth']) 
{
	require("classes/UserSearcher.php");
	$userSearcher = new UserSearcher();
	$userSearcher->login = $_SESSION['login'];


	$user = $userSearcher->FindUserByLogin();
	if (!$user) echo("Identifier ERROR, can't find user in DB");
}
else
{
	$user = false;
}

?>