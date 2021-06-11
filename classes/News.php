<?php

require_once("MultiCategory.php");

class News extends MultiCategory
{
	public $text,
		$img;

	public const tableName = 'news';

	public function Set($_news)
	{
		if (isset($_news['id'])) $this->id = $_news['id'];
		if (isset($_news['text'])) $this->text = $_news['text'];
		if (isset($_news['img'])) $this->img = $_news['img'];
		$this->title = $_news['title'];
	}

	public function Insert()
	{
		require("DataBase.php");

		if ($this->Exist() == false)
		{
			$request = "INSERT INTO " . static::tableName . " (title, img, text) "
				. "VALUES ('$this->title', '$this->img', '$this->text')";

			$res = $mysqli->query($request);
			return $res;
		}
		else return false;
	}

	public function Edit()
	{
		require("DataBase.php");

		$request = "UPDATE " . static::tableName . " SET "
				 . "title = '$this->title' "
				 . "img = '$this->img' "
				 . "text = '$this->text' "
				 . "WHERE id = $this->id";

		$res = $mysqli->query($request);
		return $res;
	}

}


?>