<?php

class Color
{
	public $id,
		$title;


	public function SetByPOST($_color)
	{
		if (isset($_color['id'])) $this->id = $_color['id'];
		$this->title = $_color['title]'];
	}

	public function SetFromDB($_color)
	{
		$this->id = $_color['id'];
		$this->title = $_color['title'];
	}

	public function DoesColorExist()
	{
		require("bd.php");
		if ($res = $mysqli->query("SELECT COUNT(*) as count FROM colors WHERE title = '$this->title'"))
		{
			$res = $res->fetch_assoc();
			if ($res['count']) return true;
			else return false;
		}
		else 
		{
			echo ("DoesColorExist request error");
			return false;
		}
	}

	public function Insert()
	{
		require("bd.php");

		if ($this->DoesColorExist() == false)
		{
			$res = $mysqli->query("INSERT INTO colors (title) "
				. "VALUES ('$this->title')");
			return $res;
		}
		else return false;
	}

	public function Edit()
	{
		require("bd.php");

		$request = "UPDATE colors SET "
				 . "title = '$this->title' "
				 . "WHERE id = $this->id";
		$res = $mysqli->query($request);
		return $res;
	}

	public static function Delete($_id)
	{
		require("bd.php");
		$res = $mysqli->query("DELETE FROM colors WHERE id = $_id");

		return $res;
	}

	public static function GetAllFromDB()
	{
		require("bd.php");
		$request = "SELECT * FROM colors ORDER BY id";
		$res = $mysqli->query($request);

		if ($res == false)
		{
			return false;
		}

		$colorsCount = $res->num_rows;

		for ($i = 0; $i < $colorsCount; $i++)
		{
			$res->data_seek($i);
			$colors[$i] = new Color();
			$colors[$i]->SetFromDB($res->fetch_assoc());
		}
		return $colors;
	}
}


?>