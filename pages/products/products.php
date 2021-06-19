<?php

	require_once("classes/Category.php");

	if(isset($_GET['sexID']));
	{
		if ($_GET['sexID'] == 1) echo ("Мужское");
		else if ($_GET['sexID'] == 2) echo ("Женское");
		else echo ("Унисекс");
	}
	

	

	if (isset($_GET['categoryID']))
	{
		$category = new Category();
		$category->SetById($_GET['categoryID'], $mysqli);

		echo("/");
		echo($category->title);
	}
?>