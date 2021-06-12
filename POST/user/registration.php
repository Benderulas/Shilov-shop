<?php

require_once ("classes/User.php");

$newUser = new User();
$newUser->SetByPOST();


if ($newUser->ExistByLogin()) 
{
	$exception = "login is used already, please, select new one.";
}
else if ($newUser->ExistByEmail()) 
{
	$exception = "email is used already, please, select new one.";
}
else 
{
	if ($newUser->Insert())
	{
		$_SESSION['is_auth'] = true;
		$_SESSION['login'] = $newUser->login;
		header("Location: http://shilov-shop/");
	}
	else
	{
		$exception = "Insert User error";
	}	
}
?>