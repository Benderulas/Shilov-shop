<?php

	$json = file_get_contents('php://input');
    $data = json_decode($json);

    if (isset($_SESSION['basket'][0])) 
	{
		$flag == false;
		for($i = 0; $i < Count($_SESSION['basket']); $i++)
		{
			if ($_SESSION['basket'][$i]->productID == $data->productID && 
				$_SESSION['basket'][$i]->colorID == $data->colorID &&
				$_SESSION['basket'][$i]->sizeID == $data->sizeID)
			{
				$flag = true;
				$_SESSION['basket'][$i]->amount += $data->amount;

				break;
			}
		}
		if ($flag == false) 
		{
			array_push($_SESSION['basket'], $data);
		}
	}
	else $_SESSION['basket'][0] = $data;


    $response['productsInBasket'] = Count($_SESSION['basket']);

    echo (json_encode($response));

?>