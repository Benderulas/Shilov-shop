import { POST_JSON_request } from "/JavaScript/requests.js";


export class User
{
	static GetUserInfoFromPage()
	{
		let user = {
			id: document.getElementById("userID").value,
			login: document.getElementById("userLogin").value,
			password: document.getElementById("userPassword").value,
			email: document.getElementById("userEmail").value,
			firstName: document.getElementById("userFirstName").value,
			secondName: document.getElementById("userSecondName").value,
			phone: document.getElementById("userPhone").value,
			rightsID: document.getElementById("userLevel").value
		}

		return user;
	}

	static async EditUser()
	{
		let user = this.GetUserInfoFromPage();
		let path = "POST/user/edit.php";

		let response = await POST_JSON_request(path, user);

		console.log(response);
	}

	static async DeleteUser()
	{
		console.log("DeleteUser");
	}


}