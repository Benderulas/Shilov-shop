<?php

require_once("MultiCategory.php");

class Sex extends MultiCategory
{

	public const tableName = 'sex';
	const nameInOtherTable = 'sexID';
	const otherTableName = 'products';

}


?>