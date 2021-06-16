<?php

require_once("classes/User.php");

$json = file_get_contents('php://input');

$data = json_decode($json);

$user = new User();
$user->SetByLogin($data->login, $mysqli);


if ($user->id)
{
	if ($user->password == $data->password) 
	{
		$_SESSION['is_auth'] = true;
		$_SESSION['login'] = $user->login;
		//header("Location: http://shilov-shop/");

		$response['status'] = true;
		$response['data'] = $user;
	}
	else 
	{
		$response['status'] = false;
		$response['message'] = "password is wrong";
	}
}
else 
{
	$response['status'] = false;
	$response['message'] = "login is wrong";
}

echo(json_encode($response));
?>