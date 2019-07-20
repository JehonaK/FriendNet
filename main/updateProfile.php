<?php

	require '../main/controllers/UserController.php';

	$controller = new UserController;
	$u_id = $_POST['u_id'];
	$firstname = $_POST['firstname'];
	$surname = $_POST['surname'];
	$bio = $_POST['bio'];
	$location = $_POST['location'];

	$controller->updateProfileByUserId($firstname, $surname, $bio, $location, $u_id);

?>