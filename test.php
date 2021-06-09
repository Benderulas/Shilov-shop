<?php

require ("classes/Rights.php");

$test = new Rights();
$test->title = '222';
$test->id = 3;
$test->level = 4;

var_dump($test->Insert());
$test->title = '333';
var_dump($test->Edit());
var_dump(Rights::Delete($test->id));
var_dump(Rights::GetAllFromDB());

?>