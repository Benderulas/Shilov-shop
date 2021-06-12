<?php

require_once("classes/User.php");

$user = new User();
$user->SetByLogin($_POST['login']);

if ($user->id)
{
	if ($user->password == $_POST['password']) 
	{
		$_SESSION['is_auth'] = true;
		$_SESSION['login'] = $user->login;
		header("Location: http://shilov-shop/");
	}
	else 
	{
		$exception = "password is wrong<br>";
	}
}
else echo("can't find user with the login");
?>