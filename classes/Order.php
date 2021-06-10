<?php

require_once("ProductSearcher.php");
require_once("Product.php");
require_once("Object.php");

class Order extends Object
{
	public $userID,
		$statusID,
		$firstName,
		$secondName,
		$country,
		$town, 
		$address,
		$phoneNumber,
		$postIndex,

		$statusTitle,
		$email,

		$products;

	public const tableName = 'orders';




	public function GetProductsFromDb()
	{
		require("bd.php");
		$request = "SELECT productID FROM products_in_orders WHERE orderID = $this->id ORDER BY id";
		$res = $mysqli->query($request);

		if ($res) $productsID = $res->fetch_all();


		$productSearcher = new ProductSearcher();

		for ($i = 0; $i < count($productsID); $i++)
		{
			$products[$i] = $productSearcher->GetById($productsID[$i]);
		}

	}


	public function SetFromDB($_order)
	{
		$this->id = $_order['id'];
		$this->userID = $_order['userID'];
		$this->statusID = $_order['statusID'];
		$this->firstName = $_order['firstName'];
		$this->secondName = $_order['secondName'];
		$this->country = $_order['country'];
		$this->town = $_order['town'];
		$this->address = $_order['address'];
		$this->phoneNumber = $_order['phoneNumber'];
		$this->postIndex = $_order['postIndex'];

		$this->statusTitle = $_order['statusTitle'];
		$this->email = $_order['email'];

		$this->GetProductsFromDb();
	}

	public function SetByPOST($_order)
	{
		if (isset($_order['id'])) $this->id = $_order['id'];
		$this->userID = $_order['userID'];
		$this->statusID = $_order['statusID'];
		$this->firstName = $_order['firstName'];
		$this->secondName = $_order['secondName'];
		$this->country = $_order['country'];
		$this->town = $_order['town'];
		$this->address = $_order['address'];
		$this->phoneNumber = $_order['phoneNumber'];
		$this->postIndex = $_order['postIndex'];

		if (isset($_order['products'])) $this->products = $_order['products'];
	}

	public function Insert()
	{
		require("bd.php");

		$res = $mysqli->query("INSERT INTO orders (
					userID, 
					statusID, 
					firstName, 
					secondName, 
					country, 
					town, 
					address, 
					phoneNumber, 
					postIndex) 

					VALUES (
					$this->userID, 
					$this->statusID, 
					'$this->firstName', 
					'$this->secondName', 
					'$this->country', 
					'$this->town', 
					'$this->address', 
					'$this->phoneNumber', 
					$this->postIndex)"
			);

		for ($i = 0; $i < count($products); $i++)
		{
			$products[$i]->InsertInOrder($this->id);
		}
	}

	public function Edit()
	{
		require("bd.php");

		$request = "UPDATE users SET "
				 . "userID = $this->userID, "
				 . "statusID = $this->statusID, "
				 . "firstName = '$this->firstName', "
				 . "secondName = '$this->secondName', "
				 . "country = '$this->country', "
				 . "town = '$this->town', "
				 . "address = '$this->address', "
				 . "phoneNumber = '$this->phoneNumber', "
				 . "postIndex = $this->postIndex, "
				 . "WHERE id = $this->id";

		$res = $mysqli->query($request);

		for ($i = 0; $i < count($products); $i++)
		{
			$products[$i]->EditInOrder($this->id);
		}
	}

	public function Delete()
	{
		require("bd.php");
		$res = $mysqli->query("DELETE FROM users WHERE id = $this->id");
		
		for ($i = 0; $i < count($products); $i++)
		{
			$products[$i]->DeleteFromOrder($this->id);
		}
	}
}




?>