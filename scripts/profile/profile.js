import { User } from "/scripts/profile/User.js";

function EditUser()
{
	User.EditUser();
}

function Initialize()
{
	let button = document.getElementById("editUser");
	if (button)	button.onclick = EditUser;

	button = document.getElementById("deleteUser");
	if (button)	button.onclick = User.DeleteUser;
}

Initialize();