<?php
require_once("Searcher.php");
require_once("OrderForView.php");


class OrderForViewSearcher
{
	public $userID,
		$statusID,
		$deliveryCompanyID,
		$firstName,
		$secondName,
		$country,
		$city, 
		$address,
		$phoneNumber,
		$postIndex,

		$ordersOnPage = 8,
		$page = 1;

	public function SearchByFilters($_mysqli)
	{
		$request = "SELECT id FROM orders WHERE 1 ";

        if(isset($this->userID)) $request = $request . "AND userID = $this->userID ";
        if(isset($this->statusID)) $request = $request . "AND statusID = $this->statusID ";
        if(isset($this->deliveryCompanyID)) $request = $request . "AND deliveryCompanyID = $this->deliveryCompanyID ";
        if(isset($this->firstName)) $request = $request . "AND firstName LIKE '%$this->firstName%' ";
        if(isset($this->secondName)) $request = $request . "AND secondName LIKE '%$this->secondName%' ";
        if(isset($this->country)) $request = $request . "AND country LIKE '%$this->country%' ";
        if(isset($this->city)) $request = $request . "AND city LIKE '%$this->city%' ";
        if(isset($this->address)) $request = $request . "AND address LIKE '%$this->address%' ";
        if(isset($this->phoneNumber)) $request = $request . "AND phoneNumber LIKE '%$this->phoneNumber%' ";
        if(isset($this->postIndex)) $request = $request . "AND postIndex = $this->postIndex ";


        $request = $request
        	. "ORDER BY id "
            . "LIMIT $this->ordersOnPage "
            . "OFFSET " . ($this->page - 1) * $this->ordersOnPage;
		
		$res = $_mysqli->query($request);
		
		if ($res) $ordersCount = $res->num_rows;
		else $ordersCount = 0;

		$orders = false;



		if ($res)
		{
			for ($i = 0; $i < $ordersCount; $i++)
			{
				$res->data_seek($i);
	    		$order = $res->fetch_assoc();

    			$orders[$i] = new OrderForView();
    			$orders[$i]->SetById($order['id']);
			}
		}
		else 
		{
			var_dump($_mysqli->error);
			echo("Ошибка запроса");
		}		
		return $orders;
	}

	public function SetFiltersByGET()
	{
		if (isset($_GET['userID'])) $this->userID = $_GET['userID'];
		if (isset($_GET['statusID'])) $this->statusID = $_GET['statusID'];
		if (isset($_GET['deliveryCompanyID'])) $this->deliveryCompanyID = $_GET['deliveryCompanyID'];
		if (isset($_GET['firstName'])) $this->firstName = $_GET['firstName'];
		if (isset($_GET['secondName'])) $this->secondName = $_GET['secondName'];
		if (isset($_GET['country'])) $this->country = $_GET['country'];
		if (isset($_GET['city'])) $this->city = $_GET['city'];
		if (isset($_GET['address'])) $this->address = $_GET['address'];
		if (isset($_GET['phoneNumber'])) $this->phoneNumber = $_GET['phoneNumber'];
		if (isset($_GET['postIndex'])) $this->postIndex = $_GET['postIndex'];
	}	
}

?>