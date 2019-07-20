<?php
	
include_once "./includes/Database.php";

class PostController {

	protected $connection;
	protected $db;

	function __construct() {
		$this->db = new Database;
		$this->connection = $this->db->conn;
	}

	function getNumberOfPosts() {
		$sql = "SELECT count(*) as nrPosts FROM post";
        $result = mysqli_query($this->connection, $sql);
        $row = mysqli_fetch_assoc($result);
        $nrPosts = $row['nrPosts'];
        return $nrPosts;
	}

	function getNumberOfLikes() {
		$sql = "SELECT count(*) as nrLikes FROM like_table";
        $result = mysqli_query($this->connection, $sql);
        $row = mysqli_fetch_assoc($result);
        $nrLikes = $row['nrLikes'];
        return $nrLikes;
	}

	function getNumberOfComments() {
		$sql = "SELECT count(*) as nrComments FROM comment";
        $result = mysqli_query($this->connection, $sql);
        $row = mysqli_fetch_assoc($result);
        $nrComments = $row['nrComments'];
        return $nrComments;
	}

	function getSixLastPhotosByUserId($id) {
		$sql = "SELECT * FROM post WHERE u_id = '$id' LIMIT 6";
		$result = mysqli_query($this->connection, $sql);
		$post_array = array();
	    while($row = mysqli_fetch_assoc($result))
	    {
	        $post_array[] = $row;
	    }
		return $post_array;
	}

	function getThreeLastPhotosByUserId($id) {
		$sql = "SELECT * FROM post WHERE u_id = '$id' LIMIT 3";
		$result = mysqli_query($this->connection, $sql);
		$post_array = array();
	    while($row = mysqli_fetch_assoc($result))
	    {
	        $post_array[] = $row;
	    }
		return $post_array;
	}

	function getCreationDateByPostId($id) {
		$sql = "SELECT * FROM post WHERE id = '$id'";
		$result = mysqli_query($this->connection, $sql);
		$row = mysqli_fetch_assoc($result);
		return $row['creation_time'];
	}

	function getAllPostsByUserId($id) {
		$sql = "SELECT * FROM post WHERE u_id = '$id'";
		$result = mysqli_query($this->connection, $sql);
		$post_array = array();
	    while($row = mysqli_fetch_assoc($result))
	    {
	        $post_array[] = $row;
	    }
		return $post_array;
	}

	function getAllPostsFromOthers($id) {
		$sql = "SELECT * FROM post WHERE u_id != '$id' ORDER BY id DESC";
		$result = mysqli_query($this->connection, $sql);
		$post_array = array();
	    while($row = mysqli_fetch_assoc($result))
	    {
	        $post_array[] = $row;
	    }
		return $post_array;
	}

	function getNumberOfLikesByPostId($post_id) {
		$sql = "SELECT count(*) as nrLikes FROM like_table WHERE post_id = '$post_id'";
		$result = mysqli_query($this->connection, $sql);
		$row = mysqli_fetch_assoc($result);
		$numberOfLikes = $row['nrLikes'];
		return $numberOfLikes;
	}

	function getNumberOfCommentsByPostId($post_id) {
		$sql = "SELECT count(*) as nrComments FROM comment WHERE post_id = '$post_id'";
		$result = mysqli_query($this->connection, $sql);
		$row = mysqli_fetch_assoc($result);
		$numberOfComments = $row['nrComments'];
		return $numberOfComments;
	}

	function getAllPostsOfMyConnections($id) {
		$sql = "SELECT * FROM post WHERE u_id in (SELECT followed_id FROM user_friendship WHERE follower_id = '$id') OR u_id = '$id'";
		//
		$result = mysqli_query($this->connection, $sql);
		$post_array = array();
	    while($row = mysqli_fetch_assoc($result))
	    {
	        $post_array[] = $row;
	    }
		return $post_array;
	}

