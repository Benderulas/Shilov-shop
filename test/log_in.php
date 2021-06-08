<?php

$login = $_POST['login'];
$pass = $_POST['password'];


$res = $mysqli->query("SELECT login, password "
            . "FROM users "
            . "WHERE login = '" . $login . "'");

if ($res)
{
	$res = $res->fetch_assoc();
	if ($pass == $res['password']) 
	{
		$_SESSION['is_auth'] = true;
		$_SESSION['login'] = $login;

		$res = $mysqli->query("SELECT id, login, first_name, second_name, email "
	            . "FROM users "
	            . "WHERE login = '" . $_SESSION['login'] . "'");
		if($res) 
		{
			$user = $res->fetch_assoc();
			$_POST['type'] = '';
			header("Location: http://test/");
		}
		else echo("Identifier ERROR");
	}
	else 
	{
		echo("login or password is wrong<br>");
	}
}
else echo("can't find user with the login");
?>