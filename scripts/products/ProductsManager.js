import { POST_JSON_request } from "/JavaScript/requests.js";

export class ProductsManager
{
	static async UpdateProducts(_filters)
	{

		let products = await this.GetProductsFromDB(_filters);

		this.DeleteProducts();

		for (let i = 0; typeof products[i] !== 'undefined'; i++)
		{
			this.IncertProduct(products[i], i);
		}

		return Number(products['totalAmount']);
	}

	static async IncertProduct(_productForView, _position)
	{
		$('<div></div>', {
			class: 'product',
			click: function() {
				let url = new URL ("http://shilov-shop/product");

				url.searchParams.set("id", _productForView.product.id);
				console.log(url);

				window.location.href = url;
			}
		}).appendTo('div.products');

		let product = $('div.product').last();

		console.log(product);


		

		$('<div></div>', {
			class: 'product-image'
		}).appendTo(product);

		$("<img></img>", {
			src: "",
			alt: ""
		}).appendTo(product.find('div.product-image'));


		$('<p></p>', {
			class: 'product-id',
			text: _productForView.product.id,
			hidden: "hidden"
		}).appendTo(product);

		$('<p></p>', {
			class: 'product-title',
			text: _productForView.product.title
		}).appendTo(product);

		$('<p></p>', {
			class: 'product-price',
			text: _productForView.product.price
		}).appendTo(product);
	}

	static async GetProductsFromDB(_filters)
	{
		let path = "POST/products/GetProductsWithFilters.php";

		return POST_JSON_request(path, _filters); 
	}

	static DeleteProducts(_position)
	{
		$('div.product').each(function() {
			$(this).remove();
		});
	}


}