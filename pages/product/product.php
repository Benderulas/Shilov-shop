<?php
require_once ("classes/ProductForView.php");


$productForView = new ProductForView();
$productForView->SetById($_GET['id'], $mysqli);


?>
