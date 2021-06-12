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


	public function Set($_orderForView)
	{
		$this->order = $_orderForView['order'];
		$this->ProductsInOrder = $_orderForView['productsInOrder'];
	}

	public function SetById($_id)
	{
		$this->order->SetById($_id);

		$this->productsInOrder = ProductInOrder::GetByOrderId($_id);
	}

	public function Insert()
	{
		$this->order->Insert();

		foreach ($this->productsInOrder as $productInOrder)
		{
			$productInOrder->order = $this->order;
			$productInOrder->Insert();
		}
	}


	public function Edit()
	{
		$this->order->Edit();

		foreach ($this->productsInOrder as $productInOrder)
		{
			if ($productInOrder->Exist()) $productInOrder->Edit();
			else $productInOrder->Insert();
		}

		// do i have to realize deletion productsToColorAndSize from DB, that doesn't exist in that ProductForView?
	}

	public function Delete()
	{
		$this->order->Delete();

		foreach ($this->productsInOrder as $productInOrder)
		{
			$productInOrder->Delete();
		}
	}	
}




?>