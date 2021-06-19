<?php

require_once ("classes/User.php");

$json = file_get_contents('php://input');
$data = json_decode($json);

$userToEdit = new User();
$userToEdit->SetByJSON($data);

if ($user->id == $userToEdit->id || $user->rights->level == 10)
{
	if ($error = $userToEdit->Edit($mysqli))
	{
		$response['status'] = false;
		$response['error'] = $error;
	}
	else 
	{
		$response['status'] = true;
	}
}
else
{
	$response['status'] = false;
	$response['error'] = "You haven't permissions to do that userLevel = " . $user->rights->level;
}


echo(json_encode($response));

?>