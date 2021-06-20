import { POST_JSON_request } from "/JavaScript/requests.js";

async function GetSelectsFromDb()
{
	let path = "POST/product/GetMultiCategories.php";

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

async function AploadImage()
{
	let data = new FormData();
	data.append (0, document.getElementById("productImage").files[0]);

	let response = await $.ajax({
        url: '/POST/image/add.php',
        type: 'POST',
        data: data,
        cache: false,
        dataType: 'json',
        processData: false, // Не обрабатываем файлы (Don't process the files)
        contentType: false, // Так jQuery скажет серверу что это строковой запрос
        success: function( respond, textStatus, jqXHR ){
 
            // Если все ОК
 
            if( typeof respond.error === 'undefined' ){
                // Файлы успешно загружены, делаем что нибудь здесь
 
                // выведем пути к загруженным файлам в блок '.ajax-respond'
 
                var files_path = respond.files;
                var html = '';
                $.each( files_path, function( key, val ){ html += val +'<br>'; } )
                $('.ajax-respond').html( html );
            }
            else{
                console.log('ОШИБКИ ОТВЕТА сервера: ' + respond.error );
            }
        },
        error: function( jqXHR, textStatus, errorThrown ){
            console.log('ОШИБКИ AJAX запроса: ' + textStatus );
        }
    });

    return response['path'];
}


async function InsertProduct()
{
	let product = {
		image: await AploadImage(),
		title: document.getElementById("productTitle").value,
		price: Number(document.getElementById("productPrice").value),
		discount: Number(document.getElementById("productDiscount").value),
		categoryID: Number(document.getElementById("productCategory").value),
		companyID: Number(document.getElementById("productCompany").value),
		sexID: Number(document.getElementById("productSex").value),
		colorsAndSizes: []
	};

	let colorAndSize;

	for (let i = 0; i < document.getElementsByName("productColor").length; i++)
	{
		colorAndSize = {
			colorID: Number(document.getElementsByName("productColor")[i].value),
			sizeID: Number(document.getElementsByName("productSize")[i].value),
			amount: Number(document.getElementsByName("productAmount")[i].value)
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
	
	let colorsAndSizes = document.getElementById("productColorsAndSizes");
	let div = document.createElement("div");

	let colorSelectItem = document.createElement("select");
	colorSelectItem.name = "productColor";

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
	sizeSelecctItem.name = "productSize";

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
	amountItem.name = "productAmount";


	let deleteButton = document.createElement("button");
	deleteButton.onclick = DeleteColorAndSizeField;
	deleteButton.innerText = "Удалить";




	div.appendChild(colorSelectItem);
	div.appendChild(sizeSelecctItem);
	div.appendChild(amountItem);
	div.appendChild(deleteButton);



	colorsAndSizes.appendChild(div);
}

function DeleteColorAndSizeField()
{
	let colorsAndSizes = document.getElementById("productColorsAndSizes");
	this.parentNode.parentNode.removeChild(this.parentNode);
}

function InitializeCategories(_categories)
{
	let selectItem = document.getElementById("productCategory");

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
	let selectItem = document.getElementById("productCompany");

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
	let selectItem = document.getElementById("productSex");

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
	if (button) button.onclick = InsertProduct;

	button = document.getElementById("addColorAndSize");
	if (button)button.onclick = AddColorAndSizeField;

	InitializeSelects();

}


Initialize();