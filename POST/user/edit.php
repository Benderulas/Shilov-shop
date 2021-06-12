<?php

require_once ("classes/User.php");

$userToEdit = new User();
$userToEdit->SetByPOST();

if ($user->id == $userToEdit->id || $user->rigths->level == 10)
{
	$exception = $userToEdit->Edit();
}
else $exception = "You don't have permissions to do that";

?>