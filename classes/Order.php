<?php

require_once("Object.php");
require_once("OrderStatus.php");
require_once("User.php");
require_once("DeliveryCompany.php");

class Order extends Object
{
	public $user,
		$status,
		$deliveryCompany,

		$firstName,
		$secondName,
		$phoneNumber, 
		$country,
		$city,
		$address,
		$postIndex;

	public const tableName = 'orders';




	public function Set($_order)
	{
		if(isset($_order['id'])) $this->id = $_order['id'];

		$this->user = $_order['user'];
		$this->status = $_order['status'];
		$this->deliveryCompany = $_order['deliveryCompany'];

		$this->firstName = $_order['firstName'];
		$this->secondName = $_order['secondName'];
		$this->phoneNumber = $_order['phoneNumber'];
		$this->country = $_order['country'];
		$this->city = $_order['city'];
		$this->address = $_order['address'];
		$this->postIndex = $_order['postIndex'];

	}
	public function SetById($_id)
	{
		require("DataBase.php");
		$request = "SELECT * FROM " . static::tableName . " WHERE id = $_id";
		$res = $mysqli->query($request);

		if ($res)
		{
			$product = $res->fetch_assoc();

			$product['user'] = new User();
			$product['user']->SetById($product['userID']);

			$product['status'] = new OrderStatus();
			$product['status']->SetById($product['statusID']);

			$product['deliveryCompany'] = new DeliveryCompany();
			$product['deliveryCompany']->SetById($product['deliveryCompanyID']);

			$this->Set($product);
		}
	}

	public function Insert()
	{
		require("DataBase.php");

		$request = "INSERT INTO " . static::tableName . " (
			userID, 
			statusID, 
			deliveryCompanyID, 
			firstName, 
			secondName, 
			phoneNumber,
			country, 
			city, 
			address, 
			postIndex
			) 
			VALUES ( "
			. $this->user->id . ", "
			. $this->status->id . ", "
			. $this->deliveryCompany->id . ", "
			. " '$this->firstName', 
				'$this->secondName', 
				'$this->phoneNumber', 
				'$this->country', 
				'$this->city', 
				'$this->address', 
				$this->postIndex
				)";

		$res = $mysqli->query($request);
		$this->id = $mysqli->insert_id;

		return $this->id;
	}

	public function Edit()
	{
		require("DataBase.php");

		$request = "UPDATE products SET "
				 . "userID = " . $this->user->id . ", "
				 . "statusID = " . $this->status->id . ", "
				 . "deliveryCompanyID = " . $this->deliveryCompany->id . ", "
				 . "firstName = '$this->firstName', "
				 . "secondName = '$this->secondName', "
				 . "phoneNumber = '$this->phoneNumber', "
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