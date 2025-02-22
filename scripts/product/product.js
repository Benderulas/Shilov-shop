import { POST_JSON_request } from "/JavaScript/requests.js";


function DeleteOptionsInSelectModule(_selectModuleid)
{
	let selectModule = document.getElementById(_selectModuleid);

	while (selectModule.options.length)
	{
		selectModule.remove(0);
	}
}


function SetColors(_colors, _selectedColorId = 0)
{
	let selectModule = document.getElementById("productColor");

	let option = document.createElement("option");
	option.value = "null";
	if (_selectedColorId == 0) option.selected = "selected";
	selectModule.add(option);


	for (let i = 0; i < _colors.length; i++)
	{
		option = document.createElement("option");
		option.value = _colors[i].id;
		option.text = _colors[i].title;
		if (_selectedColorId == option.value) option.selected = "selected";

		selectModule.add(option);
	}
}

function SetSizes(_sizes, _selectedSizeId = 0)
{
	
	let selectModule = document.getElementById("productSize");

	let option = document.createElement("option");
	option.value = "null";
	if (_selectedSizeId == 0) option.selected = "selected";
	selectModule.add(option);


	for (let i = 0; i < _sizes.length; i++)
	{
		option = document.createElement("option");
		option.value = _sizes[i].id;
		option.text = _sizes[i].title;
		if (_selectedSizeId == option.value) option.selected = "selected";

		selectModule.add(option);
	}

}

async function UpdateColors()
{
	let path = "POST/products/GetSearchFilters.php";
	let filters = {
		productID: Number(document.getElementById("productID").value),
		sizeID: Number(document.getElementById("productSize").value)
	}
	let response = await POST_JSON_request(path, filters);

	let selectedColorID = Number(document.getElementById("productColor").value);

	DeleteOptionsInSelectModule("productColor");
	SetColors(response['colors'], selectedColorID);
}

async function UpdateSizes()
{
	let path = "POST/products/GetSearchFilters.php";
	let filters = {
		productID: Number(document.getElementById("productID").value),
		colorID: Number(document.getElementById("productColor").value)
	}
	let response = await POST_JSON_request(path, filters);

	let selectedSizeID = Number(document.getElementById("productSize").value);

	DeleteOptionsInSelectModule("productSize");
	SetSizes(response['sizes'], selectedSizeID);
}


async function InitializeColorsAndSizes()
{
	let path = "POST/products/GetSearchFilters.php";
	let filters = {
		productID: Number(document.getElementById("productID").value)
	}
	let response = await POST_JSON_request(path, filters); 

	document.getElementById("productColor").onchange = UpdateSizes;
	document.getElementById("productSize").onchange = UpdateColors;



	SetColors(response['colors']);
	SetSizes(response['sizes']);
}

function IsProductInBasketCorrect(_productInBasket)
{
	if (isNaN(_productInBasket.productID)) 
	{
		alert ("Id is corrupted");
		return false
	}
	if (isNaN(_productInBasket.colorID)) 
	{
		alert ("Выберите цвет");
		return false
	}
	if (isNaN(_productInBasket.sizeID))
	{
		alert ("Выберите размер");
		return false
	}
	if (isNaN(_productInBasket.amount)) 
	{
		alert ("Укажите количество");
		return false
	}

	return true;
}


async function AddInBasket()
{
	let productInBasket = {
		productID: Number(document.getElementById("productID").value),
		colorID: Number(document.getElementById("productColor").value),
		sizeID: Number(document.getElementById("productSize").value),
		amount: Number(document.getElementById("productAmount").value)		
	}

	if (IsProductInBasketCorrect(productInBasket))
	{
		let path = "POST/basket/addProductInBasket.php";
		let response = await POST_JSON_request(path, productInBasket);

		//document.getElementById("productsInBasket").innerText = response['productsInBasket'];
	}
}

function Delete()
{
	console.log("delete");
}	

async function Initialize()
{
	let button = document.getElementById("addInBasket");
	if (button) button.onclick = AddInBasket;

	button = document.getElementById("delete");
	if (button) button.onclick = Delete;

	InitializeColorsAndSizes();	
}


Initialize();