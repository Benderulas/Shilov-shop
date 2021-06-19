<?php 

require_once("classes/Category.php");
require_once("classes/Sex.php");
require_once("classes/Color.php");
require_once("classes/Size.php");
require_once("classes/Company.php");




$json = file_get_contents('php://input');
$data = json_decode($json);




$filters['categories'] = Category::GetAllFromDB($mysqli);
$filters['colors'] = Color::GetAllFromDB($mysqli);
$filters['sizes'] = Size::GetAllFromDB($mysqli);
$filters['companies'] = Company::GetAllFromDB($mysqli);
$filters['sex'] = Sex::GetAllFromDB($mysqli);

$filters = json_encode($filters);

echo ($filters);

?>