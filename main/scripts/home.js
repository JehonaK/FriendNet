
var srcLastChosenPhoto = "";

function populatePost(id, postContent, picture, creation_time, name, username, u_id, isLiked, nrLikes, nrComments, comments, postUserId, profilePic, commentersNames, signedInName, creationDate) {
	let list = document.getElementById("postsList");
	let li = document.createElement("li");
	let nrLikesId = "nrLikes:" + id;
	let nrCommentsId = "nrComments:" + id;

	li.innerHTML = `<div class="atweetitem" id="${id}">
						<div class="tweetitem-left">
							<img src="${profilePic}" onclick="goToProfileById(${postUserId})">
						</div>
						<div class="tweetitem-right">
							<div class="tweetitem-header">
								<a href="profile.php?id=${postUserId}"><span class="tweetitem-fullname">${name}</span></a>
								<a href="profile.php?id=${postUserId}"><span class="tweetitem-username">@${username}</span></a>
								<span class="tweetitem-timestamp"> · ${creationDate}</span>
							</div>
							<div class="tweetitem-title">${postContent}</div>
							<div class="tweetitem-content">
								<img src="${picture}" onclick="openModal(${id})" id="inner${id}">
							</div>
							<div class="tweetitem-footer">
								<div class="footerbtn like">
									<span id="${nrLikesId}" style="align-self: center">${nrLikes}</span> <i class="fa fa-heart-o" style="cursor:pointer;" onclick="likePhoto(${id}, ${u_id})" id="heart${id}"></i>
								</div>
								<div class="footerbtn comment">
									<span id="${nrCommentsId}" style="align-self: center">${nrComments}</span> <i class="fa fa-comment-o" style="cursor:pointer;" onclick="triggerCommentSection(${id})" id="commentLogo${id}"></i>
								</div>
							</div>
							<div id="commentSec${id}" class="comment_section">
								<div class="input-comment">
									<input type="textarea" id="comment_content${id}">
									<button onclick="postComment(${id}, ${u_id}, '${signedInName}')">post</button>
								</div>
								<div class="comment-item" id="comment-item${id}">

								<div>
							</div>
						</div>
					</div>`;
	list.prepend(li);
	if(isLiked) {
		document.getElementById("heart"+id).style.color = "red";
	}
	// listAllComments(id);
    // for(let i = 0; i < comments.length; i++) {
  		//console.log(comments);
		// document.getElementById("commentSec" + id).append(comments.length);
	// }
	for(let i = 0; i < comments.length; i++) {
		let content = comments[i]['content'];
		let comment = document.createElement("div");
		comment.innerHTML = `
			<div class="comment-item-post">
				<span class="commenter-name">${commentersNames[i]}:</span>${content}
			</div>
		`;
		document.getElementById("comment-item" + id).append(comment);
		// let content = comments[i]['content'];
		// document.getElementById("commentSec" + id).append("Rinor: " + content);
	}
}

function goToProfileById(u_id) {
	window.location.href = "profile.php?id=" + u_id;
}

// <?php
// 	$allComments = $posts->getAllCommentsByPostId(${id});
// 	foreach($allComments as $row) {
// 		$comment_id = $row['id'];
// 		$comment_content = $row['content'];
// 		$comment-item-id = "comment-item".$comment_id;
// 		$commenter = $posts->getUserByCommentId($comment_id);
// 		echo "<div class=\"comment-item\" id=\"comment-item-id\">
// 				$commenter['name'] : $comment_content;
// 			 </div>";
// 	}
// ?>

// function listAllComments(post_id) {
// 	$.ajax({
// 		type: 'GET',
// 		url: '../main/getCommentsForAPost.php',
// 		dataType: 'json',
// 		data: {
// 			post_id: post_id
// 		},
// 		success: function(data) {
// 			var jsondata = JSON.parse(data);
// 			for(let comment of jsondata) {
				
// 			}
// 		}
// 	});
// }

