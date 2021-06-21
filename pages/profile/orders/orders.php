<?php
	require_once("classes/Order.php");

	if (isset($_GET['userID']))
	{
		if ($user->id == $_GET['userID'] || $user->rights->level == 10)
		{
			$orders = Order::GetAllByUserId($_GET['userID'], $mysqli);
		}
		else echo("you have no permission to do that");
		
	}
	else if ($user)
	{
		$orders = Order::GetAllByUserId($user->id, $mysqli);
	}
	else echo ("login please");


?>