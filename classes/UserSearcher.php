<?php


require_once("Searcher.php");
require_once("User.php");

class UserSearcher extends Searcher
{
	public $login,
		$password,
		$email,
		$phone,
		$firstName,
		$secondName,

		$rightsID,

		$usersOnPage = 8,
		$page = 1;

	public function SearchByFilters()
	{
		$request = "SELECT id FROM users WHERE 1 ";

        if (isset($this->login)) $request = $request . "AND login LIKE '%$this->login%' ";
        if (isset($this->password)) $request = $request . "AND password LIKE '%$this->password%' ";
        if (isset($this->email)) $request = $request . "AND email LIKE '%$this->email%' ";
        if (isset($this->phone)) $request = $request . "AND phone LIKE '%$this->phone%' ";
        if (isset($this->firstName)) $request = $request . "AND firstName LIKE '%$this->firstName%' ";
        if (isset($this->secondName)) $request = $request . "AND secondName LIKE '%$this->secondName%' ";
        if (isset($this->rightsID)) $request = $request . "AND rightsID = $this->rightsID ";


        $request = $request
        	. "ORDER BY id "
            . "LIMIT $this->usersOnPage "
            . "OFFSET " . ($this->page - 1) * $this->usersOnPage;

		

		require("DataBase.php");
		$res = $mysqli->query($request);


		if ($res)
		{
			$usersCount = $res->num_rows;
			if ($usersCount == 0)
			{
				echo("Никто не найден");
				return false;
			}
			else
			{
				for ($i = 0; $i < $usersCount; $i++)
				{
					$res->data_seek($i);
		    		$userID = $res->fetch_assoc();

	    			$users[$i] = new User();
	    			$users[$i]->SetById($userID['id']);
				}	
				return $users;
			}
			
		}
		else 
		{
			echo("Ошибка запроса SearchUsersInBD");
			return false;
		}		
		
	}


	public function SetFiltersByGET()
	{
		if (isset($_GET['login'])) $this->login = $_GET['login'];
		if (isset($_GET['passwordpassword'])) $this->password = $_GET['password'];
		if (isset($_GET['email'])) $this->email = $_GET['email'];
		if (isset($_GET['phone'])) $this->phone = $_GET['phone'];
		if (isset($_GET['firstName'])) $this->firstName = $_GET['firstName'];
		if (isset($_GET['secondName'])) $this->secondName = $_GET['secondName'];
		if (isset($_GET['rightsID'])) $this->rightsID = $_GET['rightsID'];
	}
}


?>