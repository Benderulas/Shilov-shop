<?php

	require_once("classes/FiltersUpdater.php");

	$categories['male'] = new FiltersUpdater();
	$categories['female'] = new FiltersUpdater();

	$categories['male']->filters->sexID = 1;
	$categories['female']->filters->sexID = 2;

	$categories['male'] = $categories['male']->GetCategories($mysqli);
	$categories['female'] = $categories['female']->GetCategories($mysqli);


?>