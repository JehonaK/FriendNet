<?php

	session_start();
	
	require_once "../includes/dbh.inc.php";

	$email = $_POST['email'];
	$password = $_POST['password_confirmation'];

	$sql = "SELECT * FROM user_table WHERE email = '$email'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

    if(empty($password) || empty($email)){
        header("Location: ../login.php?signin=empty-fields");
        exit();
    }

    $emailPattern = "/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/";
    if (@preg_match($emailPattern, $email) === false) {
        header("Location: ../login.php?signin=email-format-error");
        exit();
    }

	if($resultCheck == 1) {
		$row = mysqli_fetch_assoc($result);
		if(password_verify($password, $row['password'])) {
			$_SESSION['id'] = $row['id'];
			$u_id = $row['id'];
            $role = $row['role'];
            mysqli_close($conn);
            
            if($role == 2){
                header("Location: ../view-choosing.php");
            }else{
                header("Location: ../index.php?signin=successful");
            }
			
		} else {
			mysqli_close($conn);
			header("Location: ../login.php?signin=wrongpassword");
		}
		
	} else {
		mysqli_close($conn);
		header("Location: ../login.php?signin=failed");
	}
	exit();
