<?php 


require_once("Product.php");
require_once("ProductToColorAndSize.php");

class ProductForView 
{
	public $product,
		$productsToColorAndSize;


	public function Set($_product)
	{
		$this->product = $_product['product'];
		$this->productsToColorAndSize = $_product['productsToColorAndSize'];
	}

	public function SetById($_id)
	{
		$this->product = new Product();
		$this->product->SetById($_id);

		$this->productsToColorAndSize = ProductToColorAndSize::GetByProductId($_id);
	}

	public function Insert()
	{
		$this->product->Insert();

		foreach ($this->productsToColorAndSize as $productToColorAndSize)
		{
			$productToColorAndSize->product = $this->product;
			$productToColorAndSize->Insert();
		}

	}


	public function Edit()
	{
		$this->product->Edit();

		foreach ($this->productsToColorAndSize as $productToColorAndSize)
		{
			if ($productToColorAndSize->Exist()) $productToColorAndSize->Edit();
			else $productToColorAndSize->Insert();
		}

		// do i have to realize deletion productsToColorAndSize from DB, that doesn't exist in that ProductForView?
	}

	public function Delete()
	{
		$this->product->Delete();

		foreach ($this->productsToColorAndSize as $productToColorAndSize)
		{
			$productToColorAndSize->Delete();
		}
	}	
}


?>