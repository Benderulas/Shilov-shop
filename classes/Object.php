<?php


class Object
{
	public $id;
	public const tableName = '';



	public function SetFromDB($_object)
	{
		echo("Undeclared method<br>");
	}

	public function SetByPOST($_object)
	{
		echo("Undeclared method<br>");
	}

	public function Exist()
	{
		require("bd.php");
		if ($res = $mysqli->query("SELECT COUNT(*) as count FROM " . static::tableName . " WHERE id = $this->id"))
		{
			$res = $res->fetch_assoc();
			if ($res['count']) return true;
			else return false;
		}
		else 
		{
			echo (static::class . " Exist request error");
			return false;
		}
	}

	public function Insert()
	{
		echo("Undeclared method<br>");
	}

	public function Edit()
	{
		echo("Undeclared method<br>");
	}

	public function Delete()
	{
		require("bd.php");
		$res = $mysqli->query("DELETE FROM " . static::tableName . " WHERE id = $this->id");

		return $res;
	}
}


?>