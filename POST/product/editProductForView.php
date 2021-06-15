<?php

	require_once("classes/ProductForView.php");


	if ($user->rights->level == 10)
	{
		$json = file_get_contents('php://input');
   		$data = json_decode($json);

		$newProductForView = new ProductForView();
		$newProductForView->SetByJSON($data);

		$newProductForView->Edit($mysqli);

		$response['status'] = true;
		$response['message'] = "Изменено";
	}
	else 
	{
		$response['status'] = false;
		$response['message'] = "You don't have permissions to do that.";
	}

	echo(json_encode($response));

?>