<?php

require("User.php");

class UserSearcher
{
	public $login = '',
		$firstName = '',
		$secondName = '',
		$rightsID = false,
		$email = '',
		$count = 1;


	public function FindUserByLogin()
	{
		$request = "SELECT "
			. "users.id, "
			. "users.login, "
			. "users.password, "
			. "users.hash, "
			. "users.ip, "

			. "users.firstName, "
			. "users.secondName, "
			. "users.rightsID, "
			. "users.email, "
			. "users.immage, "
			
            . "rights.title AS rightsTitle, "
            . "rights.level AS rightsLevel "

            . "FROM users "

            . "INNER JOIN rights ON users.rightsID = rights.id "

            . "WHERE users.login = '$this->login'";		

		require("bd.php");
		$res = $mysqli->query($request);

		if ($res)
		{
			$user = new User();
			$user->SetFromDB($res->fetch_assoc());
			return $user;			
		}
		else 
		{
			echo("Ошибка запроса SearchUsersInBD");
			return false;
		}
	}


	public function FindUserByEmail()
	{
		$request = "SELECT "
			. "users.id, "
			. "users.login, "
			. "users.password, "
			. "users.hash, "
			. "users.ip, "

			. "users.firstName, "
			. "users.secondName, "
			. "users.rightsID, "
			. "users.email, "
			. "users.immage, "
			
            . "rights.title AS rightsTitle, "
            . "rights.level AS rightsLevel "

            . "FROM users "

            . "INNER JOIN rights ON users.rightsID = rights.id "

            . "WHERE users.email = '$this->email'";		

		require("bd.php");
		$res = $mysqli->query($request);

		if ($res)
		{
			$user = new User();
			$user->SetFromDB($res->fetch_assoc());
			return $user;			
		}
		else 
		{
			echo("Ошибка запроса SearchUsersInBD");
			return false;
		}		
		
	}

	public function SearchUsersByFilters()
	{
		$request = "SELECT "
			. "users.id, "
			. "users.login, "
			. "users.password, "
			. "users.hash, "
			. "users.ip, "

			. "users.firstName, "
			. "users.secondName, "
			. "users.rightsID, "
			. "users.email, "
			. "users.immage, "
			
            . "rights.title AS rightsTitle, "
            . "rights.level AS rightsLevel "

            . "FROM users "

            . "INNER JOIN rights ON users.rightsID = rights.id "

            . "WHERE users.login LIKE '%$this->login%' "
            . "AND users.firstName LIKE '%$this->firstName%' "
            . "AND users.secondName LIKE '%$this->secondName%' "
            . "AND users.email LIKE '%$this->email%' ";

        if ($this->rightsID) $request = $request . "AND users.rightsID = $this->rightsID ";


        $request = $request
        	. "ORDER BY users.id "
            . "LIMIT $this->count ";
		

		require("bd.php");
		$res = $mysqli->query($request);


		if ($res)
		{
			$usersCount = $res->num_rows;
			if ($usersCount == 0)
			{
				echo("Никто не найден");
				return false;
			}

			if ($this->count == 1)
			{
				$user = new User(); 
				$user->SetFromDP($res->fetch_assoc());
				return $user;
			}
			else
			{
				for ($i = 0; $i < $usersCount; $i++)
				{
					$res->data_seek($i);
		    		$user = $res->fetch_assoc();

	    			$users[$i] = new User();
	    			$users[$i]->SetFromDB($user);
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
		if (isset($_GET['login'])) 
			{
				if ($_GET['login']) $this->login = $_GET['login'];
			}
		if (isset($_GET['firstName'])) 
			{
				if ($_GET['firstName']) $this->firstName = $_GET['firstName'];
			}
		if (isset($_GET['secondName'])) 
			{
				if ($_GET['secondName']) $this->secondName = $_GET['secondName'];
			}
		if (isset($_GET['rightsID'])) 
			{
				if ($_GET['rightsID']) $this->rightsID = $_GET['rightsID'];
			}
		if (isset($_GET['email'])) 
			{
				if ($_GET['email']) $this->sizeID = $_GET['email'];
			}
	}
}



?>