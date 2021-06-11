<?php

require_once("MultiCategory.php");

class Size extends MultiCategory
{
	public $number;

	public const tableName = 'sizes';


	public function Set($_multiCategory)
	{
		if (isset($_multiCategory['id'])) $this->id = $_multiCategory['id'];
		$this->title = $_multiCategory['title'];
		$this->number = $_multiCategory['number'];
	}

	public function Insert()
	{
		require("DataBase.php");

		if ($this->Exist() == false)
		{
			$res = $mysqli->query("INSERT INTO " . static::tableName . " (title, number) "
				. "VALUES ('$this->title', $this->number)");
			return $res;
		}
		else return false;
	}

	public function Edit()
	{
		require("DataBase.php");

		$request = "UPDATE " . static::tableName . " SET "
				 . "title = '$this->title', "
				 . "number = $this->number "
				 . "WHERE id = $this->id";
		$res = $mysqli->query($request);
		return $res;
	}

}


?>