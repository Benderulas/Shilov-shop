<?php

class Company
{
	public $id,
		$title;


	public function SetByPOST($_company)
	{
		if (isset($_company['id'])) $this->id = $_company['id'];
		$this->title = $_company['title]'];
	}

	public function SetFromDB($_company)
	{
		$this->id = $_company['id'];
		$this->title = $_company['title'];
	}

	public function DoesCompanyExist()
	{
		require("bd.php");
		if ($res = $mysqli->query("SELECT COUNT(*) as count FROM companies WHERE title = '$this->title'"))
		{
			$res = $res->fetch_assoc();
			if ($res['count']) return true;
			else return false;
		}
		else 
		{
			echo ("DoesCompanyExist request error");
			return false;
		}
	}

	public function Insert()
	{
		require("bd.php");

		if ($this->DoesCompanyExist() == false)
		{
			$res = $mysqli->query("INSERT INTO companies (title) "
				. "VALUES ('$this->title')");
			return $res;
		}
		else return false;
	}

	public function Edit()
	{
		require("bd.php");

		$request = "UPDATE companies SET "
				 . "title = '$this->title' "
				 . "WHERE id = $this->id";
		$res = $mysqli->query($request);
		return $res;
	}

	public static function Delete($_id)
	{
		require("bd.php");
		$res = $mysqli->query("DELETE FROM companies WHERE id = $_id");

		return $res;
	}

	public static function GetAllFromDB()
	{
		require("bd.php");
		$request = "SELECT * FROM companies ORDER BY id";
		$res = $mysqli->query($request);

		if ($res == false)
		{
			return false;
		}

		$companiesCount = $res->num_rows;

		for ($i = 0; $i < $companiesCount; $i++)
		{
			$res->data_seek($i);
			$companies[$i] = new Company();
			$companies[$i]->SetFromDB($res->fetch_assoc());
		}
		return $companies;
	}
}


?>