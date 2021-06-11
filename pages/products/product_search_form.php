<?php 
    require("DataBase.php");
    $numberOfCategories = 5;

    $categoriesTitles[0] = 'categories';
    $categoriesTitles[1] = 'colors';
    $categoriesTitles[2] = 'sizes';
    $categoriesTitles[3] = 'companies';
    $categoriesTitles[4] = 'sex';

    $categoriesSearchTitles[0] = 'categoryID';
    $categoriesSearchTitles[1] = 'colorID';
    $categoriesSearchTitles[2] = 'sizeID';
    $categoriesSearchTitles[3] = 'companyID';
    $categoriesSearchTitles[4] = 'sexID';

    $categoriesCount;

    $categories;




    for ($i = 0; $i < $numberOfCategories; $i++)
    {
        $res = $mysqli->query("SELECT * FROM $categoriesTitles[$i] ORDER BY id");
        if ($res)
        {
            $categoriesCount[$i] = $res->num_rows;
            for ($j = 0; $j < $categoriesCount[$i]; $j++)
            {
                $res->data_seek($j);
                $categories[$i][$j] = $res->fetch_assoc();
            }
        }
        else 
        {
            $categoriesCount[$i] = 0;
            $categories[$i] = false;
        }
    }
?>