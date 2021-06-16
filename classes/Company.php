<?php

require_once("MultiCategory.php");

class Company extends MultiCategory
{

	public const tableName = 'Companies';
	const nameInOtherTable = 'companyID';
	const otherTableName = 'products';

}


?>