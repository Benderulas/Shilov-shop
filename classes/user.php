<?php
class User 
{
	public $id,
		$login,
		$password,
		$hash,
		$ip,
		$firstName,
		$secondName = '',
		$immage = '',
		$rightsID = 2,
		$rightsTitle,
		$rightsLevel,
		$email;



	public function SetFromDB($_user)
	{
		$this->id = $_user['id'];
		$this->login = $_user['login'];
		$this->password = $_user['password'];
		$this->hash = $_user['hash'];
		$this->ip = $_user['ip'];
		$this->firstName = $_user['firstName'];
		$this->secondName = $_user['secondName'];
		$this->immage = $_user['immage'];
		$this->rightsID = $_user['rightsID'];
		$this->rightsTitle = $_user['rightsTitle'];
		$this->rightsLevel = $_user['rightsLevel'];
		$this->email = $_user['email'];
	}

	public function SetByPOST($_user)
	{
		if (isset($_user['id'])) $this->id = $_user['id'];
		$this->login = $_user['login'];
		$this->password = $_user['password'];
		$this->hash = $_user['hash'];
		$this->ip = $_user['ip'];
		$this->firstName = $_user['firstName'];
		if (isset($_user['secondName'])) $this->secondName = $_user['secondName'];
		if (isset($_user['immage'])) $this->immage = $_user['immage'];
		if (isset($_user['rightsID'])) $this->rightsID = $_user['rightsID'];
		if (isset($_user['rightsTitle'])) $this->rightsTitle = $_user['rightsTitle'];
		if (isset($_user['rightsLevel'])) $this->rightsLevel = $_user['rightsLevel'];
		$this->email = $_user['email'];
	}

	public function DoesUserExist()
	{
		require("bd.php");
		if ($res = $mysqli->query("SELECT COUNT(*) as count FROM users WHERE id = $this->id"))
		{
			$res = $res->fetch_assoc();
			if ($res['count']) return true;
			else return false;
		}
		else 
		{
			echo ("DoesUserExist request error");
			return false;
		}
	}

	public function Insert()
	{
		require("bd.php");

		$res = $mysqli->query("INSERT INTO users (login, password, hash, ip, firstName, secondName, immage, rightsID, email) "
				. "VALUES ("
				. "'$this->login', "
				. "'$this->password', "
				. "'$this->hash', "
				. "'$this->ip', "
				. "'$this->firstName', "
				. "'$this->secondName', "
				. "'$this->immage', "
				. "$this->rightsID, "
				. "'$this->email')"
			);
		var_dump($mysqli->error);
		return $res;
	}

	public function Edit()
	{
		require("bd.php");

		$request = "UPDATE users SET "
				 . "login = '$this->login', "
				 . "password = '$this->password', "
				 . "hash = '$this->hash', "
				 . "ip = '$this->ip', "
				 . "firstName = '$this->firstName', "
				 . "secondName = '$this->secondName', "
				 . "immage = '$this->immage', "
				 . "rightsID = $this->rightsID, "
				 . "email = '$this->email', "
				 . "WHERE id = $this->id";

		$res = $mysqli->query($request);

		return $res;
	}

	public static function Delete($_id)
	{
		require("bd.php");
		$res = $mysqli->query("DELETE FROM users WHERE id = $_id");

		return $res;
	}
}


?>