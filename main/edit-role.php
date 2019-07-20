<?php

	require '../main/controllers/UserController.php';

	$controller = new UserController;
	$userID = $_POST['userID'];
    $roleID = $_POST['roleID'];

    $controller->changeUserRoleByUserId($userID, $roleID);
?>