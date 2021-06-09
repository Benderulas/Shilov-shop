<?php

class Category
{
	public $id,
		$title;


	public function SetByPOST($_category)
	{
		if (isset($_category['id'])) $this->id = $_category['id'];
		$this->title = $_category['title]'];
	}

	public function SetFromDB($_category)
	{
		$this->id = $_category['id'];
		$this->title = $_category['title'];
	}

	public function DoesCategoryExist()
	{
		require("bd.php");
		if ($res = $mysqli->query("SELECT COUNT(*) as count FROM categories WHERE title = '$this->title'"))
		{
			$res = $res->fetch_assoc();
			if ($res['count']) return true;
			else return false;
		}
		else 
		{
			echo ("DoesCategoryExist request error");
			return false;
		}
	}

	public function Insert()
	{
		require("bd.php");

		if ($this->DoesCategoryExist() == false)
		{
			$res = $mysqli->query("INSERT INTO categories (title) "
				. "VALUES ('$this->title')");
			return $res;
		}
		else return false;
	}

	public function Edit()
	{
		require("bd.php");

		$request = "UPDATE categories SET "
				 . "title = '$this->title' "
				 . "WHERE id = $this->id";
		$res = $mysqli->query($request);
		return $res;
	}

	public static function Delete($_id)
	{
		require("bd.php");
		$res = $mysqli->query("DELETE FROM categories WHERE id = $_id");

		return $res;
	}

	public static function GetAllFromDB()
	{
		require("bd.php");
		$request = "SELECT * FROM categories ORDER BY id";
		$res = $mysqli->query($request);

		if ($res == false)
		{
			return false;
		}

		$categoriesCount = $res->num_rows;

		for ($i = 0; $i < $categoriesCount; $i++)
		{
			$res->data_seek($i);
			$categories[$i] = new Category();
			$categories[$i]->SetFromDB($res->fetch_assoc());
		}
		return $categories;
	}
}


?>