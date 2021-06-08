<?php
    require("ProductSearcher.php");

    $productSearcher = new ProductSearcher();
    $productSearcher->SetFiltersByGET();

    $products = $productSearcher->SearchProductsInBD();
?>