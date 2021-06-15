<?php

	require_once("classes/ProductForView.php");


	$json = file_get_contents('php://input');
    $data = json_decode($json);

    $newProductForView = new ProductForView();

    $newProductForView->SetByJSON($data);

    $newProductForView->Insert($mysqli);

	$response['message'] = "cathed!";



	echo(json_encode($response));




?>