<?php
	session_start();
	require "controllers/UserController.php";
    require_once "controllers/PostController.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">	
	<title>Profile</title>
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<link rel="stylesheet" type="text/css" href="styles/mediaProfile.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<script type="text/javascript" src="../main/scripts/general.js"></script>
    <script type="text/javascript" src="../main/scripts/home.js"></script>
	<script type="text/javascript" src="../main/scripts/jquery.js"></script>
	<script type="text/javascript" src="../main/scripts/profile.js"></script>
</head>
<body>
	<?php
		if(!isset($_SESSION['id'])) {
			header("Location: ./friendnet.html");
		}
		$user_id = $_SESSION['id'];
		$my_user_id = $_SESSION['id'];
		$url = $_SERVER['REQUEST_URI'];
		$query_params = parse_url($url, PHP_URL_QUERY);
		parse_str($query_params, $params);
		if(isset($params['id'])) {
			$user_profile_id = $params['id'];
		}
		if(!isset($user_profile_id)) {
			$user_profile_id = $my_user_id;
		} 
		$isMyProfile = $user_profile_id == $my_user_id;
		$user = new UserController;
		$posts = new PostController;
		$fullUser = $user->getUserById($user_profile_id);
	?>

	<div class="headerwrapper profile">
		<div class="header">
			<div class="navigation">
				<div class="navtab">
					<div class="navtabitem home">
						<i class="fa fa-home"></i><a href="index.php">Home</a></div>
					<div class="navtabitem moments">
							<ul class = "dropdown-btn-likes configUl">
                                <span class="count-likes" style="border-radius:10px;"></span>
                                <i class="fa fa-bell"></i> Likes
                                <ul style = "padding:0; margin: 0;" id = "dropdown-container-likes" class = "dropdown-menu-likes"></ul>
                            </ul>
                        </div>
					<div class="navtabitem notifications">
                            <ul class = "dropdown-btn ulConfig">
                                <span class="count" style="border-radius:10px;"></span>
                                <i class="fa fa-bell"></i> Comments
                                <ul style = "margin: 0; padding: 0;" id = "dropdown-container" class = "dropdown-menu"></ul>
                            </ul>
                        
	                    </div>
					<div class="navtabitem messages">
							<i ></i>
						</div>
					</div>

					<div class="navlogo">
					<i class='fas fa-spider' style='font-size:25px;color:#45a29e;'></i>
					</div>
					<div class="navright">
						<form autocomplete="off"  method = "post" action="#">
							<ul>
								<input  onfocus = "doSearch()" type="text" name="search" id = "search" placeholder="Search Friendnet">
								<li><div id = "back_result"></div></li>
							</ul>
						</form>
						<?php 
							$profilePicTop = $user->getProfilePicById($user_id);
							if($profilePicTop == "noprofile") {
								$profilePicTop = "uploads/noprofile.png";
							}
							echo "<img src=\"$profilePicTop\">"
						 ?>
						<button onclick="logout()">Logout</button>
					</div>
				</div>
			</div>
			<div class="headerContainer">
				<div class="headerMobile">
					<i onclick="window.history.back()" class="fa fa-arrow-left" style="font-size:60px"></i>
					<?php
						$name = $user->getNameById($user_profile_id);
						echo("<span id=nameMobile>$name</span>");
					?>
				</div>
			</div>
		</div>
	<?php 
		$threePosts = $posts->getThreeLastPhotosByUserId($user_profile_id);
		$src1 = $threePosts[0]['picture'];
		$src2 = $threePosts[1]['picture'];
		$src3 = $threePosts[2]['picture'];
	?>
	<div class="wrapper">
		<div class="background">
			<div class="slideshow-container">

				<div class="mySlides fade">
				  <div class="numbertext">1 / 3</div>
				  <img src="<?php echo($src1) ?>" style="width:100%">
				</div>

				<div class="mySlides fade">
				  <div class="numbertext">2 / 3</div>
				  <img src="<?php echo($src2) ?>" style="width:100%">
				</div>

				<div class="mySlides fade">
				  <div class="numbertext">3 / 3</div>
				  <img src="<?php echo($src3) ?>" style="width:100%">
				</div>

				<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
				<a class="next" onclick="plusSlides(1)">&#10095;</a>

			</div>
			<br>

			<div style="text-align:center">
			  <span class="dot" onclick="currentSlide(1)"></span> 
			  <span class="dot" onclick="currentSlide(2)"></span> 
			  <span class="dot" onclick="currentSlide(3)"></span> 
			</div>
		</div>

		<div class="stats">
			<?php
				$numberOfPosts = $posts->getNumberOfPostsByUserId($user_profile_id);
				$numberOfConnections = $user->getNumberOfConnectionsByUserId($user_profile_id);
				$numberOfLikes = $user->getNumberOfLikesByUserId($user_profile_id);
			?>
			<div class="tabs">
				<div class="profilepic">
					<?php 
						$curruser = $user->getUserById($user_profile_id);
						$imgpathprofile = $curruser['profile_pic'];
						if($imgpathprofile == "noprofile") {
							$imgpathprofile = "uploads/noprofile.png";
						}
						echo "<img onclick=\"uploadProfilePicture($isMyProfile)\" src=\"$imgpathprofile\">";
						echo "<button id=\"uploadPP\" style=\"display: none; background-color: transparent; border: none; color: white; margin-bottom: 3px\" onclick=\"sendProfilePicToDb($user_id)\">Save Photo</button>";
					 ?>
					<form action="" style="display:none;" method="POST" id="uploadPictureForm">
						<input type="file" name="image" style="display: none" accept=".png, .jpg" id="filechooser">
					</form>
				</div>
				<div class="statistics">
					<div class="itemstat tweets">
						Posts
						<br/> <span class="num"><?php echo($numberOfPosts) ?></span>
					</div>
					<div class="itemstat followers">
						Connections
						<br/> <span class="num"><?php echo($numberOfConnections) ?></span>
					</div>
					<!--
					<div class="itemstat following">
						Following
						<br/> <span class="num">1203</span>
					</div>
					-->
					<div class="itemstat likes">
						Likes
						<br/> <span class="num"><?php echo($numberOfLikes) ?></span>
					</div>
				</div>
				<div class="follow">
					<?php
						$buttonName = "Follow";
						if(!$isMyProfile) {
							$isFollowed = $user->isUserFollowed($user_profile_id, $my_user_id);
							if($isFollowed) {
								$buttonName = "Following";
							} else {
								$buttonName = "Follow";
							}
						} else {
							$buttonName = "Edit Profile";
						}
						echo "<button id=\"followButton\" onclick=\"followUser($user_profile_id, $my_user_id, '$isMyProfile', $user_id)\">$buttonName</button>";
					?>
				</div>
			</div>
		</div>

		<div class="infoProfileMobile">
			<?php
				$name = $user->getNameById($user_profile_id);
				$surname = $user->getSurnameById($user_profile_id);
				$username = $user->getUserNameById($user_profile_id);
				$bio = $user->getBioById($user_profile_id);
				$location = $user->getBirthPlaceById($user_profile_id);
				echo("<span>$name $surname</span>");
				echo("<span>@$username</span>"); 
				echo("<p>$bio</p>");
			?>
			<div class="locationMobile">
				<i class='fas fa-map-marker-alt' style='font-size:50px'></i>
				<a href=""><?php echo("$location") ?></a>
			</div>
			<div class="birthdate">
				<span class="icon-ballon"><i class='fas fa-gift' style='font-size:50px'></i></span>
				<span class="birthdateText">Born February 25, 1999</span>
			</div>
		</div>

		<div class="content profile">
			<div class="midcontent">
				<div class="left-content">
					<div class="profileSidebar">
						<div class="profileHeaderCard">
							<div class="notEditable">
								<?php
								$name = $user->getNameById($user_profile_id);
								$surname = $user->getSurnameById($user_profile_id);
								$username = $user->getUserNameById($user_profile_id);
								$bio = $user->getBioById($user_profile_id);
								$location = $user->getBirthPlaceById($user_profile_id);
								$birthdate = $user->getBirthDateById($user_profile_id);
								$nrPosts = $posts->getNumberOfPostsByUserId($user_profile_id);
								$lastPosts = $posts->getSixLastPhotosByUserId($user_profile_id);
								echo("<h2 id=\"nameLabel\">$name $surname</h2>");
								echo("<h3 id=\"usernameLabel\">@$username</h3>"); 
								echo("<p id=\"bioLabel\">$bio</p>");
								?>
								<div class="location">
									<i class='fas fa-map-marker-alt' style='font-size:24px'></i>
									<a href=""><?php echo("<span id=\"locationLabel\">$location</span>") ?></a>
								</div>
								<!-- <div class="website">
									<i class="fa fa-chain" style="font-size:24px"></i>
									<a href="">yourwebsite.com</a></div> -->
								<!-- <div class="joinDate">
									<span class="icon icon-calendar"><i class="fa fa-calendar" style="font-size:24px"></i></span>
									<span class="joinDateText">Joind December 2012</span>
								</div> -->
								<div class="birthdate">
									<span class="icon-ballon"><i class='fas fa-gift' style='font-size:24px'></i></span>
									<span class="birthdateText">Born <?php echo $birthdate ?></span>
								</div>
							</div>
							<div class="editable">
								<input type="text" id="nameEdit">
								<?php
									$username = $user->getUserNameById($user_profile_id);
									echo("<h3>@$username</h3>");
								?>
								<input type="text" id="bioEdit">
								<input type="text" id="locationEdit">
								<!-- <input type="date" id="dateEdit"> -->
								<div class="birthdate">
									<span class="icon-ballon"><i class='fas fa-gift' style='font-size:24px'></i></span>
									<span class="birthdateText">Born <?php echo $birthdate ?></span>
								</div>
							</div>
						</div>
						<div class="photoRail">
							<div class="photoRail-heading">
								<span class="icon-camera"><i class='far fa-image' style='font-size:24px'></i></span>
								<span class="photoRail-heading-text"><a href=""><?php echo "$nrPosts"; ?> Photos</a></span>
							</div>
							<div class="photoRail-mediaBox">
								<?php
									foreach ($lastPosts as $aPost) {
										$path = $aPost['picture'];
										$imgId = $aPost['id'];
										echo "<span>
												<img id=\"$imgId\" onclick=\"openModal($imgId)\" src=\"$path\" alt=\"\">
											</span>";
									}
								?>

									<!-- The Modal -->
								<div id="myModal" class="modal">
								<span class="close" onclick="closeModalin()">&times;</span>
								<img class="modal-content" id="img01">
								<div id="caption"></div>
								</div>
								
								<!-- <span>
									<img src="images/1.jpg" alt="">
								</span>
								<span>
									<img src="images/5.jpg" alt="">
								</span>
								<span>
									<img src="images/profile1.jpg" alt="">
								</span>
								<span>
									<img src="images/profile2.jpg" alt="">
								</span>
								<span>
									<img src="images/7.jpg" alt="">
								</span>
								<span>
									<img src="images/10.jpg" alt="">
								</span> -->
							</div>
						</div>
					</div>
				</div>

				<div class="center-content">
					<div class="tweetitem tweetnav">
						<div class="tweetnavitem tweet-tweetnav"><span>Posts</span></div>
						<div class="tweetnavitem media-tweetnav"><span>Media</span></div>
					</div>

					<ul class="unordered-post-list" id="postsList">
						<?php
							$userposts = $posts->getAllPostsByUserId($user_profile_id);
							foreach($userposts as $row) {
								$postId = $row['id'];
								$postContent = $row['content'];
								$postPicture = $row['picture'];
								$postCreationTime = $row['creation_time'];
								$isPostLikedByMe = $posts->isPostLikedByMe($postId, $my_user_id);
								$numberOfLikes = $posts->getNumberOfLikesByPostId($postId);
								$numberOfComments = $posts->getNumberOfCommentsByPostId($postId);
								$listOfComments = $posts->getAllCommentsByPostId($postId);
								$creationDate = $posts->getCreationDateByPostId($postId);

								$listOfCommentersNames = array();
								foreach ($listOfComments as $comment) {
									$cmId = $comment['u_id'];
									$cmName = $user->getNameById($cmId);
									$listOfCommentersNames[] = $cmName;
								}
								$jsonedCommenters = json_encode($listOfCommentersNames);

								$jsoned = json_encode($listOfComments);
								$profilePicPost = $fullUser['profile_pic'];
								if($profilePicPost == "noprofile") {
									$profilePicPost = "uploads/noprofile.png";
								}
								$signedInName = $fullUser['name'];

								echo "<script>populatePost($postId, '$postContent', '$postPicture', '$postCreationTime', '$name', '$username', $my_user_id, '$isPostLikedByMe', $numberOfLikes, $numberOfComments, $jsoned, $user_profile_id, '$profilePicPost', $jsonedCommenters, '$signedInName', '$creationDate')</script>";
							}
						?>
					</ul>

					<!-- <div class="atweetitem firsttweet">
						<div class="tweetitem-left">
							<img src="images/8.jpg">
						</div>
						<div class="tweetitem-right">
							<div class="tweetitem-header">
								<span class="tweetitem-fullname">Hiking</span>
								<span class="tweetitem-username">@hiking</span>
								<span class="tweetitem-timestamp"> · 19h</span>
							</div>
							<div class="tweetitem-title">This is a <span class="hashtagged">#coolGif</span></div>
							<div class="tweetitem-content">
								<img src="images/thegif.gif">
							</div>
							<div class="tweetitem-footer">
								<div class="footerbtn like">
									<i class="fa fa-heart-o" style="font-size:24px"></i>
								</div>
								<div class="footerbtn comment">
									<i class="fa fa-comment-o" style="font-size:24px"></i>
								</div>
							</div>
						</div>
					</div>

					<div class="atweetitem secondtweet">
						<div class="tweetitem-left">
							<img src="images/8.jpg">
						</div>
						<div class="tweetitem-right">
							<div class="tweetitem-header">
								<span class="tweetitem-fullname">Hiking</span>
								<span class="tweetitem-username">@hiking</span>
								<span class="tweetitem-timestamp"> · May 6</span>
							</div>
							<div class="tweetitem-title">Infinity, great design! <span class="hashtagged">#Ininite</span></div>
							<div class="tweetitem-content">
								<img src="images/infinity.gif">
							</div>
							<div class="tweetitem-footer">
								<div class="footerbtn like">
									<i class="fa fa-heart-o" style="font-size:24px"></i>
								</div>
								<div class="footerbtn comment">
									<i class="fa fa-comment-o" style="font-size:24px"></i>
								</div>
							</div>
						</div>
					</div> -->
				</div>

				<div class="right-content">
					<div class="who-to-follow">
						<div class="who-to-follow-title">
							<h4>Who to follow</h4>
							<ul>
								<li><a>Refresh</a></li>
								<li><a>View all</a></li>
							</ul>
						</div>
						<?php
							$usersToFollow = $user->getUserYouDontFollow($user_id);
							$lengthi = count($usersToFollow);
							$index =  $lengthi > 3 ? 3 : $lengthi; 
							for($i = 0; $i < $index; $i++) {
								if(!$usersToFollow[$i]){
									break;
								}
								$row = $usersToFollow[$i];
								$to_follow_id = $row['id'];
								$name = $row['name'];
								$username = $row['username'];
								$toFollowProfilePic = $row['profile_pic'];
								if($toFollowProfilePic == "noprofile") {
									$toFollowProfilePic = "uploads/noprofile.png";
								}
								echo("<div class=\"followitem\" id=\"$to_follow_id\">
										<div class=\"followitempic\">
											<img src=\"$toFollowProfilePic\" style=\"cursor: pointer;\" onclick=\"goToProfileById($to_follow_id)\">
										</div>

										<div class=\"followitemtext\">
											<div class=\"followitemname\" onclick=\"goToProfileById($to_follow_id)\">
												$name <span class=\"followitem-username\">@$username</span>
											</div>
											<div class=\"followitembutton\">
												<button onclick=\"followSuggestion($user_id, $to_follow_id, $i)\" id=\"followSuggestion$i\">Follow</button>
											</div>
										</div>

										<div class=\"followitemcross\">
											<img src=\"images/cross.png\">
										</div>
									</div>");
							}
						?>
						<div class="findpeople">
							<i class="fa fa-user" style="font-size:24px"></i>
							<span class="findpeopletext">Find people you know</span>
						</div>
					</div>

					<div class="trending">
						<?php 
                            $location = $user->getBirthPlaceById($user_id);
                        ?>
						<div class="trendingtitle">
							Most popular in <?php echo $location; ?> <span class="changetrend">Change</span>
						</div>

						<div class="trendlist">
							<ul>
                                <?php
                                    
                                    $hashtags = $posts->getTop5HashtagsFromUsersLocation($location);
                                    
                                    foreach($hashtags as $hashtag){
                                        foreach($hashtag as $key){
                                        echo "<li><span class=\"trenditemtitle\">#$key</span></li>";
                                        } 
                                    }
                                ?>
							</ul>
						</div>
					</div>

					<div class="right-footer">
						 <a href="index.php">© 2019 FriendNet</a>
						 <a href="contact.php" style="margin-left: 22px"><i class="fa fa-phone-square" style="font-size:16px"></i> Contact</a>
						 <a href="about.php" style="margin-left: 22px"><i class="fa fa-info-circle" style="font-size:16px"></i> About</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
	var slideIndex = 1;
	showSlides(slideIndex);

	function plusSlides(n) {
	  showSlides(slideIndex += n);
	}

	function currentSlide(n) {
	  showSlides(slideIndex = n);
	}

	function showSlides(n) {
	  var i;
	  var slides = document.getElementsByClassName("mySlides");
	  var dots = document.getElementsByClassName("dot");
	  if (n > slides.length) {slideIndex = 1}    
	  if (n < 1) {slideIndex = slides.length}
	  for (i = 0; i < slides.length; i++) {
	      slides[i].style.display = "none";  
	  }
	  for (i = 0; i < dots.length; i++) {
	      dots[i].className = dots[i].className.replace(" active", "");
	  }
	  slides[slideIndex-1].style.display = "block";  
	  dots[slideIndex-1].className += " active";
	}
	</script>

    <script>
    
    $(document).ready(getCommentNotifications());
    $(document).ready(dropDownComments());
    $(document).ready(getLikeNotifications());
    $(document).ready(dropDownLikes());
    
    
    
    </script>
    
</body>
</html>