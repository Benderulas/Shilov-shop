<?php

require_once("classes/User.php");
require_once("classes/Rights.php");

$userProfile = new User();
$userProfile->SetById($_GET['userID'], $mysqli);

$rights = new Rights();
$rights = $rights->GetAllFromDB($mysqli);


function SetRightsLevel($_user, $_userProfile, $_rights)
{
	if($_user->rights->level == 10) 
	{
		echo("<select id='userLevel'>");

		foreach($_rights as $rightsLevel)
		{
			echo ("<option value='$rightsLevel->id'");
			if ($_userProfile->rights->id == $rightsLevel->id) echo(" selected='selected'");

			echo(">$rightsLevel->title</option>");
		}
		echo("</select>");
	}

	else 
	{
		echo("<select id='userLevel'>");

		echo ("<option value='" . $_userProfile->rights->id . "'");
		echo(" selected='selected'");

		echo(">" . $_userProfile->rights->title . "</option>");
		echo("</select>");
	}
}

?>