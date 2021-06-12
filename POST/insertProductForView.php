<?php

	require_once("classes/ProductForView.php")


	if ($user->rights->level == 10)
	{
		$newProductForView = new ProductForView();
		
		$newProductForView->SetByPOST();

		$exception = $newProductForView->Insert();
	}
	else $exception = "You don't have permissions to do that";



?>