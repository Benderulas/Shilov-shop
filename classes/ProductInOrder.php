<?php

require_once("Object.php");
require_once("ProductToColorAndSize.php");
require_once("Order.php");


class ProductInOrder extends Object
{
	public const tableName = 'products_in_orders';

	public $order,
		$productToColorAndSize,

		$amount;


	public function Set($_object)
	{
		if (isset($_object['id'])) $this->id = $_object['id'];

		$this->order = $_object['order'];
		$this->productToColorAndSize = $_object['productToColorAndSize'];
		$this->amount = $_object['amount'];
	}

	public function SetById($_id)
	{
		require("DataBase.php");
		$request = "SELECT * FROM " . static::tableName . " WHERE id = $_id";
		$res = $mysqli->query($request);

		if ($res)
		{
			$productInOrder = $res->fetch_assoc();

			$productInOrder['order'] = new Order();
			$productInOrder['order']->SetById($productInOrder['orderID']);

			$productInOrder['productToColorAndSize'] = new ProductToColorAndSize();
			$productInOrder['productToColorAndSize']->SetById($productInOrder['productToColorAndSizeID']);

			$this->Set($productInOrder);
		}
	}

	public static function GetByOrderId($_id)
	{
		require("DataBase.php");
		$request = "SELECT id FROM " . static::tableName . " WHERE orderID = $_id";

		$res = $mysqli->query($request);

		$count = $res->num_rows;

		
		for ($i = 0; $i < $count; $i++)
		{
			$res->data_seek($i);

			$productsInOrder[$i] = new ProductInOrder();
			$productsInOrder[$i]->SetById($res->fetch_assoc()['id']);
		}

		return $productsInOrder;
	}

	public function Insert()
	{
		require("DataBase.php");

		$request = "INSERT INTO " . static::tableName . " (orderID, productToColorAndSizeID, amount) "
				. "VALUES (" . $this->order->id . ", " .$this->productToColorAndSize->id . ", $this->amount)";

		$res = $mysqli->query($request);
		$this->id = $mysqli->insert_id;

		return $this->id;
	}
	public function Edit()
	{
		require("DataBase.php");

		$request = "UPDATE " . static::tableName . " SET "
				 . "orderID = " . $this->order->id . ", "
				 . "productToColorAndSizeID = " . $this->productToColorAndSize->id . ", "
				 . "amount = $this->amount "
				 . "WHERE id = $this->id";

		$res = $mysqli->query($request);

		return ($res);
	}
}


?>