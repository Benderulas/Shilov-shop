<?php
    require("classes/ProductForViewSearcher.php");


    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $productSearcher = new ProductForViewSearcher();
    $productSearcher->SetFiltersByJSON($data);

    $productsForView = $productSearcher->SearchByFilters();
    $productsForView['amount'] = $productSearcher->GetPagesAmountByFilters();

    
    echo(json_encode($productsForView));
?>