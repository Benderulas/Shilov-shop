<?php

class Rights
{
	public $id,
		$title,
		$level = 0;


	public function SetByPOST($_rights)
	{
		if (isset($_rights['id'])) $this->id = $_rights['id'];
		$this->title = $_rights['title]'];
		$this->level = $_rights['level]'];
	}

	public function SetFromDB($_rights)
	{
		$this->id = $_rights['id'];
		$this->title = $_rights['title'];
		$this->level = $_rights['level'];
	}

	public function DoesRigthsExist()
	{
		require("bd.php");
		if ($res = $mysqli->query("SELECT COUNT(*) as count FROM rights WHERE title = '$this->title'"))
		{
			$res = $res->fetch_assoc();
			if ($res['count']) return true;
			else return false;
		}
		else 
		{
			echo ("DoesRigthsExist request error");
			return false;
		}
	}

	public function Insert()
	{
		require("bd.php");

		if ($this->DoesRigthsExist() == false)
		{
			$res = $mysqli->query("INSERT INTO rights (title, level) "
				. "VALUES ('$this->title', $this->level)");
			return $res;
		}
		else return false;
	}

	public function Edit()
	{
		require("bd.php");

		$request = "UPDATE rights SET "
				 . "title = '$this->title', "
				 . "level = $this->level "
				 . "WHERE id = $this->id";
		$res = $mysqli->query($request);
		return $res;
	}

	public static function Delete($_id)
	{
		require("bd.php");
		$res = $mysqli->query("DELETE FROM rights WHERE id = $_id");

		return $res;
	}

	public static function GetAllFromDB()
	{
		require("bd.php");
		$request = "SELECT * FROM rights ORDER BY id";
		$res = $mysqli->query($request);

		if ($res == false)
		{
			return false;
		}

		$rightsCount = $res->num_rows;

		for ($i = 0; $i < $rightsCount; $i++)
		{
			$res->data_seek($i);
			$rigths[$i] = new Rights();
			$rigths[$i]->SetFromDB($res->fetch_assoc());
		}
		return $rigths;
	}
}


?>