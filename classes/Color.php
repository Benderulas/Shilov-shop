<?php

require_once("MultiCategory.php");

class Color extends MultiCategory
{

	public const tableName = 'Colors';
	const nameInOtherTable = 'colorID';
	const otherTableName = 'products_to_color_and_size';

}


?>