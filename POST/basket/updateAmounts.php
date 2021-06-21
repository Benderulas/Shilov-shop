<?php

	$json = file_get_contents('php://input');
    $data = json_decode($json);

    for ($i = 0; $i < Count($data); $i++)
    {
        $_SESSION['basket'][$i]->amount = $data[$i];
    }


    if (1)
    {
    	$response['status'] = true;
    }


    echo(json_encode($response));

?>