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


	function __construct()
	{
		$this->product = new Product();
		$this->size = new Size();
		$this->color = new Color();
	}


	public function SetByPOST($_number)
	{
		if (isset($_POST['productToColorAndSize_id_' . $number])) $this->id = $_POST['productToColorAndSize_id_' . $number];

		$this->product->id = $_POST['productToColorAndSize_productID_' . $number];
		$this->size->id = $_POST['productToColorAndSize_sizeID_' . $number];
		$this->color->id = $_POST['productToColorAndSize_colorID_' . $number];

		$this->amount = $_POST['productToColorAndSize_amount_' . $number];
	}

	public function SetByJSON($_colorAndSize)
	{
		if (isset($_colorAndSize->id)) $this->id = $_colorAndSize->id;

		$this->size->id = $_colorAndSize->sizeID;
		$this->color->id = $_colorAndSize->colorID;

		$this->amount = $_colorAndSize->amount;
	}


	public function Set($_object)
	{
		if (isset($_object['id'])) $this->id = $_object['id'];

		$this->product = $_object['product'];
		$this->size = $_object['size'];
		$this->color = $_object['color'];
		$this->amount = $_object['amount'];
	}

	public function SetById($_id, $_mysqli)
	{
		$request = "SELECT * FROM " . static::tableName . " WHERE id = $_id";
		$res = $_mysqli->query($request);

		if ($res)
		{
			$product = $res->fetch_assoc();

			$product['product'] = new Product();
			$product['product']->SetById($product['productID'], $_mysqli);

			$product['size'] = new Size();
			$product['size']->SetById($product['sizeID'], $_mysqli);

			$product['color'] = new Color();
			$product['color']->SetById($product['colorID'], $_mysqli);

			$this->Set($product);
		}
	}

	public static function GetByProductId($_id, $_mysqli)
	{
		$request = "SELECT id FROM " . static::tableName . " WHERE productID = $_id";

		$res = $_mysqli->query($request);

		$count = $res->num_rows;

				

		for ($i = 0; $i < $count; $i++)
		{
			$res->data_seek($i);

			$productsToColorAndSize[$i] = new ProductToColorAndSize();
			$productsToColorAndSize[$i]->SetById($res->fetch_assoc()['id'], $_mysqli);
		}

		return $productsToColorAndSize;
	}

	public function Insert($_mysqli)
	{

		$request = "INSERT INTO " . static::tableName . " (productID, sizeID, colorID, amount) "
				. "VALUES (" 
				. $this->product->id . ", "
				. $this->size->id . ", " 
				. $this->color->id . ", "
				. "$this->amount)";

		$res = $_mysqli->query($request);
		$this->id = $_mysqli->insert_id;
		return $this->id;
	}
	public function Edit($_mysqli)
	{

		$request = "UPDATE " . static::tableName . " SET "
				. "amount = $this->amount "
				. "WHERE productID = " . $this->product->id . " "
				. "AND colorID = " . $this->color->id . " "
				. "AND sizeID = " . $this->size->id;
		$res = $_mysqli->query($request);

		return ($res);
	}

	public function ExistByIds($_mysqli)
	{
		$request = "SELECT COUNT(*) as count FROM " . static::tableName . " " 
			. "WHERE productID = " . $this->product->id . " "
			. "AND colorID = " . $this->color->id . " "
			. "AND sizeID = " . $this->size->id;

		if ($res = $_mysqli->query($request))
		{
			$res = $res->fetch_assoc();
			if ($res['count']) return true;
			else return false;
		}
		else 
		{
			echo (static::class . " ExistByIds request error");
			return false;
		}
	}

	static function GetIdByIds($_ids, $_mysqli)
	{
		$request = "SELECT id FROM " . static::tableName . " " 
			. "WHERE productID = " . $_ids->productID . " "
			. "AND colorID = " . $_ids->colorID . " "
			. "AND sizeID = " . $_ids->sizeID;

		if ($res = $_mysqli->query($request))
		{
			$res = $res->fetch_assoc();
			return $res['id'];
		}
		else 
		{
			echo (static::class . " GetIdByIds request error" . $_mysqli->error);
			var_dump($request);
			return false;
		}
	}
}



?>