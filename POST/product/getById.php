<?php

require_once("classes/ProductForView.php");


	$json = file_get_contents('php://input');
    $data = json_decode($json);


    $productForView = new ProductForView();

    $productForView->SetById($data, $mysqli);

    echo(json_encode($productForView));




?>