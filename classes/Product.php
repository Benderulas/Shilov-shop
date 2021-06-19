<?php 

require_once("Object.php");
require_once("Category.php");
require_once("Company.php");
require_once("Sex.php");

class Product extends Object
{
	public $title,
		$img,
		$price,
		$discount,

		$category,
		$company,
		$sex;

	public const tableName = 'products';

	function __construct()
	{
		$this->category = new Category();
		$this->company = new Company();
		$this->sex = new Sex();
	}


	public function SetByPOST()
	{
		if (isset($_POST['product_id'])) $this->id = $_POST['product_id'];
		if (isset($_POST['product_img'])) $this->img = $_POST['product_img'];
		if (isset($_POST['product_discount'])) $this->discount = $_POST['product_discount'];
		$this->title = $_POST['product_title'];
		$this->price = $_POST['product_price'];

		$this->category = $_POST['product_categoryID'];
		$this->company = $_POST['product_companyID'];
		$this->sex = $_POST['product_sexiD'];
	}

	public function SetByJSON($_product)
	{
		if (isset($_product->id)) $this->id = $_product->id;
		if (isset($_product->image)) $this->img = $_product->image;
		if (isset($_product->discount)) $this->discount = $_product->discount;
		$this->title = $_product->title;
		$this->price = $_product->price;

		$this->category->id = $_product->categoryID;
		$this->company->id = $_product->companyID;
		$this->sex->id = $_product->sexID;
	}


	public function Set($_product)
	{
		if (isset($_product['id'])) $this->id = $_product['id'];
		if (isset($_product['img'])) $this->img = $_product['img'];
		if (isset($_product['discount'])) $this->discount = $_product['discount'];
		$this->title = $_product['title'];
		$this->price = $_product['price'];

		$this->category = $_product['category'];
		$this->company = $_product['company'];
		$this->sex = $_product['sex'];
	}

	public function SetById($_id, $_mysqli)
	{
		$request = "SELECT * FROM " . static::tableName . " WHERE id = $_id";
		$res = $_mysqli->query($request);

		if ($res)
		{
			$product = $res->fetch_assoc();

			$product['category'] = new Category();
			$product['category']->SetById($product['categoryID'], $_mysqli);

			$product['company'] = new Company();
			$product['company']->SetById($product['companyID'], $_mysqli);

			$product['sex'] = new Sex();
			$product['sex']->SetById($product['sexID'], $_mysqli);

			$this->Set($product);
		}

	}

	public function Insert($_mysqli)
	{

		$request = "INSERT INTO " . static::tableName . " (title, img, price, discount, categoryID, companyID, sexID) "
				. "VALUES (
				'$this->title', 
				'$this->img', 
				$this->price, 
				$this->discount, "
				. $this->category->id . ", "
				. $this->company->id . ", " 
				. $this->sex->id 
				. ")";

		$res = $_mysqli->query($request);
		var_dump($this);
		var_dump($request);

		$this->id = $_mysqli->insert_id;
		return $this->id;
	}


	public function Edit($_mysqli)
	{

		$request = "UPDATE products SET "
				 . "title = '$this->title', "
				 . "img = '$this->img', "
				 . "price = $this->price, "
				 . "discount = $this->discount, "
				 . "categoryID = " . $this->category->id . ", "
				 . "companyID = " . $this->company->id . ", "
				 . "sexID = " . $this->sex->id. " "
				 . "WHERE id = $this->id";
		$res = $_mysqli->query($request);

		return ($res);
	}
}


?>