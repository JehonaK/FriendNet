<?php
	
include_once "./includes/Database.php";
include_once "PostController.php";

class UserController{

	protected $connection;
	protected $db;
    protected $controllerOfThePosts;
    
	function __construct() {
		$this->db = new Database;
		$this->connection = $this->db->conn;
        $this->controllerOfThePosts = new PostController;
	}
    
    function findAll(){
        $sql = "SELECT * FROM user_table";
        $result = mysqli_query($this->connection, $sql);
        $users = array();
        while($row = mysqli_fetch_assoc($result)){
	        $users[] = $row;
	    }
        return $users;
    }

    function getUserById($u_id) {
    	$sql = "SELECT * FROM user_table WHERE id = '$u_id'";
        $result = mysqli_query($this->connection, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    function getNumberOfUsers() {
        $sql = "SELECT count(*) as nrUsers FROM user_table";
        $result = mysqli_query($this->connection, $sql);
        $row = mysqli_fetch_assoc($result);
        $nrUsers = $row['nrUsers'];
        return $nrUsers;
    }

    function getBirthDateById($u_id) {
    	$sql = "SELECT * FROM user_table WHERE id = '$u_id'";
        $result = mysqli_query($this->connection, $sql);
        $row = mysqli_fetch_assoc($result);
        $birthday = $row['birthday'];
        return $birthday;
    }
    
    function getProfilePicById($u_id) {
    	$sql = "SELECT * FROM user_table WHERE id = '$u_id'";
        $result = mysqli_query($this->connection, $sql);
        $row = mysqli_fetch_assoc($result);
        $pic = $row['profile_pic'];
        return $pic;
    }
    
    function changeUserRoleByUserId($id, $role){
        $sql = "UPDATE user_table SET role = ? where id = ?";
        $stmt = mysqli_stmt_init($this->connection);
        mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, "ii", $role, $id);
		mysqli_stmt_execute($stmt);
		mysqli_close($this->connection);
        json_encode(array('success' => 0));
    }

    function updateProfilePictureById($u_id, $path) {
    	$sql = "UPDATE user_table SET profile_pic = ? WHERE id = ?";
    	$stmt = mysqli_stmt_init($this->connection);
        mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, "si", $path, $u_id);
		mysqli_stmt_execute($stmt);
		mysqli_close($this->connection);
    }

