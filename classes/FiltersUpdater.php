<?php

require_once("classes/Color.php");
require_once("classes/Company.php");
require_once("classes/Sex.php");
require_once("classes/Size.php");
require_once("classes/category.php");

class Filters
{
	public $title,
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

		if (isset($_filters->priceMin)) $this->filters->priceMin = $_filters->priceMin;
		if (isset($_filters->priceMax)) $this->filters->priceMax = $_filters->priceMax;

		if (isset($_filters->categoryID)) $this->filters->categoryID = $_filters->categoryID;
		if (isset($_filters->sexIDsexID)) $this->filters->sexID = $_filters->sexID;
		if (isset($_filters->companyID)) $this->filters->companyID = $_filters->companyID;
		//if (isset($_filters->discount)) $this->filters->discount = $_filters->discount;

		if (isset($_filters->colorID)) $this->filters->colorID = $_filters->colorID;
		if (isset($_filters->sizeID)) $this->filters->sizeID = $_filters->sizeID;
	}



	public function GetFilters($_mysqli)
	{
		$multiCategory['colors'] = Color::GetWithFilters($this->filters, $_mysqli);
		$multiCategory['sizes'] = Size::GetWithFilters($this->filters, $_mysqli);

		$multiCategory['categories'] = Category::GetWithFilters($this->filters, $_mysqli);
		$multiCategory['companies'] = Company::GetWithFilters($this->filters, $_mysqli);

		$multiCategory['sex'] = Sex::GetWithFilters($this->filters, $_mysqli);

		return $multiCategory;
	}
}







?>