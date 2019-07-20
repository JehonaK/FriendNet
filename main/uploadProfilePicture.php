<?php

	require '../main/controllers/UserController.php';

	$controller = new UserController;

	$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt');
	$path = 'uploads/'; // upload directory

	$img = $_FILES['image']['name'];
	$tmp = $_FILES['image']['tmp_name'];

	$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

	$final_image = rand(1000,1000000).$img;

	if(in_array($ext, $valid_extensions)) {
		$path = $path.strtolower($final_image); 
		if(move_uploaded_file($tmp,$path)) {
			$u_id = $_POST['u_id'];
			$controller->updateProfilePictureById($u_id, $path);
		}
	}
	
?>