function triggerCommentSection(post_id) {
	let commentSection = document.getElementById("commentSec"+post_id);
	if(commentSection.style.display == "grid") {
		commentSection.style.display = "none"
	} else {
		commentSection.style.display = "grid"
	}
}

function postComment(post_id, u_id, name) {
	let comment_content = document.getElementById("comment_content" + post_id).value;
	let comment = document.createElement("div");
	comment.innerHTML = `
		<div class="comment-item-post">
			<span class="commenter-name">${name}:</span>${comment_content}
		</div>
	`;
	document.getElementById("comment-item" + post_id).append(comment);


	$.ajax({
		type: 'POST',
		url: '../main/addComment.php',
		data: {
			u_id: u_id,
			post_id: post_id,
			comment_content: comment_content,
			name: name
		}
	});

	document.getElementById("comment_content" + post_id).value = "";
	let nrCommentsSpan = document.getElementById("nrComments:"+post_id);
	let nrComments = Number(nrCommentsSpan.innerText);
	nrCommentsSpan.innerText = (nrComments + 1);
}

function followSuggestion(followerId, followedId, itemIndex) {
	$.ajax({
		type: 'POST',
		url: '../main/followUser.php',
		data: {
			followedId: followedId,
			followerId: followerId
		}
	});

	if(document.getElementById("followSuggestion" + itemIndex).innerText === "Follow") {
		document.getElementById("followSuggestion" + itemIndex).innerText = "Following";
	} else {
		document.getElementById("followSuggestion" + itemIndex).innerText = "Follow";
	}
}

function likePhoto (id, u_id) {
	$.ajax({
		type: 'POST',
		url: '../main/likePost.php',
		data: {
			postID: id,
			userID: u_id
		}
	});
	let nrLikesSpan = document.getElementById("nrLikes:"+id);
	let nrLikes = Number(nrLikesSpan.innerText);
	if(document.getElementById("heart"+id).style.color === "red") {
		document.getElementById("heart"+id).style.color = "#788a98";
		nrLikes = nrLikes - 1;
	} else {
		document.getElementById("heart"+id).style.color = "red";
		nrLikes = nrLikes + 1;
	}
	nrLikesSpan.innerText = nrLikes;
}




function enlargeTextBoxOnFocus() {
	let whatshappening = document.getElementById("centerContent");
	whatshappening.style.gridTemplateRows = "120px";

	let profilePic = document.getElementById("newPostProfilePic");
	profilePic.style.marginTop = "15px";

	let galleryButton = document.getElementById("galleryBtn");
	galleryButton.style.marginTop = "15px";

	let sendButton = document.getElementById("makePostBtn");
	sendButton.style.fontSize = "22px";
	sendButton.style.marginTop = "40px";
}

function smallTextBoxOnFocus() {
	let whatshappening = document.getElementById("centerContent");
	whatshappening.style.gridTemplateRows = "52px";

	let profilePic = document.getElementById("newPostProfilePic");
	profilePic.style.marginTop = "10px";

	let galleryButton = document.getElementById("galleryBtn");
	galleryButton.style.marginTop = "10px"

	let sendButton = document.getElementById("makePostBtn");
	sendButton.style.fontSize = "0px";
	sendButton.style.marginTop = "0px";
}

function addPost(u_id) {
	let postTextValue = document.getElementById("postTextAreaField").value;
	let hashTag = "";
	if (postTextValue.includes("#")) {
		let cutText = postTextValue.subtring(postTextValue.indexOf("#"), postTextValue.length);
		let endIndex = cutText.indexOf(" ");
		if(endIndex == -1) {
			endIndex = cutText.length;
		}
		hashTag = cutText.subtring(1, endIndex);
		if(hashTag.length < 1) {
			hashTag = "";
		}
	}
	sendToDb(u_id, postTextValue, hashTag);
	setTimeout(reloadPage, 1500);
}

