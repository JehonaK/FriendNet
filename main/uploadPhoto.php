<?php

	require '../main/controllers/PostController.php';

	$controller = new PostController;

	$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt');
	$path = 'uploads/'; // upload directory

	$img = $_FILES['image']['name'];
	$tmp = $_FILES['image']['tmp_name'];

	$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
	$final_image = rand(1000,1000000).$img;

	if(in_array($ext, $valid_extensions)) {
		$path = $path.strtolower($final_image); 
		if(move_uploaded_file($tmp,$path)) {
			$content = $_POST['content'];
			$u_id = $_POST['u_id'];
			$hashTag = $_POST['hashTag'];
			$controller->addNewPostByUserId($u_id, $path, $content);
			$postId = $controller->getLastPostIdByUserId($u_id);
			$controller->addNewHashtagByUserPostId($postId, $hashTag);
		}
	} 
?>