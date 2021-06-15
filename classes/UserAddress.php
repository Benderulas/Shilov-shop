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

	public function SetById($_id, $_mysqli)
	{\
		$request = "SELECT * FROM " . static::tableName . " WHERE id = $_id";
		$res = $_mysqli->query($request);

		if ($res)
		{
			$userAddress = $res->fetch_assoc();

			$userAddress['user'] = new User();
			$userAddress['user']->SetById($userAddress['userID']);

			$this->Set($userAddress);
		}
	}

	public static function GetByUserId($_id, $_mysqli)
	{
		$request = "SELECT id FROM " . static::tableName . " WHERE userID = $_id";

		$res = $_mysqli->query($request);

		$count = $res->num_rows;

		$userAddresses = false;

		
		for ($i = 0; $i < $count; $i++)
		{
			$res->data_seek($i);

			$userAddresses[$i] = new UserAddress();
			$userAddresses[$i]->SetById($res->fetch_assoc()['id'], $_mysqli);
		}

		return $userAddresses;
	}

	public function Insert($_mysqli)
	{

		$request = "INSERT INTO " . static::tableName . " (userID, country, city, address, postIndex) "
				. "VALUES (" 
				. $this->user->id . ", 
				'$this->country', 
				'$this->city', 
				'$this->address', 
				$this->postIndex)";

		$res = $_mysqli->query($request);
		$this->id = $_mysqli->insert_id;

		return $this->id;
	}


	public function Edit($_mysqli)
	{

		$request = "UPDATE " . static::tableName . " SET "
				 . "userID = " . $this->user->id . ", "
				 . "country = '$this->country', "
				 . "city = '$this->city', "
				 . "address = '$this->address', "
				 . "postIndex = $this->postIndex "
				 . "WHERE id = $this->id";

		$res = $_mysqli->query($request);

		return ($res);
	}
}



?>