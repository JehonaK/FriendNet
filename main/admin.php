<?php
    session_start();
    require "controllers/UserController.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<link rel="stylesheet" type="text/css" href="styles/admin.css">
    <script type="text/javascript" src="../main/scripts/jquery.js"></script>
    <script type="text/javascript" src="scripts/admin.js"></script>
</head>
<body>
    <?php
        if(!isset($_SESSION['id'])) {
				header("Location: ./friendnet.html");
        }
        $userController = new UserController;
        $users = $userController->findAll();
    ?>
	<div class="container">
        <div id = "user-box">
            <div class = "header">
                <h3>EDIT USER DATA</h3>
                <form>
                    <input type = "text" placeholder = "Search" id="myInput" onkeyup="search()">
                </form>
            </div>
            <table class="table" id="myTable">
                <thead>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </thead>
                <tbody>
        <?php foreach($users as $user): ?>
            <?php $role;
                if($user['role'] == 1){
                    $role = "USER";
                }else{
                    $role = "ADMIN";
                }
                    
            ?>
          <tr>
            <td><?php echo $user['name']; ?></td>
            <td><?php echo $user['surname']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td style = "text-align:center;"><?php echo $role; ?></td>
            <td id="butonat">
                <?php
                    $id = $user['id'];
                    echo("<button onclick=\"show_prompt($id)\" id=editButton>Edit Role</button>");
                    echo("<button onclick=\"deleteUser($id)\" id=deleteButton>Delete</button>");
                ?>
            </td>
          </tr>
        <?php endforeach; ?>
                    </tbody>
      </table>
            <div class = "return">
            <a href="view-choosing.php"><button style="margin:15px;">Return</button></a>

            </div>
			</div>
		</div>	
</body>
</html>