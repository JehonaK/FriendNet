<?php
	session_start();
	require "controllers/UserController.php";
	include_once "controllers/PostController.php";
?>

<html>
    <head>
	<meta name="viewport" content="width=device-width, initial-scale=1">	
        <link rel="stylesheet" type="text/css" href="styles/homeStyle.css"/>
		<link rel="stylesheet" type="text/css" href="styles/style.css">
		<link rel="stylesheet" type="text/css" href="styles/mediaHome.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	
		<script type="text/javascript" src="../main/scripts/home.js"></script>
		<script type="text/javascript" src="../main/scripts/general.js"></script>
		<script type="text/javascript" src="../main/scripts/jquery.js"></script>
		<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script> -->

        <title>Home</title>
        
    </head>
    
    <body>
    	<?php
			if(!isset($_SESSION['id'])) {
				header("Location: ./friendnet.html");
			}
			$user_id = $_SESSION['id'];
			$user = new UserController;
			$posts = new PostController;
		?>
        <div class="headerwrapper">
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
                                <ul id = "dropdown-container" class = "dropdown-menu"></ul>
                            </ul>
                            
                            <!--
	                        <div class = "ulConfig">
		                        <i class="fa fa-bell"></i> Notifications
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <span class="glyphicon glyphicon-envelope" style="font-size:18px;"></span></a>
                                <ul class="dropdown-menu"></ul>

	                        </div>
