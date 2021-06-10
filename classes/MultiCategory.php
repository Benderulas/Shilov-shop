<?php


class MultiCategory
{
	public $id,
		$title;
	const tableName = '';


	public function SetByPOST($_multiCategory)
	{
		if (isset($_multiCategory['id'])) $this->id = $_multiCategory['id'];
		$this->title = $_multiCategory['title]'];
	}

	public function SetFromDB($_multiCategory)
	{
		$this->id = $_multiCategory['id'];
		$this->title = $_multiCategory['title'];
	}

	public function Exist()
	{
		require("bd.php");
		if ($res = $mysqli->query("SELECT COUNT(*) as count FROM " . static::tableName . " WHERE title = '$this->title'"))
		{
			$res = $res->fetch_assoc();
			if ($res['count']) return true;
			else return false;
		}
		else 
		{
			echo (static::tableName . " Exist  request error");
			return false;
		}
	}

	public function Insert()
	{
		require("bd.php");

		if ($this->Exist() == false)
		{
			$res = $mysqli->query("INSERT INTO " . static::tableName . " (title) "
				. "VALUES ('$this->title')");
			return $res;
		}
		else return false;
	}

	public function Edit()
	{
		require("bd.php");

		$request = "UPDATE " . static::tableName . " SET "
				 . "title = '$this->title' "
				 . "WHERE id = $this->id";
		$res = $mysqli->query($request);
		return $res;
	}

	public static function Delete($_id)
	{
		require("bd.php");
		$res = $mysqli->query("DELETE FROM " . static::tableName . " WHERE id = $_id");

		return $res;
	}

	public static function GetAllFromDB()
	{
		require("bd.php");
		$request = "SELECT * FROM " . static::tableName . " ORDER BY id";
		$res = $mysqli->query($request);

		if ($res == false)
		{
			return false;
		}

		$count = $res->num_rows;

		for ($i = 0; $i < $count; $i++)
		{
			$res->data_seek($i);
			$className = self::class;
			$myltiCategories[$i] = new $className();
			$myltiCategories[$i]->SetFromDB($res->fetch_assoc());
		}
		return $myltiCategories;
	}
}


?>