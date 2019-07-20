<?php

	require_once "../includes/dbh.inc.php";

	$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt');
	$path = 'uploads/';
	$img = $_FILES['image']['name'];
	$tmp = $_FILES['image']['tmp_name'];

	$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

	$final_image = rand(1000,1000000).$img;

	if(in_array($ext, $valid_extensions)) { 
		$path = $path.strtolower($final_image); 
		if(move_uploaded_file($tmp,$path)) {
			echo "<img src='$path' />";
			
			$insert = $db->query("INSERT uploading (name,email,file_name) VALUES ('".$name."','".$email."','".$path."')");
			//echo $insert?'ok':'err';
		}
	} else {
		echo 'invalid';
	}

?>