	function getCommentersNamesByPostId($post_id) {
		// Select u_id from comment where post_id = $post_id
	}

	function getgetAllCommentsByPostId($post_id) {
		$sql = "SELECT * FROM comment WHERE post_id = '$post_id'";
		$result = mysqli_query($this->connection, $sql);
		$comment_array = array();
	    while($row = mysqli_fetch_assoc($result))
	    {
	    	// $u_id = $row['u_id'];
	    	// $post_id = $row['post_id'];
	    	// $content = $row['content'];
			$comment_array[] = $row;
	    	//$comment_array['comment'][] = array('u_id'=>$u_id, 'post_id'=>$post_id, 'content'=>$content);

	    }
		return $comment_array;
	}

	function getNumberOfPostsByUserId($id) {
		$sql = "SELECT count(*) as total FROM post WHERE u_id = '$id'";
		$result = mysqli_query($this->connection, $sql);
		$row = mysqli_fetch_assoc($result);
		$numberOfPosts = $row['total'];
		return $numberOfPosts;
	}

	function likePhotoById($id, $u_id) {
		$isLiked = $this->isPostLikedByMe($id, $u_id);
		if(!$isLiked) {
			$sql = "INSERT INTO like_table (u_id, post_id) VALUES (?, ?)";
			$stmt = mysqli_stmt_init($this->connection);
			mysqli_stmt_prepare($stmt, $sql);
			mysqli_stmt_bind_param($stmt, "ii", $u_id, $id);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			mysqli_close($this->connection);
			return true;
		} else {
			$sql = "DELETE FROM like_table WHERE u_id = $u_id AND post_id = $id";
			$stmt = mysqli_stmt_init($this->connection);
			mysqli_stmt_prepare($stmt, $sql);
			mysqli_stmt_bind_param($stmt, "ii", $u_id, $id);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			mysqli_close($this->connection);
			json_encode(array('success' => 0));
			return false;
		}
	}

	function isPostLikedByMe($postId, $userId) {
		$sql = "SELECT count(*) as nrLikes FROM like_table WHERE u_id = '$userId' AND post_id = '$postId'";
		$result = mysqli_query($this->connection, $sql);
		$row = $row = mysqli_fetch_assoc($result);
		$numberOfLikes = $row['nrLikes'];
		if($numberOfLikes == 0) {
			return false;
		} else {
			return true;
		}
	}