function sendToDb(u_id, content, hashTag){
	 let formData = new FormData(document.getElementById("uploadForm"));
	 formData.append('u_id', u_id);
	 formData.append('content', content);
	 formData.append('hashTag', hashTag);
	 $.ajax({
		url: '../main/uploadPhoto.php',
	 	type: 'POST',
	 	data: formData,
		contentType: false,
        cache: false,
   		processData:false
	 });
}

function reloadPage() {
	location.reload();
}


function justalert() {
	alert("nothing");
}

function chooseFile() {
	let filechooser = document.getElementById("filechooser");
	filechooser.click();

	// let picture = filechooser.files[0];
	// let reader = new FileReader();

	// let src = "";

	// reader.loadend = function() {
	// 	src = reader.result;
	// }

	// reader.onload = function() {
	// 	document.getElementById("galleryBtn").style.color = "#23658e";
	// }

	// srcLastChosenPhoto = `https://picsum.photos/700/550?t=${Date.now()}`;
}

function toggleCommentSection() {
	if(document.getElementById("first-c-section").style.display == "grid") {
		document.getElementById("first-c-section").style.display = "none";
	} else {
		document.getElementById("first-c-section").style.display = "grid";
	}
	
}

function doSearch(){
    $(document).ready(function(){
                $('#search').keyup(function(){
                    var name = $(this).val();
                    
                    if(name != ""){
                        $.post('../main/phpscripts/get_users.php', { name:name }, function(data){
                        
                            $('div#back_result').css({'display':'block'});
                            $('div#back_result').html(data);
                        
                        });
                    }else{
                         remove_results();
                    }
                    
                    
                });
                
                
                
            });
}

function remove_results(){
    document.querySelector("#back_result").style.display = "none";
}



function openModal(idImg){
	var modal = document.getElementById("myModal");
	var img = document.getElementById(idImg);
	var modalImg = document.getElementById("img01");
	modal.style.display = "block";
	modalImg.src = img.src;
}
  
  // Get the <span> element that closes the modal
 
  
  // When the user clicks on <span> (x), close the modal
  function closeModalin() { 
	var modal = document.getElementById("myModal");
	var span = document.getElementsByClassName("close")[0];
	modal.style.display = "none";
  }

// Comment notification part

function getCommentNotifications(){
 
 function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"fetchCommentNotifications.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
    $('.dropdown-menu').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }
   }
  });
 }
 
 load_unseen_notification();
 
$(document).on('click', '.dropdown-btn', function(){
   $('.count').html('');
   load_unseen_notification('yes');
  });
 
 setInterval(function(){ 
  load_unseen_notification();; 
 }, 5000);
 
}

function getLikeNotifications(){
 
 function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"fetchLikeNotifications.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
    $('.dropdown-menu-likes').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count-likes').html(data.unseen_notification);
    }
   }
  });
 }
 
 load_unseen_notification();
 
$(document).on('click', '.dropdown-btn-likes', function(){
   $('.count-likes').html('');
   load_unseen_notification('yes');
  });
 
 setInterval(function(){ 
  load_unseen_notification();; 
 }, 5000);
 
}

function dropDownComments(){
var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
      dropdown[i].addEventListener("click", function () {
        this.classList.toggle("active");
        var dropdownContent = document.getElementById("dropdown-container");
        if (dropdownContent.style.display === "block") {
          dropdownContent.style.display = "none";
        } else {
          dropdownContent.style.display = "block";
        }
      });
    }
}

function dropDownLikes(){
var dropdown = document.getElementsByClassName("dropdown-btn-likes");
    var i;

    for (i = 0; i < dropdown.length; i++) {
      dropdown[i].addEventListener("click", function () {
        this.classList.toggle("active");
        var dropdownContent = document.getElementById("dropdown-container-likes");
        if (dropdownContent.style.display === "block") {
          dropdownContent.style.display = "none";
        } else {
          dropdownContent.style.display = "block";
        }
      });
    }
}
// comment notification part finish