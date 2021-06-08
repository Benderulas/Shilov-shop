<?php


error_reporting(-1);
ini_set('display_errors',1);
header('Content-Type: text/html; charset=utf-8');
$page = (isset($_GET['page']) ? $_GET['page'] : 'main');
require('authorization.php');
?>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <meta charset="UTF-8">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    <script src="jquery-3.5.1.js"></script>
    
    <title>Сайт из клешней</title>
</head>
<body class="bg-light">
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
            <div class="navbar-header">
                <a href="index.php?page=main" class="navbar-brand">
                    <img src="/картинки/logo.jpg" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
                    Красти крабс
                </a>
            </div>

            <div>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link<?php if ($page == "main") echo(" active") ?>" href="index.php?page=main">Главная</a></li>
                    <li class="nav-item"><a class="nav-link<?php if ($page == "about") echo(" active") ?>" href="index.php?page=about">О нас</a></li>
                    <li class="nav-item"><a class="nav-link<?php if ($page == "products") echo(" active") ?>" href="index.php?page=products">Наши товары</a></li>
                    <li class="nav-item"><a class="nav-link<?php if ($page == "test") echo(" active") ?>" href="index.php?page=test">test</a></li>
                    <?php 
                        if (!$user) require('log_in_menu.html');
                        else require("log_out_menu.html");
                    ?>
                    
                </ul>
            </div> 
        </nav>
              
        <div class="bg-light">
            <?php 
            if (!isset($_POST['type'])) require($page .'.html');
            else
            {
                if ($_POST['type'] == 'log_in') require ('log_in.php');
                if ($_POST['type'] == 'incert_product') require('incert_product_bd.php');
                if ($_POST['type'] == 'incert_category') require('incert_category_bd.php');
                if ($_POST['type'] == 'product_edit') require('product_edit_bd.php');
                if ($_POST['type'] == 'product_delete') require('product_delete_bd.php');
            }
            ?>
        </div>
        <?php

        if ($user) echo("Hello, " . $user['first_name'] . " " . $user['second_name'] . "<br>");

        ?>

    </div>

    <footer class="bg-secondary">
        <div class="text-center"> Сайт сделан сегодня и все права принадлежат его создателю :) </div>
    </footer>
</body>



</html>