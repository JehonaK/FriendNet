<?php

	require '../main/controllers/PostController.php';

	$controller = new PostController;
	$postID = $_POST['postID'];
	$userID = $_POST['userID'];

	$isLikedNow = $controller->likePhotoById($postID, $userID);
	if($isLikedNow) {
		echo json_encode(array('success' => 1));
	} else {
		echo json_encode(array('success' => 0));
	}