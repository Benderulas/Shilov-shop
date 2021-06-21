<?php

	require_once("classes/OrderForView.php");

	$orderForView = new OrderForView();

	$orderForView->SetById($_GET['orderID'], $mysqli);

?>