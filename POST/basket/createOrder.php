<?php
	
	require_once("classes/OrderForView.php");
    require_once("classes/Order.php");
    require_once("classes/ProductInOrder.php");

	$json = file_get_contents('php://input');
    $data = json_decode($json);

    $newOrderForView = new OrderForView();
    $newOrder = new Order();

    $newOrder->user->id = $user->id;
    $newOrder->firstName = $data->firstName;
    $newOrder->secondName = $data->secondName;
    $newOrder->phoneNumber = $data->phone;
    $newOrder->deliveryCompany->id = $data->deliveryCompanyID;

    if ($data->deliveryCompanyID != 1)
    {
        $newOrder->country = $data->country;
        $newOrder->city = $data->city;
        $newOrder->address = $data->address;
        $newOrder->postIndex = $data->index;
    }

    $newOrderForView->order = $newOrder;

    for ($i = 0; $i < Count($_SESSION['basket']); $i++)
    {
        $newProductInOrder = new ProductInOrder();
        $newProductInOrder->productToColorAndSize->id = ProductToColorAndSize::GetIdByIds($_SESSION['basket'][$i], $mysqli);
        $newProductInOrder->amount = $_SESSION['basket'][$i]->amount;
        $newOrderForView->productsInOrder[$i] = $newProductInOrder;
    }


    $newOrderForView->Insert($mysqli);
    if ($mysqli->error)
    {
    	$response['status'] = false;
        $response['error'] = $mysqli->error;
    }

    else 
    {
    	$response['status'] = true;

        unset($_SESSION['basket']);
    }


    echo(json_encode($response));

?>