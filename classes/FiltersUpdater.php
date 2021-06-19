<?php

require_once("classes/Color.php");
require_once("classes/Company.php");
require_once("classes/Sex.php");
require_once("classes/Size.php");
require_once("classes/Category.php");

class Filters
{
	public $productID,
		$title,
		$priceMin,
		$priceMax,

		$categoryID,
		$sexID,
		$companyID,
		$discount,

		$colorID,
		$sizeID;
}

class FiltersUpdater
{
	public $filters;

	function __construct()
	{
		$this->filters = new Filters();
	}



	public function SetByJSON($_filters)
	{
		//if (isset($_filters->title)) $this->filters->title = $_filters->title;
		if ($_filters->productID) $this->filters->productID = $_filters->productID;

		if ($_filters->priceMin) $this->filters->priceMin = $_filters->priceMin;
		if ($_filters->priceMax) $this->filters->priceMax = $_filters->priceMax;

		if ($_filters->categoryID) $this->filters->categoryID = $_filters->categoryID;
		if ($_filters->sexIDsexID) $this->filters->sexID = $_filters->sexID;
		if ($_filters->companyID) $this->filters->companyID = $_filters->companyID;
		if ($_filters->sexID) $this->filters->sexID = $_filters->sexID;
		//if (isset($_filters->discount)) $this->filters->discount = $_filters->discount;

		if ($_filters->colorID) $this->filters->colorID = $_filters->colorID;
		if ($_filters->sizeID) $this->filters->sizeID = $_filters->sizeID;
	}



	public function GetFilters($_mysqli)
	{
		$filters['colors'] = Color::GetWithFilters($this->filters, $_mysqli);
		$filters['sizes'] = Size::GetWithFilters($this->filters, $_mysqli);

		$filters['companies'] = Company::GetWithFilters($this->filters, $_mysqli);
		$filters['categories'] = Category::GetWithFilters($this->filters, $_mysqli);
		$filters['sex'] = Sex::GetWithFilters($this->filters, $_mysqli);

		return $filters;
	}

	public function GetCategories($_mysqli)
	{
		$categories['categories'] = Category::GetWithFilters($this->filters, $_mysqli);

		return $categories['categories'];
	}
}







?>