import { POST_JSON_request } from "/JavaScript/requests.js";

async function fillOrderInformation()
{
	let productsInOrder = [];

	let basket = document.getElementsByName("amount");

	for (let i = 0; basket[i]; i++)
	{
		productsInOrder[i] = Number(basket[i].value);
	}

	let path = "POST/basket/updateAmounts.php";

	let response = await POST_JSON_request(path, productsInOrder);

	document.location = "#OrderForm"

}

async function CreateOrder()
{
	let newOrder = {
		firstName: document.getElementById("firstNameForOrder").value,
		secondName: document.getElementById("secondNameForOrder").value,
		deliveryCompanyID: document.getElementById("delivaryCompanyForOrder").value,
		phone: document.getElementById("phoneForOrder").value,
		country: document.getElementById("countryForOrder").value,
		city: document.getElementById("cityForOrder").value,
		address: document.getElementById("addressForOrder").value,
		index: document.getElementById("indexForOrder").value
	}

	let path = "POST/basket/createOrder.php";
	let response = await POST_JSON_request(path, newOrder);
}



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
			removeButtons[i].value = Number(removeButtons[i].value) - 1;			
		}

		this.parentElement.parentElement.removeChild(this.parentElement);
	}


}




function Initialize()
{
	let removeButtons = document.getElementsByName("removeProductFromBasket");

	for(let i = 0; i < removeButtons.length; i++)
	{
		if (removeButtons[i]) removeButtons[i].onclick = RemoveProductFromBasket;
	}

	let button = document.getElementById("fillOrderInformation");
	if (button) button.onclick = fillOrderInformation;

	button = document.getElementById("createOrder");
	if (button) button.onclick = CreateOrder;

	let selectItem = document.getElementById("delivaryCompanyForOrder")
	selectItem.onchange = function(){
		let postInformationBlock = document.getElementById("postInformarionForOrder");

		if (this.value == 1)postInformationBlock.hidden = "hidden";
		else postInformationBlock.hidden = "";
	}
}


Initialize();