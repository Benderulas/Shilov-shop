<?php

require_once("Object.php");
require_once("User.php");


class UserAddress extends Object
{
	public const tableName = 'user_addresses';

	public $user,

		$country,
		$city,
		$address,
		$postIndex;


	public function Set($_userAddress)
	{
		if (isset($_userAddress['id'])) $this->id = $_userAddress['id'];

		$this->user = $_userAddress['user'];
		$this->country = $_userAddress['country'];
		$this->city = $_userAddress['city'];
		$this->address = $_userAddress['address'];
		$this->postIndex = $_userAddress['postIndex'];
	}

	public function SetById($_id)
	{
		require("DataBase.php");
		$request = "SELECT * FROM " . static::tableName . " WHERE id = $_id";
		$res = $mysqli->query($request);

		if ($res)
		{
			$userAddress = $res->fetch_assoc();

			$userAddress['user'] = new User();
			$userAddress['user']->SetById($userAddress['userID']);

			$this->Set($userAddress);
		}
	}

	public static function GetByUserId($_id)
	{
		require("DataBase.php");
		$request = "SELECT id FROM " . static::tableName . " WHERE userID = $_id";

		$res = $mysqli->query($request);

		$count = $res->num_rows;

		$userAddresses = false;

		
		for ($i = 0; $i < $count; $i++)
		{
			$res->data_seek($i);

			$userAddresses[$i] = new UserAddress();
			$userAddresses[$i]->SetById($res->fetch_assoc()['id']);
		}

		return $userAddresses;
	}

	public function Insert()
	{
		require("DataBase.php");

		$request = "INSERT INTO " . static::tableName . " (userID, country, city, address, postIndex) "
				. "VALUES (" 
				. $this->user->id . ", 
				'$this->country', 
				'$this->city', 
				'$this->address', 
				$this->postIndex)";

		$res = $mysqli->query($request);
		$this->id = $mysqli->insert_id;

		return $this->id;
	}


	public function Edit()
	{
		require("DataBase.php");

		$request = "UPDATE " . static::tableName . " SET "
				 . "userID = " . $this->user->id . ", "
				 . "country = '$this->country', "
				 . "city = '$this->city', "
				 . "address = '$this->address', "
				 . "postIndex = $this->postIndex "
				 . "WHERE id = $this->id";

		$res = $mysqli->query($request);

		return ($res);
	}
}



?>