-->
	                    </div>
						<div class="navtabitem messages">
							<i ></i> </div>
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
				<div class="headerMobileHome">
					<div class="homeIcon">
						<a href="index.php"><i class="fa fa-home"></i></a>
					</div>
					<div class="notificationsIcon">
						<a href=""><i class="fa fa-bell"></i></a>
					</div>
					<div class="profileIcon">
						<a href="profile.php"><i class='far fa-user'></i></a>
					</div>
					<div class="whatever">
						<a href=""><i class='far fa-plus-square'></i></a>
					</div>
				</div>
			</div>
		    </div>
        
        <div class = "content homeWrapper">        
            <div class = "wrapper homeContent">
                <div class = "left-sidebar">
                    <div class = "profile">
                        <div class = "upperProfile">
                        	<div class="cover-photo">
                        		<img src="images/11.jpg" style="width: 285px; height: 95px;">
                        	</div>
                            <div class = "profilePicture">
                            	<?php
                        			$profilePic = $user->getProfilePicById($user_id);
                        			if($profilePic == "noprofile") {
										$profilePic = "uploads/noprofile.png";
									}
									echo "<a href= \"profile.php\"><img src= \"$profilePic\"/></a>";
                        		?>
                            </div>
                        </div>
                        
                        <div class = "bottomProfile"> 
                            <div class = "profilePicture">
                                
                            </div>
                            <div class = "userName">
                            	<?php 
                            		$name = $user->getNameById($user_id);
                            		$username = $user->getUsernameById($user_id);
                            		echo "<h2>$name</h2>";
                            		echo "<p>@$username</p>";
                            	?>
                            </div>

                            <?php 
                            	$numberOfPosts = $posts->getNumberOfPostsByUserId($user_id);
                            	$numberOfConnections = $user->getNumberOfConnectionsByUserId($user_id);
                            ?>
                            
                            <div class = "bottomProfileTweets">
                                <div class = "bottomProfileTweetsText">
                                    <p>Posts</p>
                                </div>
                                
                                <div class = "bottomProfileTweetsNumber">
                                    <h5><?php echo($numberOfPosts); ?></h5>
                                </div>
                            
                            </div>
                            <div class = "bottomProfileFollows">
                                <div class = "bottomProfileFollowsText">
                                    <p>Connections</p>
                                </div>
                                
                                <div class = "bottomProfileFollowsNumber">
                                    <h5><?php echo($numberOfConnections); ?></h5>
                                </div>
                            </div>
                        <!--
                            <div class = "bottomProfileFollower">
                                <div class = "bottomProfileFollowsText">
                                    <p>Followers</p>
                                </div>
                                
                                <div class = "bottomProfileFollowersNumber">
                                    <h5>356</h5>
                                </div>
                            </div>
                        -->
                        </div>  
                         
                    </div>
                    
                    <div class = "trending">
                        <div class = "trendingUpper">
                            <h2>Explore <a href="">· Change</a></h2>
                        </div>
                        
                        <div class = "trendingLower">
                            <!-- <h3>Kosovo</h3>
                            <p>5,736 Tweets</p>
                            <h3>HikingClub</h3>
                            <p>2,936 Tweets</p>
                            <h3>Nature</h3>
                            <p>10,456 Tweets</p>
                            <h3>Design</h3>
                            <p>1,211 Tweets</p>
                            <h3>Sports</h3>
                            <p>5,736 Tweets</p>
                            <h3>Cycling</h3>
                            <p>2,936 Tweets</p>
                            <h3>Photoshooting</h3>
                            <p>10,456 Tweets</p>
                            <h3>UCL final</h3>
                            <p>1,211 Tweets</p> -->
                            <div class="photoRail-mediaBox">
		                        <?php
		                        	$otherPosts = $posts->getAllPostsFromOthers($user_id);
		                        	$lengthArr = count($otherPosts);
		                        	$upToIndex = $lengthArr >= 12 ? 12 : $lengthArr;
		                        	for ($i=0; $i < $upToIndex; $i++) { 
		                        		$aPost = $otherPosts[$i];
		                        		$path = $aPost['picture'];
										$imgId = $aPost['id'];
										echo "<span>
												<img id=\"$imgId\" onclick=\"openModal($imgId)\" src=\"$path\" alt=\"\">
											</span>";
		                        	}
									// foreach ($othersPosts as $aPost) {
									// 	$path = $aPost['picture'];
									// 	$imgId = $aPost['id'];
									// 	echo "<span>
									// 			<img id=\"$imgId\" onclick=\"openModal($imgId)\" src=\"$path\" alt=\"\">
									// 		</span>";
									// }
		                        ?>
                        	</div>
                        </div>
                        
                    </div>
                </div>
                
                <div class="center-content" id="centerContent">
					<div class="whats-happening" id="tweetbox" onclick="enlargeTextBoxOnFocus()">
						<div class="whats-happening-image">
							<?php
                    			$profilePic = $user->getProfilePicById($user_id);
                    			if($profilePic == "noprofile") {
									$profilePic = "uploads/noprofile.png";
								}
								echo "<img src=\"$profilePic\" id=\"newPostProfilePic\">";
                    		?>
						</div>
						<div class="whats-happening-box" id="postTextArea">
							<textarea name="newposttext" id="postTextAreaField" placeholder="What's happening?"></textarea>
						</div>
						<form class="whats-happening-gallery" method="POST" id="uploadForm">
							<i class="fa fa-image" id="galleryBtn" style="color:#45a29e;" onclick="chooseFile()"></i>
							<?php 
								$uid = $_SESSION['id'];
								echo("<i class=\"fa fa-send\" id=\"makePostBtn\" onclick=\"addPost($uid)\"></i>");
							?>
							<input type="file" name="image" style="display: none" accept=".png, .jpg" id="filechooser">
						</form>
					</div>

					<ul class="unordered-post-list" id="postsList">
						<!-- <li>
							<div class="atweetitem">
								<div class="tweetitem-left">
									<img src="images/81.jpg">
								</div>
								<div class="tweetitem-right">
									<div class="tweetitem-header">
										<span class="tweetitem-fullname">Hiking</span>
										<span class="tweetitem-username">@hiking</span>
										<span class="tweetitem-timestamp"> · 19h</span>
									</div>
									<div class="tweetitem-title">    <span class="hashtagged">#coolDesign</span></div>
									<div class="tweetitem-content">
										<img src="images/thegif.gif">
									</div>
									<div class="tweetitem-footer">
										<div class="footerbtn like">
											<i class="fa fa-heart-o" style="font-size:24px"></i>
										</div>
										<div class="footerbtn comment">
											<i class="fa fa-comment-o" style="font-size:24px" onclick="toggleCommentSection()"></i>
										</div>
									</div>
								</div>
								<div class="comment-section" id="first-c-section">
									<div class="addNewCommentSection">
											<img src="images/81.jpg">
									</div>
									<div class="comment-item-block">
										
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="atweetitem">
								<div class="tweetitem-left">
									<img src="images/81.jpg">
								</div>
								<div class="tweetitem-right">
									<div class="tweetitem-header">
										<span class="tweetitem-fullname">Hiking</span>
										<span class="tweetitem-username">@hking</span>
										<span class="tweetitem-timestamp"> · May 6</span>
									</div>
									<div class="tweetitem-title">Infinity design! <span class="hashtagged">#Infinite</span></div>
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
							</div>
						</li> -->

						<?php
							$htmlCommentsDiv = 'initial';
							$allposts = $posts->getAllPostsOfMyConnections($user_id);
							foreach($allposts as $row) {
								$postId = $row['id'];
								$postContent = $row['content'];
								$postPicture = $row['picture'];
								$postCreationTime = $row['creation_time'];
								$isPostLikedByMe = $posts->isPostLikedByMe($postId, $user_id);
								$name_of_user = $posts->getNameByPostId($postId);
								$username_of_user = $posts->getUsernameByPostId($postId);
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
								$postUserId = $posts->getUserIdByPostId($postId);
								$profilePic = $user->getProfilePicById($postUserId);
								$signedInName = $user->getNameById($user_id);
                    			if($profilePic == "noprofile") {
									$profilePic = "uploads/noprofile.png";
								}
								echo "<script>populatePost($postId, '$postContent', '$postPicture', '$postCreationTime', '$name_of_user', '$username_of_user', '$user_id', '$isPostLikedByMe', $numberOfLikes, $numberOfComments, $jsoned, $postUserId, '$profilePic', $jsonedCommenters, '$signedInName', '$creationDate')</script>";
							}
						?>
					</ul>


			

					<!--
					<div class="atweetitem secondtweet">
						<div class="tweetitem-left">
							<img src="images/81.jpg">
						</div>
						<div class="tweetitem-right">
							<div class="tweetitem-header">
								<span class="tweetitem-fullname">Hiking</span>
								<span class="tweetitem-username">@hking</span>
								<span class="tweetitem-timestamp"> · May 6</span>
							</div>
							<div class="tweetitem-title">Infinity design! <span class="hashtagged">#Infinite</span></div>
							<div class="tweetitem-content">
								<img src="images/infinity.gif">
							</div>
							<div class="tweetitem-footer">
								<div class="footerbtn comment">
									<img src="images/ic-chat.png">
								</div>
								<div class="footerbtn retweet">
									<img src="images/ic-retweet.png">
								</div>
								<div class="footerbtn like">
									<img src="images/ic-heart.png">
								</div>
								<div class="footerbtn message">
									<img src="images/ic-message.png">
								</div>
							</div>
						</div>
					</div> -->

						<!-- The Modal -->
						<div id="myModal" class="modal">
						<span class="close" onclick="closeModalin()">&times;</span>
						<img class="modal-content" id="img01">
						<div id="caption"></div>
						</div>

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
						<!-- <div class="followitem first">
							<div class="followitempic">
								<img src="images/appleinsider.jpg">
							</div>

							<div class="followitemtext">
								<div class="followitemname">
									AppleInsider <span class="followitem-username">@appleinsider</span>
								</div>
								<div class="followitembutton">
									<button>Follow</button>
								</div>
							</div>

							<div class="followitemcross">
								<img src="images/cross.png">
							</div>
						</div>
						
						<div class="followitem second">
							<div class="followitempic">
								<img src="images/creode.png">
							</div>

							<div class="followitemtext">
								<div class="followitemname">
									Creode <span class="followitem-username">@creode</span>
								</div>
								<div class="followitembutton">
									<button>Follow</button>
								</div>
							</div>bileb

							<div class="followitemcross">
								<img src="images/cross.png">
							</div>
						</div>

						<div class="followitem third">
							<div class="followitempic">
								<img src="images/epiphany.png">
							</div>

							<div class="followitemtext">
								<div class="followitemname">
									Epiphany Search <span class="followitem-username">@Epi...</span>
								</div>
								<div class="followitembutton">
									<button>Follow</button>
								</div>
							</div>

							<div class="followitemcross">
								<img src="images/cross.png">
							</div>
						</div> -->
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
							Most popular in <?php echo $location; ?><span class="changetrend">Change</span>
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

					<div class="right-footer" style="margin-top: 10px">
						 <a href="index.php">© 2019 FriendNet</a>
						 <a href="contact.php" style="margin-left: 15px"><i class="fa fa-phone-square" style="font-size:16px"></i> Contact</a>
						 <a href="about.php" style="margin-left: 15px"><i class="fa fa-info-circle" style="font-size:16px"></i> About</a>
					</div>
                </div>
                
               
                </div>
            </div>
    </body>

</html>


<script>
    
    $(document).ready(getCommentNotifications());
    $(document).ready(dropDownComments());
    $(document).ready(getLikeNotifications());
    $(document).ready(dropDownLikes());
    
    
    
</script>