    function updateProfileByUserId($firstName, $surname, $bio, $location, $u_id) {
    	$sql = "UPDATE user_table SET name = ?, surname = ?, bio = ?, birthplace = ? WHERE id = ?";
    	$stmt = mysqli_stmt_init($this->connection);
        mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, "ssssi", $firstName, $surname, $bio, $location, $u_id);
		mysqli_stmt_execute($stmt);
		mysqli_close($this->connection);
    }
    
    function deleteUserById($id){
        $sql = "DELETE FROM user_table WHERE id = ?";
        $stmt = mysqli_stmt_init($this->connection);
        mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, "i", $id);
		mysqli_stmt_execute($stmt);
		mysqli_close($this->connection);
        json_encode(array('success' => 0));
    }
    
    function deleteAllUserPostsByUserId($id){
        $sql = "DELETE FROM post WHERE u_id = ?";
        $stmt = mysqli_stmt_init($this->connection);
        mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, "i", $id);
		mysqli_stmt_execute($stmt);
        json_encode(array('success' => 0));

    }
    
    function dislikeAllUserPostsByUserId($id){
        $sql = "DELETE FROM like_table WHERE u_id = ?";
        $stmt = mysqli_stmt_init($this->connection);
        mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, "i", $id);
		mysqli_stmt_execute($stmt);
        json_encode(array('success' => 0));

    }
    
    function unfollowAllUsersByUserId($id){
        $sql = "DELETE FROM user_friendship WHERE follower_id = ?";
        $stmt = mysqli_stmt_init($this->connection);
        mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, "i", $id);
		mysqli_stmt_execute($stmt);
        json_encode(array('success' => 0));
    }
    
    function getUnfollowedByAllUsersByUserId($id){
        $sql = "DELETE FROM user_friendship WHERE followed_id = ?";
        $stmt = mysqli_stmt_init($this->connection);
        mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, "i", $id);
		mysqli_stmt_execute($stmt);
        json_encode(array('success' => 0));
    }
    
	function getNameById($id) {
		$sql = "SELECT * FROM user_table WHERE id = '$id'";
		$result = mysqli_query($this->connection, $sql);
		$user = mysqli_fetch_assoc($result);
		$name = $user['name'];
		return $name;
	}

	function getSurnameById($id) {
		$sql = "SELECT * FROM user_table WHERE id = '$id'";
		$result = mysqli_query($this->connection, $sql);
		$user = mysqli_fetch_assoc($result);
		$surname = $user['surname'];
		return $surname;
	}

	function getUsernameById($id) {
		$sql = "SELECT * FROM user_table WHERE id = '$id'";
		$result = mysqli_query($this->connection, $sql);
		$user = mysqli_fetch_assoc($result);
		$username = $user['username'];
		return $username;
	}

	function getBioById($id) {
		$sql = "SELECT * FROM user_table WHERE id = '$id'";
		$result = mysqli_query($this->connection, $sql);
		$user = mysqli_fetch_assoc($result);
		$bio = $user['bio'];
		return $bio;
	}

	function getGenderById($id) {
		$sql = "SELECT * FROM user_table WHERE id = '$id'";
		$result = mysqli_query($this->connection, $sql);
		$user = mysqli_fetch_assoc($result);
		$gender = $user['gender'];
		return $gender;
	}

	function getBirthPlaceById($id) {
		$sql = "SELECT * FROM user_table WHERE id = '$id'";
		$result = mysqli_query($this->connection, $sql);
		$user = mysqli_fetch_assoc($result);
		$birthPlace = $user['birthplace'];
		return $birthPlace;
	}

	function getEmailById($id) {
		$sql = "SELECT * FROM user_table WHERE id = '$id'";
		$result = mysqli_query($this->connection, $sql);
		$user = mysqli_fetch_assoc($result);
		$email = $user['email'];
		return $email;
	}

	function followUserById($followedId, $followerId) {
		$isFollowed = $this->isUserFollowed($followedId, $followerId);
		if(!$isFollowed) {
			$sql = "INSERT INTO user_friendship (follower_id, followed_id) VALUES (?, ?)";
			$stmt = mysqli_stmt_init($this->connection);
			mysqli_stmt_prepare($stmt, $sql);
			mysqli_stmt_bind_param($stmt, "ii", $followerId, $followedId);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			mysqli_close($this->connection);
		} else {
			$sql = "DELETE FROM user_friendship WHERE follower_id = ? AND followed_id = ?";
			// mysqli_query($this->connection, $sql);
			//DELETE FROM user_friendship WHERE follower_id = 9 AND followed_id = 8
			//DELETE FROM user_friendship WHERE follower_id = $followerId AND followed_id = $followedId
			$stmt = mysqli_stmt_init($this->connection);
			mysqli_stmt_prepare($stmt, $sql);
			mysqli_stmt_bind_param($stmt, "ii", $followerId, $followedId);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			mysqli_close($this->connection);
		}
		
	}

	function isUserFollowed($followedId, $followerId) {
		$sql = "SELECT count(*) as nrFollowers FROM user_friendship WHERE follower_id = '$followerId' AND followed_id = '$followedId'";
		$result = mysqli_query($this->connection, $sql);
		$row = $row = mysqli_fetch_assoc($result);
		$numberOfLikes = $row['nrFollowers'];
		if($numberOfLikes == 0) {
			return false;
		} else {
			return true;
		}
	}

	function getNumberOfLikesByUserId($u_id) {
		$sql = "SELECT count(*) as nrLikes FROM like_table WHERE u_id = '$u_id'";
		$result = mysqli_query($this->connection, $sql);
		$row = $row = mysqli_fetch_assoc($result);
		$numberOfLikes = $row['nrLikes'];
		return $numberOfLikes;
	}

	function getNumberOfConnectionsByUserId	($u_id) {
		$sql = "SELECT count(*) as nrConnections FROM user_friendship WHERE follower_id = '$u_id'";
		$result = mysqli_query($this->connection, $sql);
		$row = $row = mysqli_fetch_assoc($result);
		$nrConnections = $row['nrConnections'];
		return $nrConnections;
	}

	function getUserYouDontFollow($u_id) {
		$sql = "SELECT * FROM user_table WHERE id NOT IN (SELECT followed_id FROM user_friendship WHERE follower_id = '$u_id')";
		$result = mysqli_query($this->connection, $sql);
		$users_array = array();
		while($row = mysqli_fetch_assoc($result))
	    {
	        $users_array[] = $row;
	    }
		return $users_array;
	}
}

?>