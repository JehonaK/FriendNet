<?php
	
	session_start();

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require 'C:\xampp\php\vendor\autoload.php';

	require_once "../includes/dbh.inc.php";

		$u_id = $_SESSION['id'];

		$problems = $_POST['problem'];

		$problemDescription = $_POST['problemDescription'];
		$contactWay = $_POST['radio-contact'];
		$email = "";
		if($contactWay == "default") {
			$sql = "SELECT * FROM user_table WHERE id = '$u_id'";
			$result = mysqli_query($this->connection, $sql);
			$user = mysqli_fetch_assoc($result);
			$email = $user['email'];
		} else {
			$email = $_POST['email'];
		}

		$emailBodyText = "Please find below the solution/s to problem/s you reported.\n\n";

		if(in_array("creatingAccount", $problems)) {
			$emailBodyText = $emailBodyText."If you are having problems creating an account please check if you are choosing a valid email address or password\n";
		}

		if(in_array("messagesNotComming", $problems)) {
			$emailBodyText = $emailBodyText."If messages are not comming please try using a different browser\n";
		}

		if(in_array("cannotUploadImages", $problems)) {
			$emailBodyText = $emailBodyText."If you cannot upload images, please check their size and/or format\n";
		}

		if(in_array("notificationsNotShowing", $problems)) {
			$emailBodyText = $emailBodyText."If notifications are not showing, please check your internet connection\n";
		}

		$emailBodyText = $emailBodyText."\nSupport Team, Firendnet";

		$mail = new PHPMailer(TRUE);
		try {
		   $mail->setFrom('rinorhajrizi1718@gmail.com', 'friendnet@noreply.com');
		   $mail->addAddress($email, 'FriendNet User');
		   $mail->Subject = 'Solution to problem/s reported';
		   $mail->Body = $emailBodyText;

		   /* SMTP parameters. */
	   
		   /* Tells PHPMailer to use SMTP. */
		   $mail->isSMTP();
		   
		   /* SMTP server address. */
		   $mail->Host = 'smtp.gmail.com';

		   /* Use SMTP authentication. */
		   $mail->SMTPAuth = TRUE;
		   
		   /* Set the encryption system. */
		   $mail->SMTPSecure = 'tls';
		   
		   /* SMTP authentication username. */
		   $mail->Username = 'rinorhajrizi1718@gmail.com';
		   
		   /* SMTP authentication password. */
		   $mail->Password = 'kselqupqcjstzqol';
		   
		   /* Set the SMTP port. */
		   $mail->Port = 587;
		   
		   /* Finally send the mail. */
		   $mail->send();

		}
		catch (Exception $e)
		{
		   /* PHPMailer exception. */
		   echo $e->errorMessage();
		}
		catch (\Exception $e)
		{
		   /* PHP exception (note the backslash to select the global namespace Exception class). */
		   echo $e->getMessage();
		}

		header("Location: ../contact.php?sent=success");
?>