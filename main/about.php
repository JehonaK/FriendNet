<?php
    session_start();
    require "controllers/UserController.php";
    include_once "controllers/PostController.php";
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/aboutstyle.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script type="text/javascript" src="../main/scripts/general.js"></script>
        <script type="text/javascript" src="../main/scripts/jquery.js"></script>
		<script type="text/javascript" src="scripts/home.js"></script>
        <title>About</title>
    </head>
    
    <body>
       <?php
            if(isset($_SESSION['id'])) {
                $user_id = $_SESSION['id'];
            }
            $users = new UserController;
            $posts = new PostController;
        ?>

        <div class = "content">        
            <div class="mid-content">
            	<div class="top-mid">
            		<div class="typewritter">
            			Welcome to FriendNet!
            		</div>
            	</div>
            	<div class="mid-mid">
            		<p>
						FriendNet is an online social networking service on which users can follow each-other and become friends. Friends can see each-other's posts and can interact with them by liking or commenting. Real-time messaging is another feature FriendNet has implemented to keep friends connected anytime, anywhere. To make yourself visible to others with similar interests, fill out your profile with a bio and pictures. Make use of the search-box to find what you are looking for.
					<br/>
            			In order to gain full accessibility to FriendNet open a FriendNet account. Full accessibility provides you with the comfort of searching for other people, looking at their profiles, liking or commenting on their posts or even making a post yourself. If you encounter any problem while opening an account or networking with friends please contact our support services.
					</p>
                    <p>
                        <?php 
                            $numberOfUsers = $users->getNumberOfUsers();
                            $numberOfPosts = $posts->getNumberOfPosts();
                            $numberOfLikes = $posts->getNumberOfLikes();
                            $numberOfComments= $posts->getNumberOfComments();
                            echo "Active users: ".$numberOfUsers."<br>";
                            echo "Posts made: ".$numberOfPosts."<br>";
                            echo "Likes: ".$numberOfLikes."<br>";
                            echo "Comments: ".$numberOfComments."<br>";
                        ?>
                    </p>
            	</div>
            	<div class="bottom-mid">
                    <?php
                        if(isset($_SESSION['id'])) {
                            echo "<div class=\"right-bottom bottom-btn-section\">
                                    <a href=\"contact.php\"><button>Contact Support Team</button></a>>
                                </div>";
                        } else {
                            echo "<div class=\"left-bottom bottom-btn-section\">
                                    <a href=\"signup.php\"><button>Create Account</button></a>
                                </div>";
                        }
                    ?>
            	</div>
            </div>
        </div>  
    </body>

</html>