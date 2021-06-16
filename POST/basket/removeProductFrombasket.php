<?php
	
	$json = file_get_contents('php://input');
    $number = json_decode($json);


    array_splice($_SESSION['basket'], $number, 1);

    $response['status'] = true;
    $response['productsInBasket'] = Count($_SESSION['basket']);

    echo (json_encode($response));


?>