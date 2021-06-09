<?php 
class Product
{
	public $id;
	public $title;
	public $price;
	public $discount;
	public $immage;

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

	



	public function SetByPOST($_product)
	{
		if (isset($_product['id'])) $this->id = $_product['id'];
		$this->title = $_product['title]'];
		$this->price = $_product['price'];
		$this->discount = $_product['discount'];
		$this->immage = $_product['immage'];

		$this->colorID = $_product['colorID'];
		$this->sizeID = $_product['sizeID'];
		$this->categoryID = $_product['categoryID'];
		$this->companyID = $_product['companyID'];
		$this->sexID = $_product['sexID'];
	}

	public function SetFromDB($_product)
	{
		if (isset($_product['id'])) $this->id = $_product['id'];
		$this->title = $_product['title'];
		$this->price = $_product['price'];
		$this->discount = $_product['discount'];
		$this->immage = $_product['immage'];

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

	public function IsProductExist()
	{
		require("bd.php");
		if ($res = $mysqli->query("SELECT COUNT(*) as count FROM products WHERE id = $this->id"))
		{
			$res = $res->fetch_assoc();
			if ($res['count']) return true;
			else return false;
		}
		else 
		{
			echo ("IsProductExist request error");
			return false;
		}
	}

	public function Insert()
	{
		require("bd.php");

		$res = $mysqli->query("INSERT INTO products (title, colorID, price, sizeID, categoryID, companyID, sexID, discount, immage) "
				. "VALUES ('$this->title', $this->colorID, $this->price, $this->sizeID, $this->categoryID, $this->companyID, $this->sexID, $this->discount, $this->immage)");

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
				 . "WHERE id = $this->id";
		$res = $mysqli->query($request);
		return $res;
	}

	public static function Delete($_id)
	{
		require("bd.php");
		$res = $mysqli->query("DELETE FROM products WHERE id = $_id");

		return $res;
	}

}


?>