<?php

require_once ("classes/UserSearcher.php");

$user = new User();
$user->SetByPOST($_POST);

$userSearcher = new UserSearcher();
$userSearcher->login = $user->login;
$userSearcher->email = $user->email;


if ($userSearcher->FindUserByLogin()->id) 
{
	echo("login is used already, please, select new one.");
}
if ($userSearcher->FindUserByEmail()->id) 
{
	echo("email is used already, please, select new one.");
}
else 
{
	if ($user->Insert())
	{
		$_SESSION['is_auth'] = true;
		$_SESSION['login'] = $user->login;
		header("Location: http://shilov-shop/");
	}
	else
	{
		echo("error");
	}

	
}
?>