<?php
//fetch.php;
session_start();
	require 'controllers/PostController.php';
	require 'controllers/UserController.php';

    $controller = new PostController;
    $uController = new UserController;

if(isset($_POST["view"]))
{
    if(!isset($_SESSION['id'])) {
				header("Location: ./friendnet.html");
       
			}
     $user_id = $_SESSION['id'];
			
 include_once('includes/Database.php');
 if($_POST["view"] != '')
 {
  $update_query = "UPDATE comment SET comment_status=1 WHERE comment_status=0";
  mysqli_query($connect, $update_query);
 
 }
    
    $posts = $controller->getAllPostsByUserId($user_id);
    $i = 0;
     foreach($posts as $post){
         $i = $i + 1;
             $post_id = $post['id'];
             $query = "SELECT * FROM COMMENT WHERE post_id = $post_id ORDER BY id DESC LIMIT 5";
 $result = mysqli_query($connect, $query);
 $output = '';
 
 if(mysqli_num_rows($result) > 0)
 {
  while($row = mysqli_fetch_array($result))
  {
      $user = $controller->getUserByCommentId($row['id']);
      /* Use this to open the post */
      $post_id = $controller->getPostIdByUserIdandCommentId($user['id'], $row['id']);
      $profilePic = $uController->getProfilePicById($user['id']);
   $output .= '
   <li>
    <div class = "pictureLi">
        <a href = "http://localhost/friendnet/main/profile.php?id='.$user["id"].'">
            <img style="margin-top: 4px;" width="50" height="45" src = "'.$profilePic.'"/>
        </a>
    </div>
    <div class = "contentLi">
    <a href = "">
     '.$user["name"].' left a comment on your post
    </a>
    </div>
   </li>
   ';
  }
 }
 else
 {
  $output .= '<li><div class = "contentLi">
    <a href = "">
    No Comments Found</a>
    </div></li>';
 }

         
 $query_1 = "SELECT * FROM comment WHERE comment_status=0";
 $result_1 = mysqli_query($connect, $query_1);
 $count = mysqli_num_rows($result_1);
 $data = array(
  'notification'   => $output,
  'unseen_notification' => $count
 );
             if($i == sizeof($posts)){
                  echo json_encode($data);
                break;
             }

}
    
         }

     



    
 
?>