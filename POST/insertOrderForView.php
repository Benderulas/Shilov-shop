<?php

	require_once("classes/OrderForView.php")

	

	$orderForView = new OrderForView();

	if ($user->id == $_POST['order_userID'] || $user->rights->level == 10)
	{
		$orderForView->SetByPOST();
		$exception = $orderForView->Insert();
	}
	else $exception = "You don't have permissions to do that";	


?>