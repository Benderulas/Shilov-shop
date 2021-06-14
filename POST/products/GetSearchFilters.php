<?php 

require_once("classes/FiltersUpdater.php");




$json = file_get_contents('php://input');
$data = json_decode($json);

$filtersUpdater = new FiltersUpdater();
$filtersUpdater->SetByJSON($data);

$filters = $filtersUpdater->GetFilters();

$filters = json_encode($filters);

echo ($filters);

?>