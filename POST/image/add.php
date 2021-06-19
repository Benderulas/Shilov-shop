<?php

	$data = array();
 
	if( isset( $_FILES ) ){
	    $error = false;
	    $files = array();
	 
	    $uploaddir = 'images/'; // . - текущая папка где находится submit.php


	 
	    // Создадим папку если её нет
	 
	    if( ! is_dir( $uploaddir ) ) mkdir( $uploaddir, 0777 );
	 
	    // переместим файлы из временной директории в указанную
	    foreach( $_FILES as $file ){

	    	$cuttedName = $cuttedPath = explode('.', $file['name']);

	    	while (file_exists($uploaddir . $cuttedName[0] . "." . $cuttedName[1]))
	    	{
	    		$cuttedName[0] = $cuttedName[0] . random_int(0, 9);
	    	}
	    	$file['name'] = $cuttedName[0] . "." . $cuttedName[1];



	        if( move_uploaded_file( $file['tmp_name'], $uploaddir . basename($file['name']) ) ){
	            $path = '/' . $uploaddir . $file['name'];
	        }
	        else{
	            $error = true;
	        }
	    }
	 
	    $data = $error ? array('error' => 'Ошибка загрузки файлов.') : array('path' => $path);
	 
	    echo json_encode( $data );
	}

?>