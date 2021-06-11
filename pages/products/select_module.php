<?php 
	for ($i = 0; $i < $numberOfCategories; $i++)
	{
		echo("<div class='form-group d-flex justify-content-center'>");
		echo("<select name='$categoriesSearchTitles[$i]' required>");
		echo("<option value=0></option>");

		for ($j = 0; $j < $categoriesCount[$i]; $j++)
        {
            echo("<option ");
            $a = $categoriesSearchTitles[$i];
            if ($categories[$i][$j]['id'] == $productSearcher->$a) echo ("selected='selected' ");
            echo("value=" . $categories[$i][$j]['id']. ">" . $categories[$i][$j]['title'] . "</option>");
        }

		echo("</select>");
		echo("</div>");
	}
?>