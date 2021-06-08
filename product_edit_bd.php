<?php



require("bd.php");

$id = $_POST['id'];
$name = $_POST['name'];
$price_min = $_POST['price_min'];
$price_max = $_POST['price_max'];
$category_id = $_POST['category_id'];

if (!$mysqli->query("UPDATE products "
        . "SET name = '$name', price_min = $price_min, price_max = $price_max, category_id = $category_id "
        . "WHERE id = $id")) {
    echo ('Не удалось изменить товар');
} else {
    echo('Ваш товар успешно изменён!<br>');
}

?>
<br>
<a href="index.php?page=product_edit&id=<?= $id ?>">Вернуться</a>