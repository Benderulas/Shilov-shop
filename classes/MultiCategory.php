<?php


class MultiCategory
{
	public $id,
		$title;
	const tableName = '';


	public function Set($_multiCategory)
	{
		if (isset($_multiCategory['id'])) $this->id = $_multiCategory['id'];
		$this->title = $_multiCategory['title'];
	}

	public function SetById($_id)
	{
		require("DataBase.php");
		$request = "SELECT * from " . static::tableName . " WHERE id =  $_id";
		$res = $mysqli->query($request);

		if ($res)
		{
			$this->Set($res->fetch_assoc());
		}
	}

	public function Exist()
	{
		if (isset($this->id)) return true;
		require("DataBase.php");
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
		require("DataBase.php");

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
		require("DataBase.php");

		$request = "UPDATE " . static::tableName . " SET "
				 . "title = '$this->title' "
				 . "WHERE id = $this->id";
		$res = $mysqli->query($request);
		return $res;
	}

	public function Delete()
	{
		require("DataBase.php");
		$res = $mysqli->query("DELETE FROM " . static::tableName . " WHERE id = $tihs->id");

		return $res;
	}

	public static function GetAllFromDB()
	{
		require("DataBase.php");
		$request = "SELECT * FROM " . static::tableName . " ORDER BY id";
		$res = $mysqli->query($request);

		if ($res == false)
		{
			return false;
		}

		$count = $res->num_rows;
		$className = static::class;

		for ($i = 0; $i < $count; $i++)
		{
			$res->data_seek($i);
			
			$myltiCategories[$i] = new $className();
			$myltiCategories[$i]->Set($res->fetch_assoc());
		}
		return $myltiCategories;
	}
}


?>