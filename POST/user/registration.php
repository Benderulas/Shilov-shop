<?php

require_once ("classes/User.php");

$json = file_get_contents('php://input');

$data = json_decode($json);

$newUser = new User();
$newUser->SetByJSON($data);

if ($newUser->ExistByLogin()) 
{
	$response['status'] = false;
	$response['message'] = "login is used already, please, select new one.";
}
else if ($newUser->ExistByEmail()) 
{
	$response['status'] = false;
	$response['message'] = "email is used already, please, select new one.";
}
else 
{
	if ($newUser->Insert())
	{
		$_SESSION['is_auth'] = true;
		$_SESSION['login'] = $newUser->login;

		$response['status'] = true;
		$response['data'] = $user;
	}
	else
	{
		$response['status'] = false;
		$response['message'] = "Insert User error";
	}	
}

echo(json_encode($response));
?>