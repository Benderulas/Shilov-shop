<?php

session_start();
require('bd.php');

if(isset($_SESSION['is_auth']) == false) $_SESSION['is_auth'] = false;
if($_SESSION['is_auth'])
{
	$res = $mysqli->query("SELECT id, login, first_name, second_name, email, admin "
            . "FROM users "
            . "WHERE login = '" . $_SESSION['login'] . "'");
	if($res)
	{
		$user = $res->fetch_assoc();
	}
	else echo("Identifier ERROR, can't find user in bd");
}
else
{
	$user = false;
}

?>