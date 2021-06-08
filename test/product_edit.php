<?php

require ("bd.php");

$id = (isset($_GET['id']) ? $_GET['id'] : 0);

$res_product = $mysqli->query("SELECT * FROM products WHERE id = $id");
$res_categories = $mysqli->query("SELECT * FROM categories ORDER BY id");

if (!$res_categories) {
    $n = 0;
} else {
    $n = $res_categories->num_rows;
}

$res_product->data_seek(0);
$product = $res_product->fetch_assoc();
?>

<?= "ID = {$product['id']} <br>" ?>
<form name = "edit_product" method = "POST" action = "index.php">
    <input type="hidden" name="id" value="<?= $id ?>"> 
    <label>Название товара: 
        <input type = "text" name = "name" value = "<?= htmlspecialchars($product['name']) ?>"></label><br>
    <label>Минимальная цена: 
        <input type = "text" name = "price_min" value = "<?= htmlspecialchars($product['price_min']) ?>"></label><br>
    <label>Максимальная цена: 
        <input type = "text" name = "price_max" value = "<?= htmlspecialchars($product['price_max']) ?>"></label><br>
    <label>Категория:
        <select name="category_id" required>
            <?php
                for ($i = 0; $i < $n; $i++) {
                    $res_categories->data_seek($i);
                    $category = $res_categories->fetch_assoc();
                    if ($category['id'] == $product['category_id']) {
                        echo("<option value={$category['id']} selected>{$category['name']}</option>");
                    }
                    else {
                        echo("<option value={$category['id']}>{$category['name']}</option>");
    }
                }
            ?>
        </select><br>

    <input type = "hidden" name="type" value = "product_edit">
    <input type = "submit" value = "Изменить">
</form>
<form name="delete_product" method = "POST" action = "index.php">
    <input type="hidden" name="id" value="<?= $id ?>">
    <input type="hidden" name="type" value="product_delete">
    <input type="submit" value="Удалить">
</form>

