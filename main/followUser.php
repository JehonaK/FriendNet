<?php

	require '../main/controllers/UserController.php';

	$controller = new UserController;
	$followedId = $_POST['followedId'];
	$followerId = $_POST['followerId'];

	$controller->followUserById($followedId, $followerId);

?>