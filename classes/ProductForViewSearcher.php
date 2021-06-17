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
		$productsOnPage = 12;

	public function GetPagesAmountByFilters($_mysqli)
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
		
		$res = $_mysqli->query($request);

		if ($res) return $res->fetch_assoc()['COUNT(DISTINCT products_to_color_and_size.productID)'];
		else return $_mysqli->error;


	}

	public function SearchByFilters($_mysqli)
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
		

		$res = $_mysqli->query($request);
		
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
    			$ProductsForView[$i]->SetById($res->fetch_assoc()['productID'], $_mysqli);
			}
		}
		else 
		{
			$ProductsForView['status'] = false;
			$ProductsForView['message'] = $_mysqli->error;
		}		
		return $ProductsForView;
	}


	public function SetFiltersByJSON($_data)
	{
		if ($_data->title) $this->title = $_data->title;
		if ($_data->priceMin) $this->priceMin = $_data->priceMin;
		if ($_data->priceMax) $this->priceMax = $_data->priceMax;
		if ($_data->categoryID) $this->categoryID = $_data->categoryID;
		if ($_data->sexID) $this->sexID = $_data->sexID;
		if ($_data->companyID) $this->companyID = $_data->companyID;
		if ($_data->discount) $this->discount = $_data->discount;
		if ($_data->colorID) $this->colorID = $_data->colorID;
		if ($_data->sizeID) $this->sizeID = $_data->sizeID;
		if ($_data->page) $this->page = $_data->page;
		if ($_data->productsOnPage) $this->productsOnPage = $_data->productsOnPage;
	}
}
?>