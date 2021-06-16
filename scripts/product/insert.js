import { POST_JSON_request } from "/JavaScript/requests.js";

async function GetSelectsFromDb()
{
	let path = "POST/products/GetSearchFilters.php";

	let response = await POST_JSON_request(path); 

	return response;
}
function isProductReady(_product)
{
	if (_product.title == false) 
	{
		alert("Укажите название товара");
		return false;
	}
	if (_product.price == false) 
	{
		alert("Укажите цену товара");
		return false;
	}
	if (Number.isInteger(_product.price) == false) 
	{
		alert("Укажите цену товара правильно");
		return false;
	}
	if (Number.isInteger(_product.discount) == false) 
	{
		alert("Укажите скидку на товар правильно");
		return false;
	}
	if (_product.categoryID == "null") 
	{
		alert("Укажите категорию товара");
		return false;
	}
	if (_product.companyID == "null") 
	{
		alert("Укажите команию товара");
		return false;
	}
	if (_product.sexID == "null") 
	{
		alert("Укажите для какого пола товар");
		return false;
	}
	if (_product.colorsAndSizes.length == 0)
	{
		alert("Укажите хотя бы 1 пару цвет - размер");
		return false;
	}

	for (let i in _product.colorsAndSizes)
	{
		if (_product.colorsAndSizes[i].colorID == "null")
		{
			alert("Укажите цвет в паре " + (Number(i) + 1));
			return false;
		}
		if (_product.colorsAndSizes[i].sizeID == "null")
		{
			alert("Укажите размер в паре " + (Number(i) + 1));
			return false;
		}
		if (_product.colorsAndSizes[i].amount == false)
		{
			alert("Укажите количество в паре " + (Number(i) + 1));
			return false;
		}
		if (Number.isInteger(_product.colorsAndSizes[i].amount) == false) 
		{
			alert("Укажите количество товара в паре " + (Number(i) + 1) + " правильно");
			return false;
		}
	}



	return true;

}


async function InsertProduct()
{
	console.log("AddProduct");

	let product = {
		title: document.getElementById("title").value,
		price: Number(document.getElementById("price").value),
		discount: Number(document.getElementById("discount").value),
		categoryID: Number(document.getElementById("category").value),
		companyID: Number(document.getElementById("company").value),
		sexID: Number(document.getElementById("sex").value),
		colorsAndSizes: []
	};

	let colorAndSize;

	for (let i = 0; i < document.getElementsByName("color").length; i++)
	{
		colorAndSize = {
			colorID: Number(document.getElementsByName("color")[i].value),
			sizeID: Number(document.getElementsByName("size")[i].value),
			amount: Number(document.getElementsByName("amount")[i].value)
			};
		product.colorsAndSizes.push(colorAndSize);
	}


	if (isProductReady(product)) 
	{
		let path = "POST/product/insertProductForView.php";
		let response = await POST_JSON_request(path, product);
		alert (response['message']);
	}
}

async function AddColorAndSizeField()
{
	let response = await GetSelectsFromDb();
	
	let colorsAndSizes = document.getElementById("colorsAndSizes");
	let label = document.createElement("label");
	let text = document.createTextNode("1 ");

	label.appendChild(text);

	let colorSelectItem = document.createElement("select");
	colorSelectItem.name = "color";

	let option = document.createElement("option");
	option.value = 'null';
	option.selected = "selected";
	colorSelectItem.add(option);

	for (let i in response['colors'])
	{
		option = document.createElement("option");
		option.text = response['colors'][i].title;
		option.value = response['colors'][i].id;

		colorSelectItem.add(option);
	}

	let sizeSelecctItem = document.createElement("select");
	sizeSelecctItem.name = "size";

	option = document.createElement("option");
	option.value = 'null';
	option.selected = "selected";
	sizeSelecctItem.add(option);

	for (let i in response['sizes'])
	{
		option = document.createElement("option");
		option.text = response['sizes'][i].title;
		option.value = response['sizes'][i].id;

		sizeSelecctItem.add(option);
	}

	let amountItem = document.createElement("input");
	amountItem.type = "text";
	amountItem.name = "amount";



	label.appendChild(colorSelectItem);
	label.appendChild(sizeSelecctItem);
	label.appendChild(amountItem);



	colorsAndSizes.appendChild(label);
	let brItem = document.createElement("br");
	colorsAndSizes.appendChild(brItem);
}

function DeleteColorAndSizeField()
{
	let colorsAndSizes = document.getElementById("colorsAndSizes");
	let lastElement = colorsAndSizes.lastChild;

	colorsAndSizes.removeChild(lastElement);
	lastElement = colorsAndSizes.lastChild;
	colorsAndSizes.removeChild(lastElement);
}

function InitializeCategories(_categories)
{
	let selectItem = document.getElementById("category");

	let option = document.createElement("option");
	option.value = 'null';
	option.selected = "selected";
	selectItem.add(option);

	for (let i in _categories)
	{
		option = document.createElement("option");
		option.text = _categories[i].title;
		option.value = _categories[i].id;

		selectItem.add(option);
	}
}

function InitializeCompanies(_companies)
{
	let selectItem = document.getElementById("company");

	let option = document.createElement("option");
	option.value = 'null';
	option.selected = "selected";
	selectItem.add(option);

	for (let i in _companies)
	{
		option = document.createElement("option");
		option.text = _companies[i].title;
		option.value = _companies[i].id;

		selectItem.add(option);
	}
}

function InitializeSex(_sex)
{
	let selectItem = document.getElementById("sex");

	let option = document.createElement("option");
	option.value = 'null';
	option.selected = "selected";
	selectItem.add(option);

	for (let i in _sex)
	{
		option = document.createElement("option");
		option.text = _sex[i].title;
		option.value = _sex[i].id;

		selectItem.add(option);
	}
}




async function InitializeSelects()
{
	let response = await GetSelectsFromDb();
	
	InitializeCategories(response['categories']);
	InitializeCompanies(response['companies']);
	InitializeSex(response['sex']);
}




function Initialize()
{
	let button = document.getElementById("addProduct");
	button.onclick = InsertProduct;

	button = document.getElementById("addColorAndSize");
	button.onclick = AddColorAndSizeField;

	button = document.getElementById("deleteColorAndSize");
	button.onclick = DeleteColorAndSizeField;

	InitializeSelects();

}


Initialize();