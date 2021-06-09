<?php

class Size
{
	public $id,
		$title,
		$number;


	public function SetByPOST($_size)
	{
		if (isset($_size['id'])) $this->id = $_size['id'];
		$this->title = $_size['title]'];
		$this->number = $_size['number]'];
	}

	public function SetFromDB($_size)
	{
		$this->id = $_size['id'];
		$this->title = $_size['title'];
		$this->number = $_size['number'];
	}

	public function DoesSizeExist()
	{
		require("bd.php");
		if ($res = $mysqli->query("SELECT COUNT(*) as count FROM sizes WHERE title = '$this->title'"))
		{
			$res = $res->fetch_assoc();
			if ($res['count']) return true;
			else return false;
		}
		else 
		{
			echo ("DoesSizeExist request error");
			return false;
		}
	}

	public function Insert()
	{
		require("bd.php");

		if ($this->DoesSizeExist() == false)
		{
			$res = $mysqli->query("INSERT INTO sizes (title, number) "
				. "VALUES ('$this->title', $this->number)");
			return $res;
		}
		else return false;
	}

	public function Edit()
	{
		require("bd.php");

		$request = "UPDATE sizes SET "
				 . "title = '$this->title', "
				 . "number = $this->number "
				 . "WHERE id = $this->id";
		$res = $mysqli->query($request);
		return $res;
	}

	public static function Delete($_id)
	{
		require("bd.php");
		$res = $mysqli->query("DELETE FROM sizes WHERE id = $_id");

		return $res;
	}

	public static function GetAllFromDB()
	{
		require("bd.php");
		$request = "SELECT * FROM sizes ORDER BY id";
		$res = $mysqli->query($request);

		if ($res == false)
		{
			return false;
		}

		$sizesCount = $res->num_rows;

		for ($i = 0; $i < $sizesCount; $i++)
		{
			$res->data_seek($i);
			$sizes[$i] = new Size();
			$sizes[$i]->SetFromDB($res->fetch_assoc());
		}
		return $sizes;
	}
}


?>