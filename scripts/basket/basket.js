import { POST_JSON_request } from "/JavaScript/requests.js";





async function RemoveProductFromBasket()
{
	let number = Number(this.value);
	let path = "POST/basket/removeProductFromBasket.php";

	let response = await POST_JSON_request(path, number);

	if (response['status'] == true)
	{
		let removeButtons = document.getElementsByName("removeProductFromBasket");

		for (let i = number + 1; i < removeButtons.length; i++)
		{
			console.log(removeButtons[i]);
			removeButtons[i].value = Number(removeButtons[i].value) - 1;

			let productInBasket = document.getElementsByName("productInBasket")[number];

			productInBasket.parentElement.removeChild(productInBasket);

			document.getElementById("productsInBasket").innerText = response['productsInBasket'];
		}
	}


}



function Initialize()
{
	let removeButtons = document.getElementsByName("removeProductFromBasket");

	for(let i = 0; i < removeButtons.length; i++)
	{
		removeButtons[i].onclick = RemoveProductFromBasket;
	}
}


Initialize();