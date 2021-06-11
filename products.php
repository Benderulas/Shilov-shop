<?php
    require("classes/ProductForViewSearcher.php");

    $productSearcher = new ProductForViewSearcher();
    $productSearcher->SetFiltersByGET();

    $productsForView = $productSearcher->SearchByFilters();
?>