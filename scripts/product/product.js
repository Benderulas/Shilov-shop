

function SaveChanges()
{
	console.log("save");
}

function Edit()
{
	console.log("edit");
}

function Delete()
{
	console.log("delete");
}	

function Initialize()
{
	let button = document.getElementById("edit");
	//if (button) button.onclick = Edit;

	button = document.getElementById("saveChanges");
	if (button) button.onclick = SaveChanges;

	button = document.getElementById("delete");
	if (button) button.onclick = Delete;
}


Initialize();