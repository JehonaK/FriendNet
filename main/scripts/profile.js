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
								<img onclick="openModal(${id})" src="${picture}" id="${id}">
							</div>
							<div class="tweetitem-footer">
								<div class="footerbtn like">
									<span id="${nrLikesId}" style="align-self: center">${nrLikes}</span><i class="fa fa-heart-o" style="cursor:pointer;" onclick="likePhoto(${id}, ${u_id})" id="heart${id}"></i>
								</div>
								<div class="footerbtn comment">
									<span id="${nrCommentsId}" style="align-self: center">${nrComments}</span><i class="fa fa-comment-o" onclick="triggerCommentSection(${id})" style="cursor:pointer;"></i>
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
	for(let i = 0; i < comments.length; i++) {
		let content = comments[i]['content'];
		let comment = document.createElement("div");
		comment.innerHTML = `
			<div class="comment-item-post">
				<span class="commenter-name">${commentersNames[i]}:</span>${content}
			</div>
		`;
		document.getElementById("comment-item" + id).append(comment);
	}
}

function goToProfileById(u_id) {
	window.location.href = "profile.php?id=" + u_id;
}

function triggerCommentSection(post_id) {
	let commentSection = document.getElementById("commentSec"+post_id);
	if(commentSection.style.display == "grid") {
		commentSection.style.display = "none"
	} else {
		commentSection.style.display = "grid"
	}
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
			comment_content: comment_content
		}
	});

	document.getElementById("comment_content" + post_id).value = "";
	let nrCommentsSpan = document.getElementById("nrComments:"+post_id);
	let nrComments = Number(nrCommentsSpan.innerText);
	nrCommentsSpan.innerText = (nrComments + 1);
}

function followUser(followedId, followerId, isMyProfile, u_id) {
	if(isMyProfile) {
			editProfile(u_id);
	} else {
		$.ajax({
			type: 'POST',
			url: '../main/followUser.php',
			data: {
				followedId: followedId,
				followerId: followerId
			}
		});
		if(document.getElementById("followButton").innerText === "Follow") {
			document.getElementById("followButton").innerText = "Following";
		} else {
			document.getElementById("followButton").innerText = "Follow";
		}
	}
	
}

function uploadProfilePicture(ismyprofile){
	if(ismyprofile) {
		var profileChooser=document.getElementById("filechooser");
		profileChooser.click();
		document.getElementById("uploadPP").style.display = "inline";
	}
}

function sendProfilePicToDb(u_id) {
	 let formData = new FormData(document.getElementById("uploadPictureForm"));
	 formData.append('u_id', u_id);
	 $.ajax({
		url: '../main/uploadProfilePicture.php',
	 	type: 'POST',
	 	data: formData,
	 	contentType: false,
        cache: false,
   		processData:false
	 });
	 document.getElementById("uploadPP").style.display = "none";

	 setTimeout(reloadPage, 1500);
}

function reloadPage() {
	location.reload();
}

function editProfile(u_id){
	if(document.getElementById("followButton").innerText == "Save") {

		let nameEdit = document.getElementById('nameEdit').value;
		let bioEdit = document.getElementById('bioEdit').value;
		let locationEdit = document.getElementById('locationEdit').value;

		sendProfilePropsToDb(nameEdit, bioEdit, locationEdit, u_id);

		document.getElementById('nameLabel').innerText = nameEdit;
		document.getElementById('bioLabel').innerText = bioEdit;
		document.getElementById('locationLabel').innerText = locationEdit;

		//
		document.getElementsByClassName("notEditable")[0].style.display="block";
		document.getElementsByClassName("editable")[0].style.display="none";
		document.getElementById("followButton").innerText = "Edit Profile";
	} else {
		document.getElementById("followButton").innerText = "Save";
		document.getElementsByClassName("notEditable")[0].style.display="none";
		document.getElementsByClassName("editable")[0].style.display="block";

		let fullName = document.getElementById('nameLabel').innerText;
		let bio = document.getElementById('bioLabel').innerText;
		let location = document.getElementById('locationLabel').innerText;

		let nameEdit = document.getElementById('nameEdit');
		let bioEdit = document.getElementById('bioEdit');
		let locationEdit = document.getElementById('locationEdit');

		nameEdit.value = fullName;
		bioEdit.value = bio;
		locationEdit.value = location;
	}
	
}

function sendProfilePropsToDb(nameEdit, bioEdit, locationEdit, u_id) {
	 let firstname = nameEdit.substring(0, nameEdit.indexOf(" "));
     let surname = nameEdit.substring(nameEdit.indexOf(" ") + 1, nameEdit.length);
	 $.ajax({
		url: '../main/updateProfile.php',
	 	type: 'POST',
	 	data: {
	 		u_id: u_id,
	 		firstname: firstname,
	 		surname: surname,
	 		bio: bioEdit,
	 		location: locationEdit
	 	}
	 });
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


//{ u_id: ${id}, post_id = ${id} },

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