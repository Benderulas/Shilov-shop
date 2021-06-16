<?php
require("DataBase.php");

require("file_router.php");

require('authorization.php');



if ($_SERVER["REQUEST_METHOD"] == "POST")  require('POST_router.php');

else
{
	error_reporting(-1);
	ini_set('display_errors',1);
	header('Content-Type: text/html; charset=utf-8');





	require("page_top/top.html");

	require("router.php");

	require("page_footer/footer.html");

}






?>