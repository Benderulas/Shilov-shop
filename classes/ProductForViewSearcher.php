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

	public function GetPagesAmountByFilters()
	{
		$request = "SELECT COUNT(DISTINCT products_to_color_and_size.productID) "
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
        if (isset($this->sizeID)) $request = $request . "AND products_to_color_and_size.sizeID = $this->sizeID";
		

		require("DataBase.php");
		$res = $mysqli->query($request);

		if ($res) return $res->fetch_assoc()['COUNT(DISTINCT products_to_color_and_size.productID)'];
		else return $mysqli->error;


	}

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
				
				$ProductsForView['status'] = true;
    			$ProductsForView[$i] = new ProductForView();
    			$ProductsForView[$i]->SetById($res->fetch_assoc()['productID']);
			}
		}
		else 
		{
			$ProductsForView['status'] = false;
			$ProductsForView['message'] = $mysqli->error;
		}		
		return $ProductsForView;
	}


	public function SetFiltersByJSON($_data)
	{
		if (isset($_data->title) && $_data->title != 'null') $this->title = $_data->title;
		if (isset($_data->priceMin) && $_data->priceMin != 'null') $this->priceMin = $_data->priceMin;
		if (isset($_data->priceMax) && $_data->priceMax != 'null') $this->priceMax = $_data->priceMax;
		if (isset($_data->categoryID) && $_data->categoryID != 'null') $this->categoryID = $_data->categoryID;
		if (isset($_data->sexID) && $_data->sexID != 'null') $this->sexID = $_data->sexID;
		if (isset($_data->companyID) && $_data->companyID != 'null') $this->companyID = $_data->companyID;
		if (isset($_data->discount) && $_data->discount != 'null') $this->discount = $_data->discount;
		if (isset($_data->colorID) && $_data->colorID != 'null') $this->colorID = $_data->colorID;
		if (isset($_data->sizeID) && $_data->sizeID != 'null') $this->sizeID = $_data->sizeID;
		if (isset($_data->page) && $_data->page != 'null') $this->page = $_data->page;
		if (isset($_data->productsOnPage) && $_data->productsOnPage != 'null') $this->productsOnPage = $_data->productsOnPage;
	}
}
?>