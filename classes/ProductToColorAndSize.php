<?php

require_once("Object.php");
require_once("Product.php");
require_once("Size.php");
require_once("Color.php");


class ProductToColorAndSize extends Object
{
	public const tableName = 'products_to_color_and_size';


	public $product,
		$size,
		$color,
		$amount;


	public function Set($_object)
	{
		if (isset($_object['id'])) $this->id = $_object['id'];

		$this->product = $_object['product'];
		$this->size = $_object['size'];
		$this->color = $_object['color'];
		$this->amount = $_object['amount'];
	}

	public function SetById($_id)
	{
		require("DataBase.php");
		$request = "SELECT * FROM " . static::tableName . " WHERE id = $_id";
		$res = $mysqli->query($request);

		if ($res)
		{
			$product = $res->fetch_assoc();

			$product['product'] = new Product();
			$product['product']->SetById($product['productID']);

			$product['size'] = new Size();
			$product['size']->SetById($product['sizeID']);

			$product['color'] = new Color();
			$product['color']->SetById($product['colorID']);

			$this->Set($product);
		}
	}

	public static function GetByProductId($_id)
	{
		require("DataBase.php");
		$request = "SELECT id FROM " . static::tableName . " WHERE productID = $_id";

		$res = $mysqli->query($request);

		$count = $res->num_rows;

				

		for ($i = 0; $i < $count; $i++)
		{
			$res->data_seek($i);

			$productsToColorAndSize[$i] = new ProductToColorAndSize();
			$productsToColorAndSize[$i]->SetById($res->fetch_assoc()['id']);
		}

		return $productsToColorAndSize;
	}

	public function Insert()
	{
		require("DataBase.php");

		$request = "INSERT INTO " . static::tableName . " (productID, sizeID, colorID, amount) "
				. "VALUES (" 
				. $this->product->id . ", "
				. $this->size->id . ", " 
				. $this->color->id . ", "
				. "$this->amount)";

		$res = $mysqli->query($request);
		$this->id = $mysqli->insert_id;
		return $this->id;
	}
	public function Edit()
	{
		require("DataBase.php");

		$request = "UPDATE " . static::tableName . " SET "
				 . "productID = " . $this->product->id . ", "
				 . "sizeID = " . $this->size->id . ", "
				 . "colorID = " . $this->color->id . ", "
				 . "amount = $this->amount "
				 . "WHERE id = $this->id";
		$res = $mysqli->query($request);

		return ($res);
	}
}



?>