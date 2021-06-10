<?php
    require("classes/ProductSearcher.php");

    $productSearcher = new ProductSearcher();
    $productSearcher->SetFiltersByGET();

    $products = $productSearcher->SearchByFilters();
?>