	function addCommentByUserId($postId, $userId, $comment_content) {
		$sql = "INSERT INTO comment (u_id, post_id, content) VALUES (?, ?, ?)";
		$stmt = mysqli_stmt_init($this->connection);
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, "iis", $userId, $postId, $comment_content);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		mysqli_close($this->connection);
	}

	function getUserByCommentId($comment_id) {
		$sql = "SELECT * FROM user_table WHERE id = (SELECT u_id from comment WHERE id = '$comment_id')";
		$result = mysqli_query($this->connection, $sql);
		$row = mysqli_fetch_assoc($result);
		return $row;
	}
    
    function getUserByLikeId($like_id) {
		$sql = "SELECT * FROM user_table WHERE id = (SELECT u_id from like_table WHERE id = '$like_id')";
		$result = mysqli_query($this->connection, $sql);
		$row = mysqli_fetch_assoc($result);
		return $row;
	}

	// function getNumberOfLikesByPostId($id) {
	// 	$sql = "SELECT count(*) as nrLikes FROM like_table WHERE id = '$id'";
	// 	$result = mysqli_query($this->connection, $sql);
	// 	$row = $row = mysqli_fetch_assoc($result);
	// 	$numberOfLikes = $row['nrLikes'];
	// 	return $numberOfLikes;
	// }

	function getAllCommentsByPostId($post_id) {
		$sql = "SELECT * FROM comment WHERE post_id = '$post_id'";
		$result = mysqli_query($this->connection, $sql);
		$comment_array = array();
	    while($row = mysqli_fetch_assoc($result))
	    {
	        $comment_array[] = $row;
	    }
		return $comment_array;
	}

	function addNewPostByUserId($u_id, $imgPath, $content) {
		$sql = "INSERT INTO post (content, picture, u_id, creation_time) VALUES (?, ?, ?, CURDATE())";
		$stmt = mysqli_stmt_init($this->connection);
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, "ssi", $content, $imgPath, $u_id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		mysqli_close($this->connection);
	}
    
    function addNewHashtagByUserPostId($post_id, $hashtag){
        $sql = "INSERT INTO hashtag (post_id, tag_name) VALUES (?, ?)";
		$stmt = mysqli_stmt_init($this->connection);
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, "si", $post_id, $tag_name);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		mysqli_close($this->connection);
    }

    function getLastPostIdByUserId($u_id) {
    	$sql = "SELECT * FROM post WHERE u_id = '$u_id' ORDER BY id DESC LIMIT 1";
		$result = mysqli_query($this->connection, $sql);
		$row = mysqli_fetch_assoc($result);
		return $row['id'];
    }

	function getNameByPostId($id) {
		$sql = "SELECT * FROM post WHERE id = '$id'";
		$result = mysqli_query($this->connection, $sql);
		$row = $row = mysqli_fetch_assoc($result);
		$u_id = $row['u_id'];

		$sql = "SELECT * FROM user_table WHERE id = '$u_id'";
		$result = mysqli_query($this->connection, $sql);
		$row = mysqli_fetch_assoc($result);
		$name = $row['name'];
		return $name;
	}

	function getUsernameByPostId($id) {
		$sql = "SELECT * FROM post WHERE id = '$id'";
		$result = mysqli_query($this->connection, $sql);
		$row = $row = mysqli_fetch_assoc($result);
		$u_id = $row['u_id'];

		$sql = "SELECT * FROM user_table WHERE id = '$u_id'";
		$result = mysqli_query($this->connection, $sql);
		$row = mysqli_fetch_assoc($result);
		$username = $row['username'];
		return $username;
	}

	function getUserIdByPostId($id) {
		$sql = "SELECT * FROM post WHERE id = '$id'";
		$result = mysqli_query($this->connection, $sql);
		$row = $row = mysqli_fetch_assoc($result);
		$u_id = $row['u_id'];
		return $u_id;
	}
    
    function getPostIdByUserIdandPostContent($id, $content) {
		$sql = "SELECT * FROM post WHERE u_id = '$id' AND content = '$content'";
		$result = mysqli_query($this->connection, $sql);
		$row = $row = mysqli_fetch_assoc($result);
		$post_id = $row['id'];
        return $post_id;
	}
    
    function getPostIdByUserIdandCommentId($id, $comment) {
		$sql = "SELECT * FROM Post WHERE u_id = $id AND (select count(*) from comment having id = $comment )";
		$result = mysqli_query($this->connection, $sql);
		$row = $row = mysqli_fetch_assoc($result);
		$post_id = $row['id'];
        return $post_id;
	}
    
        function getPostIdByUserIdandLikeId($id, $like) {
		$sql = "SELECT * FROM Post WHERE u_id = $id AND (select count(*) from like_table having id = $like )";
		$result = mysqli_query($this->connection, $sql);
		$row = $row = mysqli_fetch_assoc($result);
		$post_id = $row['id'];
        return $post_id;
	}
    
    function getTop5HashtagsFromUsersLocation($location) {
		$sql = "SELECT tag_name FROM hashtag WHERE location = 'kosovo' 
                GROUP BY tag_name
                order by count(*) DESC
                limit 8";
		$result = mysqli_query($this->connection, $sql);
		$hashtag_array = array();
	    while($row = mysqli_fetch_assoc($result))
	    {
	        $hashtag_array[] = $row;
	    }
		return $hashtag_array;
	}
}
?>