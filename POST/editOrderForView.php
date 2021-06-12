<?php

	require_once("classes/OrderForView.php")

	

	$orderForView = new OrderForView();

	if ($user->id == $_POST['order_userID'])
	{
		$orderForView->SetByPOST();
		$exception = $orderForView->Edit();
	}
	else $exception = "user ids doesn't match";	


?>