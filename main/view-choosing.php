<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Log In</title>
	<link rel="stylesheet" type="text/css" href="styles/admin.css">
</head>
<body>
    <?php
        if(!isset($_SESSION['id'])) {
				header("Location: ./login.php");
        }
    ?>
	<div class="container">
			<div id = "choosing-box">
				<b>Choose your login purpose:</b><br>
                <div id = "choosing-options">
                    <a href = "admin.php"><button value = "">Admin</button></a>
                    <a href = "index.php?signin=successful"><button value = "">User</button></a>
                </div>
            </div>
	</div>
</body>
</html>