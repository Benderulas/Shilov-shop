<?php

	require_once("classes/User.php");
	
	$json = file_get_contents('php://input');
	$data = json_decode($json);

	$user = new User();

	$user->SetByLogin($_SESSION['login']);

	echo(json_encode($user));


?>