<?php

require("Product.php");

class ProductSearcher
{
	public $title = '';
	public $colorID = false;
	public $priceMin = 0;
	public $priceMax = 1000000;
	public $sizeID = false;
	public $categoryID = false;
	public $companyID = false;
	public $sexID = false;
	public $page = 1;
	public $productsOnPage = 8;
	

	public function SearchProductsInBD()
	{
		$request = "SELECT "
			. "products.id, "
			. "products.title, "
			. "products.price, "
			. "products.discount, "
			. "products.immage, "

			. "products.colorID, "
			. "products.sizeID, "
			. "products.categoryID, "
			. "products.companyID, "
			. "products.sexID, "
			
            . "categories.title AS categoryTitle, "
            . "colors.title AS colorTitle, "
            . "sizes.title AS sizeTitle, "
            . "sizes.number AS sizeNumber, "
            . "companies.title AS companyTitle, "
            . "sex.title AS sexTitle "

            . "FROM products "

            . "INNER JOIN categories ON products.categoryID = categories.id "
            . "INNER JOIN colors ON products.colorID = colors.id "       
            . "INNER JOIN sizes ON products.sizeID = sizes.id "
            . "INNER JOIN companies ON products.companyID = companies.id "
            . "INNER JOIN sex ON products.sexID = sex.id "

            . "WHERE products.title LIKE '%$this->title%' "
            . "AND products.price < $this->priceMax "
            . "AND products.price > $this->priceMin ";

        if ($this->colorID) $request = $request . "AND products.colorID = $this->colorID ";
        if ($this->sizeID) $request = $request . "AND products.sizeID = $this->sizeID ";
        if ($this->categoryID) $request = $request . "AND products.categoryID = $this->categoryID ";
        if ($this->companyID) $request = $request . "AND products.companyID = $this->companyID ";
        if ($this->sexID) $request = $request . "AND products.sexID = $this->sexID ";


        $request = $request
        	. "ORDER BY products.id "
            . "LIMIT $this->productsOnPage "
            . "OFFSET " . ($this->page - 1) * $this->productsOnPage;
		

		require("bd.php");
		$res = $mysqli->query($request);
		
		if ($res) $productsCount = $res->num_rows;
		else $productsCount = 0;

		$products = false;



		if ($res)
		{
			for ($i = 0; $i < $productsCount; $i++)
			{
				$res->data_seek($i);
	    		$product = $res->fetch_assoc();

    			$products[$i] = new Product();
    			$products[$i]->SetFromDB($product);
			}
		}
		else 
		{
			echo("Ошибка запроса");
		}		
		return $products;
	}

	public function SetFiltersByGET()
	{
		if (isset($_GET['title'])) 
			{
				if ($_GET['title']) $this->title = $_GET['title'];
			}
		if (isset($_GET['colorID'])) 
			{
				if ($_GET['colorID']) $this->colorID = $_GET['colorID'];
			}
		if (isset($_GET['priceMin'])) 
			{
				if ($_GET['priceMin']) $this->priceMin = $_GET['priceMin'];
			}
		if (isset($_GET['priceMax'])) 
			{
				if ($_GET['priceMax']) $this->priceMax = $_GET['priceMax'];
			}
		if (isset($_GET['sizeID'])) 
			{
				if ($_GET['sizeID']) $this->sizeID = $_GET['sizeID'];
			}
		if (isset($_GET['categoryID'])) 
			{
				if ($_GET['categoryID']) $this->categoryID = $_GET['categoryID'];
			}
		if (isset($_GET['companyID'])) 
			{
				if ($_GET['companyID']) $this->companyID = $_GET['companyID'];
			}
		if (isset($_GET['page'])) 
			{
				if ($_GET['page']) $this->page = $_GET['page'];
			}
		if (isset($_GET['productsCount'])) 
			{
				if ($_GET['productsCount']) $this->productsCount = $_GET['productsCount'];
			}
		if (isset($_GET['sexID'])) 
			{
				if ($_GET['sexID']) $this->sexID = $_GET['sexID'];
			}
	}
}
?>