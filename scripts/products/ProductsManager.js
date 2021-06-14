import { POST_JSON_request } from "/JavaScript/requests.js";

export class ProductsManager
{
	static async UpdateProducts(_filters)
	{

		let products = await this.GetProductsFromDB(_filters);


		for (let i = 0; i < 8; i++)
		{
			this.DeleteProduct(i);
		}

		for (let i = 0; products[i]; i++)
		{
			this.IncertProduct(products[i], i);
		}

		return Number(products['amount']);
	}

	static IncertProduct(_productForView, _position)
	{
		let product = document.getElementsByName("product")[_position];

		let title = product.firstElementChild;
		title.innerText = _productForView.product.title;

		let category = title.nextElementSibling;
		category.innerText = _productForView.product.category.title;

		let company = category.nextElementSibling;
		company.innerText = _productForView.product.company.title;

		let price = company.nextElementSibling;
		price.innerText = _productForView.product.price;

		let color = price.nextElementSibling;
		for (let i = 0; _productForView.productsToColorAndSize[i]; i++)
		{
			color.innerText = color.innerText + _productForView.productsToColorAndSize[i].color.title + " ";
			color.innerText = color.innerText + " ";
		}

		let size = color.nextElementSibling;
		for (let i = 0; _productForView.productsToColorAndSize[i]; i++)
		{
			size.innerText = size.innerText + _productForView.productsToColorAndSize[i].size.title + " ";
		}

	}

	static async GetProductsFromDB(_filters)
	{
		let path = "/POST/products/GetProductsWithFilters.php";

		let response = await POST_JSON_request(path, _filters); 

		return response; 

	}

	static DeleteProduct(_position)
	{
		let title = document.getElementsByName("title")[_position];
		let category = document.getElementsByName("category")[_position];
		let company = document.getElementsByName("company")[_position];
		let price = document.getElementsByName("price")[_position];
		let color = document.getElementsByName("color")[_position];
		let size = document.getElementsByName("size")[_position];

		
		title.innerText = " ";
		category.innerText = " ";
		company.innerText = " ";
		price.innerText = " ";
		color.innerText = " ";
		size.innerText = " ";

	}


}