<?php

require_once ("classes/User.php");

$newUser = new User();
$newUser->SetByPOST();


if ($newUser->ExistByLogin($mysqli)) 
{
	$exception = "login is used already, please, select new one.";
}
else if ($newUser->ExistByEmail()$mysqli) 
{
	$exception = "email is used already, please, select new one.";
}
else 
{
	if ($newUser->Insert($mysqli))
	{
		$exception = "Done!";
	}
	else
	{
		$exception = "Insert User error";
	}	
}
?>