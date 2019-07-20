<?php

	require '../main/controllers/PostController.php';

	$controller = new PostController;
	$u_id = $_POST['u_id'];
	$post_id = $_POST['post_id'];
	$comment_content = $_POST['comment_content'];

	$controller->addCommentByUserId($post_id, $u_id, $comment_content);

?>