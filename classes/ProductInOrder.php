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


	fucntion __construct()
	{
		$this->order = new Order;
		$this->productToColorAndSize = new ProductToColorAndSize();
	}



	public function SetByPOST($_number)
	{
		if (isset($_POST['productInOrder_id_' . $number])) $this->id = $_POST['productInOrder_id_' . $number];

		$this->productToColorAndSize->id = $_POST['productInOrder_productToColorAndSizeID_' . $number];
		$this->amount = $_POST['productInOrder_amount_' . $number];
	}

	public function Set($_object)
	{
		$this->id = $_object['id'];

		$this->order = $_object['order'];
		$this->productToColorAndSize = $_object['productToColorAndSize'];
		$this->amount = $_object['amount'];
	}

	public function SetById($_id, $_mysqli)
	{
		$request = "SELECT * FROM " . static::tableName . " WHERE id = $_id";
		$res = $_mysqli->query($request);

		if ($res)
		{
			$productInOrder = $res->fetch_assoc();

			$productInOrder['order'] = new Order();
			$productInOrder['order']->SetById($productInOrder['orderID'], $_mysqli);

			$productInOrder['productToColorAndSize'] = new ProductToColorAndSize();
			$productInOrder['productToColorAndSize']->SetById($productInOrder['productToColorAndSizeID'], $_mysqli);

			$this->Set($productInOrder);
		}
	}

	public static function GetByOrderId($_id, $_mysqli)
	{
		$request = "SELECT id FROM " . static::tableName . " WHERE orderID = $_id";

		$res = $_mysqli->query($request);

		$count = $res->num_rows;

		
		for ($i = 0; $i < $count; $i++)
		{
			$res->data_seek($i);

			$productsInOrder[$i] = new ProductInOrder();
			$productsInOrder[$i]->SetById($res->fetch_assoc()['id'], $_mysqli);
		}

		return $productsInOrder;
	}

	public function Insert($_mysqli)
	{

		$request = "INSERT INTO " . static::tableName . " (orderID, productToColorAndSizeID, amount) "
				. "VALUES (" . $this->order->id . ", " .$this->productToColorAndSize->id . ", $this->amount)";

		$res = $_mysqli->query($request);
		$this->id = $mysqli->insert_id;

		return $this->id;
	}
	public function Edit($_mysqli)
	{

		$request = "UPDATE " . static::tableName . " SET "
				 . "orderID = " . $this->order->id . ", "
				 . "productToColorAndSizeID = " . $this->productToColorAndSize->id . ", "
				 . "amount = $this->amount "
				 . "WHERE id = $this->id";

		$res = $_mysqli->query($request);

		return ($res);
	}
}


?>