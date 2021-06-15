<?php 


require_once("Product.php");
require_once("ProductToColorAndSize.php");

class ProductForView 
{
	public $product,
		$productsToColorAndSize;


	function __construct()
	{
		$this->product = new Product();
	}


	public function SetByPOST()
	{
		$this->product->SetByPOST();
		
		for ($i = 0; $i < $_POST['productsToColorAndSize_amount']; $i++)
		{
			$this->productsToColorAndSize[$i] = new ProductToColorAndSize();
			$this->productsToColorAndSize[$i]->SetByPOST($i);
		}
	}

	public function SetByJSON($_productForView)
	{
		$this->product->SetByJSON($_productForView);

		for ($i = 0; $i < count($_productForView->colorsAndSizes); $i++)
		{
			$this->productsToColorAndSize[$i] = new ProductToColorAndSize();
			$this->productsToColorAndSize[$i]->SetByJSON($_productForView->colorsAndSizes[$i]);
		}
	}


	public function Set($_product)
	{
		$this->product = $_product['product'];
		$this->productsToColorAndSize = $_product['productsToColorAndSize'];
	}

	public function SetById($_id, $_mysqli)
	{
		$this->product = new Product();
		$this->product->SetById($_id, $_mysqli);

		$this->productsToColorAndSize = ProductToColorAndSize::GetByProductId($_id, $_mysqli);
	}

	public function Insert($_mysqli)
	{
		$this->product->Insert($_mysqli);

		foreach ($this->productsToColorAndSize as $productToColorAndSize)
		{
			$productToColorAndSize->product = $this->product;
			$productToColorAndSize->Insert($_mysqli);
		}

	}


	public function Edit($_mysqli)
	{
		$this->product->Edit($_mysqli);

		foreach ($this->productsToColorAndSize as $productToColorAndSize)
		{
			$productToColorAndSize->product = $this->product;
			if ($productToColorAndSize->ExistByIds($_mysqli)) $productToColorAndSize->Edit($_mysqli);
			else $productToColorAndSize->Insert($_mysqli);
		}

		// do i have to realize deletion productsToColorAndSize from DB, that doesn't exist in that ProductForView?
	}

	public function Delete($_mysqli)
	{
		$this->product->Delete($_mysqli);

		foreach ($this->productsToColorAndSize as $productToColorAndSize)
		{
			$productToColorAndSize->Delete($_mysqli);
		}
	}	
}


?>