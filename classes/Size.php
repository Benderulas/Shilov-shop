<?php

require_once("MultiCategory.php");

class Size extends MultiCategory
{
	public $number;

	public const tableName = 'sizes';
	const nameInOtherTable = 'sizeID';
	const otherTableName = 'products_to_color_and_size';


	public function Set($_multiCategory)
	{
		if (isset($_multiCategory['id'])) $this->id = $_multiCategory['id'];
		$this->title = $_multiCategory['title'];
		$this->number = $_multiCategory['number'];
	}

	public function Insert($_mysqli)
	{

		if ($this->Exist($_mysqli) == false)
		{
			$res = $_mysqli->query("INSERT INTO " . static::tableName . " (title, number) "
				. "VALUES ('$this->title', $this->number)");
			return $res;
		}
		else return false;
	}

	public function Edit($_mysqli)
	{

		$request = "UPDATE " . static::tableName . " SET "
				 . "title = '$this->title', "
				 . "number = $this->number "
				 . "WHERE id = $this->id";
		$res = $_mysqli->query($request);
		return $res;
	}

}


?>