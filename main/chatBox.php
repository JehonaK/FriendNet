<?php
	session_start();
	require "controllers/UserController.php";
	require "controllers/ChatController.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Messages</title>
	<link rel="stylesheet" type="text/css" href="styles/chatBoxStyle.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript" src="../main/scripts/chat.js"></script>
</head>
<body>
	<?php
		if(!isset($_SESSION['id'])) {
			header("Location: ./login.php");
		}
		$user_id = $_SESSION['id'];
		$users = new UserController;
		$chat = new ChatController;
	?>
	<div class="chatBox">
		<div class="header">
			<div class="left">
				<h2>Direct Messages</h2>
			</div>
			<div class="right">
				<button>New Message</button>
				<a href=""><i class="fa fa-close" style="font-size:24px"></i></a>
			</div>
		</div>
		<div class="dm-container">
			<ul id="conversationList">
				<!-- <li>
					<div class="conversation">
						<div class="picture">
							<img src="images/13.jpg">
						</div>
						<div class="thumbnail">
							<div class="profile-name">
								<span class="fullname">Hiking</span>
								<span class="username">@hiking</span>
							</div>
							<div class="last-message">
								<span>Hello!</span>
							</div>
						</div>
						<div class="timestamp">
							<span>May 6</span>
						</div>
					</div>
				</li> -->
				<?php
					$allConversations = $chat->getAllConversationsForUserId($user_id);
					foreach($allConversations as $row) {
						$conversation_id = $row['id'];
						$participant_name = $chat->getParticipantNameByConversationId($conversation_id);
						$participant_username = $chat->getParticipantUsernameByConversationId($conversation_id);
						$last_message = "Hey how are you";
						echo "<script>populateConversation($conversation_id, '$participant_name', '$participant_username', '$last_message')</script>";
					}
				?>
			</ul>
		</div>
	</div>
</body>
</html>