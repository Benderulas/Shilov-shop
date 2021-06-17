<?php
    require("classes/ProductForViewSearcher.php");


    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $productSearcher = new ProductForViewSearcher();
    $productSearcher->SetFiltersByJSON($data);

    $productsForView = $productSearcher->SearchByFilters($mysqli);
    //$productsForView['amount'] = Count($productsForView);
    $productsForView['totalAmount'] = $productSearcher->GetPagesAmountByFilters($mysqli);

    
    echo(json_encode($productsForView));
?>