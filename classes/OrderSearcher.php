<?php
require_once("Searcher.php");
require_once("Order.php");
require_once("Product.php");


class OrderSearcher
{
	public $userID,
		$statusID,
		$firstName,
		$secondName,
		$country,
		$town, 
		$address,
		$phoneNumber,
		$postIndex,

		$statusTitle,
		$email,

		$ordersOnPage,
		$page;

	public function SearchByFilters()
	{
		require("bd.php");
		$request = "SELECT "
			. "order.id, "
			. "order.userID, "
			. "order.statusID, "
			. "order.firstName, "
			. "order.secondName, "
			. "order.country, "

			. "order.town, "
			. "order.address, "
			. "order.phoneNumber, "
			. "order.postIndex, "

            . "order_statuses.title AS statusTitle, "
            . "users.email AS email "

            . "FROM orders "

            . "INNER JOIN order_statuses ON orders.statusID = order_statuses.id "
            . "INNER JOIN users ON order.userID = users.id "
            . "WHERE 1 ";

        if(issset($this->userID)) $request = $request . "AND orders.userID = $this->userID ";
        if(issset($this->statusID)) $request = $request . "AND orders.statusID = $this->statusID ";
        if(issset($this->firstName)) $request = $request . "AND orders.firstName LIKE '%$this->firstName%'' ";
        if(issset($this->secondName)) $request = $request . "AND orders.secondName LIKE '%$this->secondName%'' ";
        if(issset($this->country)) $request = $request . "AND orders.country LIKE '%$this->country%'' ";
        if(issset($this->town)) $request = $request . "AND orders.town LIKE '%$this->town%'' ";
        if(issset($this->address)) $request = $request . "AND orders.address LIKE '%$this->address%'' ";
        if(issset($this->phoneNumber)) $request = $request . "AND orders.phoneNumber = '$this->phoneNumber'' ";
        if(issset($this->postIndex)) $request = $request . "AND orders.postIndex = $this->postIndex ";
        if(issset($this->statusTitle)) $request = $request . "AND order_statuses.title LIKE '%$this->statusTitle%'' ";
        if(issset($this->email)) $request = $request . "AND users.email LIKE '%$this->email%'' ";


        $request = $request
        	. "ORDER BY orders.id "
            . "LIMIT $this->ordersOnPage "
            . "OFFSET " . ($this->page - 1) * $this->ordersOnPage;
		
		$res = $mysqli->query($request);
		
		if ($res) $ordersCount = $res->num_rows;
		else $ordersCount = 0;

		$orders = false;



		if ($res)
		{
			for ($i = 0; $i < $ordersCount; $i++)
			{
				$res->data_seek($i);
	    		$order = $res->fetch_assoc();

    			$orders[$i] = new Order();
    			$orders[$i]->SetFromDB($order);
			}
		}
		else 
		{
			echo("Ошибка запроса");
		}		
		return $orders;
	}


	public function GetById($_id)
	{
		require("bd.php");
		$request = "SELECT "
			. "order.id, "
			. "order.userID, "
			. "order.statusID, "
			. "order.firstName, "
			. "order.secondName, "
			. "order.country, "

			. "order.town, "
			. "order.address, "
			. "order.phoneNumber, "
			. "order.postIndex, "

            . "order_statuses.title AS statusTitle, "
            . "users.email AS email "

            . "FROM orders "

            . "INNER JOIN order_statuses ON orders.statusID = order_statuses.id "
            . "INNER JOIN users ON order.userID = users.id "
            . "WHERE orders.id = $_id ";

		$res = $mysqli($request);

		if($res->num_rows)
		{
			$order = new Order();
			$order->SetFromDB($res->fetch_assoc());
			return $order;
		}
		else return false;

	}
}

?>