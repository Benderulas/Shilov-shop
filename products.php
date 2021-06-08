
    
<?php
    $products_on_page = 8;
    $p_page = (isset($_GET['p_page']) ? $_GET['p_page'] : 1);
    if ($p_page < 1) $p_page = 1;
    $product_name_search = (isset($_GET['name']) ? $_GET['name'] : '');

    require("bd.php");

    $res = $mysqli->query("SELECT COUNT(*) as count FROM products WHERE title LIKE '%$product_name_search%'");
    $products_count = $res->fetch_assoc();
    

    if (intdiv($products_count['count'], $products_on_page) == $products_count['count'] / $products_on_page)
    {
        $p_page_max = intdiv($products_count['count'], $products_on_page);
    }
    else
    {
        $p_page_max = intdiv($products_count['count'], $products_on_page) + 1;
    }

    $res = $mysqli->query("SELECT products.id, products.title, products.price, "
            . "categories.title AS category_name FROM products "
            . "INNER JOIN categories ON products.category_id=categories.id "
            . "WHERE products.title LIKE  '%$product_name_search%' "
            . "ORDER BY products.id "
            . "LIMIT $products_on_page "
            . "OFFSET " . ($p_page - 1) * $products_on_page);

    

    if (!$res) 
    {
        echo("Либо пусто, либо ошибка запроса");
    }
?>




