<?php

require_once("MultiCategory.php");

class Rights extends MultiCategory
{

	public const tableName = 'rights';

	public $level;


	public function Set($_multiCategory)
	{
		if (isset($_multiCategory['id'])) $this->id = $_multiCategory['id'];
		$this->title = $_multiCategory['title'];
		$this->level = $_multiCategory['level'];
	}

	public function Insert()
	{
		require("bd.php");

		if ($this->Exist() == false)
		{
			$res = $mysqli->query("INSERT INTO " . static::tableName . " (title, level) "
				. "VALUES ('$this->title', $this->level)");
			return $res;
		}
		else return false;
	}

	public function Edit()
	{
		require("bd.php");

		$request = "UPDATE " . static::tableName . " SET "
				 . "title = '$this->title', "
				 . "level = $this->level "
				 . "WHERE id = $this->id";
		$res = $mysqli->query($request);
		return $res;
	}

}


?>