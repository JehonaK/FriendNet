<?php
	
// if(isset($_POST['submit'])) {
	echo '<script>console.log("Your stuff here")</script>';
	header("Location: ../login.php?signin=wrongpassword");
	session_start();
	session_unset();
	session_destroy();
	exit();
// }	