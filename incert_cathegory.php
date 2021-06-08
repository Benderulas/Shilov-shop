<?php

require("bd.php");

$category_title = $_POST['category_title'];

if (!$mysqli->query("INSERT INTO categories (title) VALUES ('$category_title')")) {
    echo ('<p class="text-center text-primary"> Не удалось добавить категорию </p>');
} else {
    echo('<p class="text-center text-primary">Новая категори добавлена!<br> ' . $category_title . '</p>');
}

?>

