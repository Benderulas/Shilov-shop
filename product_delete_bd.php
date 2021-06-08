<?php

require("bd.php");

$id = $_POST['id'];

if (!$mysqli->query("DELETE "
        . "from products "
        . "WHERE id = $id")) {
    echo ('Не удалось удалить товар');
} else {
    echo('Ваш товар успешно удалён!<br>');
}
?>
<br>
<a href="index.php?page=products">Вернуться</a>

