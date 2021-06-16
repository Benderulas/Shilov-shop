<?php

require_once("MultiCategory.php");

class Category extends MultiCategory
{

	public const tableName = 'Categories';
	const nameInOtherTable = 'categoryID';
	const otherTableName = 'products';

}


?>