<?php

	require '../main/controllers/PostController.php';

	$controller = new PostController;
	$postId = $_GET['post_id'];

	$comments = $controller->getAllCommentsByPostId($postId);

?>