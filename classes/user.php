<?php

require_once("Object.php");
require_once("Rights.php");

class User extends Object
{
	public $login,
		$password,
		$email,

		$img,
		$phone,
		$firstName,
		$secondName,

		$rights;
		

	public const tableName = 'users';



	public function Set($_user)
	{
		$this->id = $_user['id'];
		$this->login = $_user['login'];
		$this->password = $_user['password'];
		$this->email = $_user['email'];

		if (isset($_user['img'])) $this->img = $_user['img'];
		if (isset($_user['phone'])) $this->phone = $_user['phone'];
		if (isset($_user['firstName'])) $this->firstName = $_user['firstName'];
		if (isset($_user['secondName'])) $this->secondName = $_user['secondName'];

		$this->rights = $_user['rights'];
	}

	public function SetById($_id)
	{
		require("DataBase.php");
		$request = "SELECT * FROM " . static::tableName . " WHERE id = $_id";
		$res = $mysqli->query($request);

		if ($res)
		{
			$user = $res->fetch_assoc();

			$user['rights'] = new Rights();
			$user['rights']->SetById($user['rightsID']);

			$this->Set($user);
		}

		return $res;
	}

	public function SetByEmail($_email)
	{
		require("DataBase.php");
		$request = "SELECT * FROM " . static::tableName . " WHERE email = '$_email'";
		$res = $mysqli->query($request);

		if ($res)
		{
			$user = $res->fetch_assoc();

			$user['rights'] = new Rights();
			$user['rights']->SetById($user['rightsID']);

			$this->Set($user);
		}

		return $res;
	}

	public function SetByLogin($_login)
	{
		require("DataBase.php");
		$request = "SELECT * FROM " . static::tableName . " WHERE login = '$_login'";
		$res = $mysqli->query($request);

		if ($res)
		{
			$user = $res->fetch_assoc();

			$user['rights'] = new Rights();
			$user['rights']->SetById($user['rightsID']);

			$this->Set($user);
		}

		return $res;
	}

	
	public function Insert()
	{
		require("DataBase.php");

		$request = "INSERT INTO " . static::tableName . " (login, password, email, img, phone, firstName, secondName, rightsID) "
				. "VALUES ("
				. "'$this->login', "
				. "'$this->password', "
				. "'$this->email', "
				. "'$this->img', "
				. "'$this->phone', "
				. "'$this->firstName', "
				. "'$this->secondName', "
				. $this->rights->id . " "
				. ")";

		$res = $mysqli->query($request);
		$this->id = $mysqli->insert_id;

		return $this->id;
	}

	public function Edit()
	{
		require("DataBase.php");

		$request = "UPDATE " . static::tableName . " SET "
				 . "login = '$this->login', "
				 . "password = '$this->password', "
				 . "email = '$this->email', "
				 . "img = '$this->img', "
				 . "phone = '$this->phone', "
				 . "firstName = '$this->firstName', "
				 . "secondName = '$this->secondName', "
				 . "rightsID = " . $this->rights->id . " "
				 . "WHERE id = $this->id";

		$res = $mysqli->query($request);

		return $res;
	}
}


?>