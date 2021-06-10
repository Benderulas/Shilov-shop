<?php 

require_once("Object.php");

class Product extends Object
{
	public $title;
	public $price;
	public $discount;
	public $immage;
	public $count;

	public $colorID;
	public $sizeID;
	public $categoryID;
	public $companyID;
	public $sexID;

	public $colorTitle;
	public $sizeTitle;
	public $sizeNumber;
	public $categoryTitle;
	public $companyTitle;
	public $sexTitle;

	public const tableName = 'products';

	



	public function SetByPOST($_product)
	{
		if (isset($_product['id'])) $this->id = $_product['id'];
		$this->title = $_product['title]'];
		$this->price = $_product['price'];
		$this->discount = $_product['discount'];
		$this->immage = $_product['immage'];
		$this->count = $_product['count'];

		$this->colorID = $_product['colorID'];
		$this->sizeID = $_product['sizeID'];
		$this->categoryID = $_product['categoryID'];
		$this->companyID = $_product['companyID'];
		$this->sexID = $_product['sexID'];
	}

	public function SetFromDB($_product)
	{
		$this->id = $_product['id'];
		$this->title = $_product['title'];
		$this->price = $_product['price'];
		$this->discount = $_product['discount'];
		$this->immage = $_product['immage'];
		$this->count = $_product['count'];


		$this->colorID = $_product['colorID'];
		$this->sizeID = $_product['sizeID'];
		$this->categoryID = $_product['categoryID'];
		$this->companyID = $_product['companyID'];
		$this->sexID = $_product['sexID'];

		$this->colorTitle = $_product['colorTitle'];
		$this->sizeTitle = $_product['sizeTitle'];
		$this->sizeNumber = $_product['sizeNumber'];
		$this->categoryTitle = $_product['categoryTitle'];
		$this->companyTitle = $_product['companyTitle'];
		$this->sexTitle = $_product['sexTitle'];
	}

	public function Insert()
	{
		require("bd.php");

		$res = $mysqli->query("INSERT INTO products (title, colorID, price, sizeID, categoryID, companyID, sexID, discount, immage, count) "
				. "VALUES ('$this->title', $this->colorID, $this->price, $this->sizeID, $this->categoryID, $this->companyID, $this->sexID, $this->discount, $this->immage, $this->count)");

		return $res;
	}


	public function Edit()
	{
		require("bd.php");

		$request = "UPDATE products SET "
				 . "title = '$this->title', "
				 . "colorID = $this->colorID, "
				 . "price = $this->price, "
				 . "sizeID = $this->sizeID, "
				 . "categoryID = $this->categoryID, "
				 . "companyID = $this->companyID, "
				 . "sexID = $this->sexID, "
				 . "discount = $this->discount, "
				 . "immage = '$this->immage' "
				 . "count = $this->count "
				 . "WHERE id = $this->id";
		$res = $mysqli->query($request);
		return $res;
	}

	public function InsertInOrder($_orderID)
	{
		require("bd.php");
		$request = "INSERT INTO products_in_orders (productID, orderID, count) 
											VALUES ($this->id, $_orderID, $this->count)";

		$res = $mysqli->query($request);

	}

	public function EditInOrder($_orderID)
	{
		require("bd.php");

		$request = "UPDATE products_in_orders SET "
				 . "count = $this->count "
				 . "WHERE orderID = $_orderID "
				 . "AND productID = $this->id";
		$res = $mysqli->query($request);
		return $res;
	}

	public function DeleteFromOrder($_orderID)
	{
		require("bd.php");
		$res = $mysqli->query("DELETE FROM products_in_orders" 
			. "WHERE orderID = $_orderID "
			. "AND productID = $this->id");

		return $res;
	}

}


?>