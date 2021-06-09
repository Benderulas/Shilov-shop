<?php
	



class News
{
	public $id;
	public $title;
	public $text;
	public $immage;



	public function SetByPOST($_news)
	{
		if (isset($_news['id'])) $this->id = $_news['id'];
		$this->title = $_news['title]'];
		$this->text = $_news['text'];
		$this->immage = $_news['immage'];
	}

	public function SetFromDB($_news)
	{
		$this->id = $_news['id'];
		$this->title = $_news['title'];
		$this->text = $_news['text'];
		$this->immage = $_news['immage'];
	}

	public function DoesNewsExist()
	{
		require("bd.php");
		if ($res = $mysqli->query("SELECT COUNT(*) as count FROM news WHERE id = $this->id"))
		{
			$res = $res->fetch_assoc();
			if ($res['count']) return true;
			else return false;
		}
		else 
		{
			echo ("IsNewsExist request error");
			return false;
		}
	}

	public function Insert()
	{
		require("bd.php");

		$res = $mysqli->query("INSERT INTO news (title, text, immage) "
				. "VALUES ('$this->title', '$this->text', '$this->immage')");

		return $res;
	}

	public function Edit()
	{
		require("bd.php");

		$request = "UPDATE news SET "
				 . "title = '$this->title', "
				 . "text = '$this->text', "
				 . "immage = '$this->immage' "
				 . "WHERE id = $this->id";
		$res = $mysqli->query($request);
		return $res;
	}

	public static function Delete($_id)
	{
		require("bd.php");
		$res = $mysqli->query("DELETE FROM news WHERE id = $_id");

		return $res;
	}
}







?>