<?php

	require '../main/controllers/UserController.php';

	$controller = new UserController;
	$userID = $_POST['userID'];

    $controller->dislikeAllUserPostsByUserId($userID);
    $controller->deleteAllUserPostsByUserId($userID);
    $controller->unfollowAllUsersByUserId($userID);
    $controller->getUnfollowedByAllUsersByUserId($userID);
    $controller->deleteUserById($userID);
?>