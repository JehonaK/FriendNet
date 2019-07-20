<?php

if(isset($_POST['signup-submit'])) {

	include_once "../includes/dbh.inc.php";

	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$email = $_POST['email'];
	$birth_date = $_POST['birth-date'];
	$gender = 'n';
	if(isset($_POST['gender'])) {
		if($_POST['gender'] == 'male') {
			$gender = 'm';
		} else {
			$gender = 'f';
		}
	}
	$username = $_POST['username'];
	$password = $_POST['password_confirmation'];
	$hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
	$curdate = "2017-01-01";
	$birthplace = "nolocation";
	$profile = "noprofile";

	if(empty($name) || empty($surname) || empty($email) || empty($birth_date) || empty($gender) || empty($password)) {
		header("Location: ../signup.php?registered=empty-fields");
		exit();
	}
     
    $date = date_create($birth_date);
    $newDate = date_format($date, "Y-d-m");
	$nullvar = "null";
	// $thedate = "2012-10-10";
	$thedate = $newDate;

	$sql = "INSERT INTO user_table (name, surname, email, password, username, gender, birthday, birthplace, profile_pic) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $sql);
	
	mysqli_stmt_bind_param($stmt, "sssssssss", $name, $surname, $email, $hashed_pwd, $username, $gender, $thedate, $birthplace, $profile);
	mysqli_stmt_execute($stmt);

	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	header("Location: ../login.php?registered=success");
	exit();
} else {
	header("Location: ../signup.php?registered=fail");
	exit();
}


