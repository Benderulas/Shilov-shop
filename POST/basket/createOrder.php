<?php
	
	require_once("classes/OrderForView.php");

	$json = file_get_contents('php://input');
    $data = json_decode($json);

    $newOrderForView = new OrderForView();

    $newOrderForView->SetByJSON($data);

    if ($newOrderForView->Insert($mysqli))
    {
    	$response['status'] = true;
    }

    else 
    {
    	$response['status'] = false;
    }


    echo(json_encode($response));

?>