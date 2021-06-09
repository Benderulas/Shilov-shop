<?php

class Sex
{
	public $id,
		$title;


	public function SetByPOST($_sex)
	{
		if (isset($_sex['id'])) $this->id = $_sex['id'];
		$this->title = $_sex['title]'];
	}

	public function SetFromDB($_sex)
	{
		$this->id = $_sex['id'];
		$this->title = $_sex['title'];
	}

	public function DoesSexExist()
	{
		require("bd.php");
		if ($res = $mysqli->query("SELECT COUNT(*) as count FROM sex WHERE title = '$this->title'"))
		{
			$res = $res->fetch_assoc();
			if ($res['count']) return true;
			else return false;
		}
		else 
		{
			echo ("DoesSexExist request error");
			return false;
		}
	}

	public function Insert()
	{
		require("bd.php");

		if ($this->DoesSexExist() == false)
		{
			$res = $mysqli->query("INSERT INTO sex (title) "
				. "VALUES ('$this->title')");
			return $res;
		}
		else return false;
	}

	public function Edit()
	{
		require("bd.php");

		$request = "UPDATE sex SET "
				 . "title = '$this->title' "
				 . "WHERE id = $this->id";
		$res = $mysqli->query($request);
		return $res;
	}

	public static function Delete($_id)
	{
		require("bd.php");
		$res = $mysqli->query("DELETE FROM sex WHERE id = $_id");

		return $res;
	}

	public static function GetAllFromDB()
	{
		require("bd.php");
		$request = "SELECT * FROM sex ORDER BY id";
		$res = $mysqli->query($request);

		if ($res == false)
		{
			return false;
		}

		$sexCount = $res->num_rows;

		for ($i = 0; $i < $sexCount; $i++)
		{
			$res->data_seek($i);
			$sex[$i] = new Sex();
			$sex[$i]->SetFromDB($res->fetch_assoc());
		}
		return $sex;
	}
}


?>