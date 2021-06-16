<?php

require_once("Order.php");
require_once("ProductInOrder.php");

class OrderForView
{
	public $order,
		$productsInOrder;


	function __construct()
	{
		$this->order = new Order();
	}

	public function SetByPOST()
	{
		$this->order = new Order();
		$this->order->SetByPOST();

		for ($i = 0; $i < $_POST['productsInOrder_Amount']; $i++)
		{
			$productsInOrder = new ProductInOrder();
			$productsInOrder[$i]->SetByPOST($i);
		}

	}

	public function SetByJSON($_orderForView)
	{
		$this->order = new Order();
		$this->order->SetByJSON($_orderForView);

		for ($i = 0; $i < $_POST['productsInOrder_Amount']; $i++)
		{
			$this->productsInOrder[$] = new ProductInOrder();
			$productsInOrder[$i]->SetByJSON($_orderForView->productInOrder[$i]);
		}

	}


	public function Set($_orderForView)
	{
		$this->order = $_orderForView['order'];
		$this->ProductsInOrder = $_orderForView['productsInOrder'];
	}

	public function SetById($_id, $_mysqli)
	{
		$this->order->SetById($_id, $_mysqli);

		$this->productsInOrder = ProductInOrder::GetByOrderId($_id, $_mysqli);
	}

	public function Insert($_mysqli)
	{
		$this->order->Insert($_mysqli);

		foreach ($this->productsInOrder as $productInOrder)
		{
			$productInOrder->order = $this->order;
			$productInOrder->Insert($_mysqli);
		}
	}


	public function Edit($_mysqli)
	{
		$this->order->Edit($_mysqli);

		foreach ($this->productsInOrder as $productInOrder)
		{
			if ($productInOrder->Exist($_mysqli)) $productInOrder->Edit($_mysqli);
			else $productInOrder->Insert($_mysqli);
		}

		// do i have to realize deletion productsToColorAndSize from DB, that doesn't exist in that ProductForView?
	}

	public function Delete($_mysqli)
	{
		$this->order->Delete($_mysqli);

		foreach ($this->productsInOrder as $productInOrder)
		{
			$productInOrder->Delete($_mysqli);
		}
	}	
}




?>