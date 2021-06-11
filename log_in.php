<?php

require("classes/UserSearcher.php");
$userSearcher = new UserSearcher();
$userSearcher->login = $_POST['login'];

$user = $userSearcher->FindUserByLogin();

if ($user)
{
	if ($user->password == $_POST['password']) 
	{
		$_SESSION['is_auth'] = true;
		$_SESSION['login'] = $user->login;
		header("Location: http://shilov-shop/");
	}
	else 
	{
		echo("password is wrong<br>");
	}
}
else echo("can't find user with the login");
?>