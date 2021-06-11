<?php

require_once("Searcher.php");
require_once("ProductForView.php");
require_once("Product.php");
require_once("ProductToColorAndSize.php");

class ProductForViewSearcher extends Searcher
{
	public $title,
		$priceMin,
		$priceMax,
		$categoryID,
		$sexID,
		$companyID,
		$discount,

		$colorID,
		$sizeID,

		$page = 1,
		$productsOnPage = 8;



	public function SearchByFilters()
	{
		$request = "SELECT DISTINCT products_to_color_and_size.productID as productID "
            . "FROM " . ProductToColorAndSize::tableName . " "

            . "INNER JOIN " . Product::tableName . " ON products_to_color_and_size.productID = products.id "
            . "WHERE 1 ";

        if (isset($this->title)) $request = $request . "AND products.title LIKE '%$this->title%' ";

        if (isset($this->priceMax)) $request = $request . "AND products.price < $this->priceMax ";
        if (isset($this->priceMin)) $request = $request . "AND products.price > $this->priceMin ";

        if (isset($this->categoryID)) $request = $request . "AND products.categoryID = $this->categoryID ";
        if (isset($this->companyID)) $request = $request . "AND products.companyID = $this->companyID ";
        if (isset($this->sexID)) $request = $request . "AND products.sexID = $this->sexID ";
        if (isset($this->discount)) $request = $request . "AND products.discount = $this->discount ";

        if (isset($this->colorID)) $request = $request . "AND products_to_color_and_size.colorID = $this->colorID ";
        if (isset($this->sizeID)) $request = $request . "AND products_to_color_and_size.sizeID = $this->sizeID ";


        $request = $request
        	. "ORDER BY products_to_color_and_size.productID "
            . "LIMIT $this->productsOnPage "
            . "OFFSET " . ($this->page - 1) * $this->productsOnPage;
		

		require("DataBase.php");
		$res = $mysqli->query($request);
		
		if ($res) $productsCount = $res->num_rows;
		else $productsCount = 0;

		$ProductsForView = false;

		if ($res)
		{
			$Ids = $res->fetch_assoc();
			for ($i = 0; $i < $productsCount; $i++)
			{
				$res->data_seek($i);
				
    			$ProductsForView[$i] = new ProductForView();
    			$ProductsForView[$i]->SetById($res->fetch_assoc()['productID']);
			}
		}
		else 
		{
			echo("Ошибка запроса");
		}		
		return $ProductsForView;
	}


	public function SetFiltersByGET()
	{
		if (isset($_GET['title'])) $this->title = $_GET['title'];
		if (isset($_GET['priceMin'])) $this->title = $_GET['priceMin'];
		if (isset($_GET['priceMax'])) $this->title = $_GET['priceMax'];
		if (isset($_GET['categoryID'])) $this->title = $_GET['categoryID'];
		if (isset($_GET['sexID'])) $this->title = $_GET['sexID'];
		if (isset($_GET['companyID'])) $this->title = $_GET['companyID'];
		if (isset($_GET['discount'])) $this->title = $_GET['discount'];
		if (isset($_GET['colorID'])) $this->title = $_GET['colorID'];
		if (isset($_GET['sizeID'])) $this->title = $_GET['sizeID'];
		if (isset($_GET['page'])) $this->title = $_GET['page'];
		if (isset($_GET['productsOnPage'])) $this->title = $_GET['productsOnPage'];
	}
}
?>