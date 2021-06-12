<?php

require_once ("classes/User.php");

$userToDelete = new User();
$userToDelete->SetByPOST();

if ($user->id == $userToDelete->id || $user->rigths->level == 10)
{
	$exception = $userToDelete->Delete();
}
else $exception = "You don't have permissions to do that";

?>