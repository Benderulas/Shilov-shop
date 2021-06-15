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

	public function Insert($_mysqli)
	{

		if ($this->Exist($_mysqli) == false)
		{
			$res = $_mysqli->query("INSERT INTO " . static::tableName . " (title, level) "
				. "VALUES ('$this->title', $this->level)");
			return $res;
		}
		else return false;
	}

	public function Edit($_mysqli)
	{

		$request = "UPDATE " . static::tableName . " SET "
				 . "title = '$this->title', "
				 . "level = $this->level "
				 . "WHERE id = $this->id";
		$res = $_mysqli->query($request);
		return $res;
	}

}


?>