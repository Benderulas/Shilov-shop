
<?php 

if ($url[0] == '')
{
	$url[0] = 'main';
}

require($url[0] . '.html');


?>