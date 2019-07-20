<?php
	
include_once "./includes/Database.php";

class ChatController {

	protected $connection;
	protected $db;

	function __construct() {
		$this->db = new Database;
		$this->connection = $this->db->conn;
	}

	function getAllConversationsForUserId($u_id) {
		$sql = "SELECT * FROM conversation_table WHERE creator_id = '$u_id'";
		$result = mysqli_query($this->connection, $sql);
		$post_array = array();
	    while($row = mysqli_fetch_assoc($result))
	    {
	        $post_array[] = $row;
	    }
		return $post_array;
	}

	function getConversationById($con_id) {
		$sql = "SELECT * FROM conversation_table WHERE id = '$con_id'";
		$result = mysqli_query($this->connection, $sql);
		$post_array = array();
	    while($row = mysqli_fetch_assoc($result))
	    {
	        $post_array[] = $row;
	    }
		return $post_array;
	}

	function getAllMessagesByConversationId($con_id) {
		$sql = "SELECT * FROM conversation_table WHERE id = '$con_id'";
		$result = mysqli_query($this->connection, $sql);
		$post_array = array();
	    while($row = mysqli_fetch_assoc($result))
	    {
	        $post_array[] = $row;
	    }
		return $post_array;
	}

	function getParticipantNameByConversationId($con_id) {
		$sql = "SELECT * FROM conversation_table WHERE id = '$con_id'";
		$result = mysqli_query($this->connection, $sql);
	    $row = mysqli_fetch_assoc($result);
		$u_id =  $row['creator_id'];

		$sql = "SELECT * FROM user_table WHERE id = '$u_id'";
		$result = mysqli_query($this->connection, $sql);
	    $row = mysqli_fetch_assoc($result);
	    return $row['name'];
	}

	function getParticipantUsernameByConversationId($con_id) {
		$sql = "SELECT * FROM conversation_table WHERE id = '$con_id'";
		$result = mysqli_query($this->connection, $sql);
	    $row = mysqli_fetch_assoc($result);
		$u_id =  $row['creator_id'];

		$sql = "SELECT * FROM user_table WHERE id = '$u_id'";
		$result = mysqli_query($this->connection, $sql);
	    $row = mysqli_fetch_assoc($result);
	    return $row['username'];
	}

	function sendMessage($con_id, $sender_id) {

	}


}

?>