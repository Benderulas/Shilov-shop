<?php

require("bd.php");

$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$category_id = $_POST['category_id'];

if (!$mysqli->query("INSERT INTO products(name, price, category_id) "
        . "VALUES ('$product_name', '$product_price', '$category_id')")) 
{
    echo ('<p class="text-center text-primary"> Не удалось добавить товар </p>');
}
else 
{
    echo('<p class="text-center text-primary">Ваш товар успешно добавлен!<br>'.$product_name.'<br>'.$product_price.'</p>');
}

?>

