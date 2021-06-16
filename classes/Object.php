<?php


class Object
{
	public $id;
	protected const tableName = '';



	public function Set($_object)
	{
		echo("Undeclared method<br>");
	}

	public function SetById($_id, $_mysqli)
	{
		echo("Undeclared method<br>");
	}

	public function Exist($_mysqli)
	{
		if ($res = $_mysqli->query("SELECT COUNT(*) as count FROM " . static::tableName . " WHERE id = $this->id"))
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

	public function Insert($_mysqli)
	{
		echo("Undeclared method<br>");
	}

	public function Edit($_mysqli)
	{
		echo("Undeclared method<br>");
	}

	public function Delete($_mysqli)
	{
		$res = $_mysqli->query("DELETE FROM " . static::tableName . " WHERE id = $this->id");

		return $res;
	}
}


?>