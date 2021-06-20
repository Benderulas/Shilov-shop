<?php

	require_once("classes/ProductForView.php");


	$json = file_get_contents('php://input');
    $data = json_decode($json);

    

    if ($user && $user->rights->level == 10)
    {
    	$newProductForView = new ProductForView();

	    $newProductForView->SetByJSON($data);

	    $newProductForView->Insert($mysqli);

	    $response['status'] = true;
    }
    else 
	{
		$response['message'] = "You don't have permissions to do that";
		$response['status'] = false;
	}

	echo(json_encode($response));

?>