
function populateConversation(con_id, participant_name, participant_username, last_message) {
	let list = document.getElementById('conversationList');
	let li = document.createElement("li");

	li.innerHTML = `<div class="conversation" id="${con_id} onclick="just()">
						<div class="picture">
							<img src="images/13.jpg">
						</div>
						<div class="thumbnail">
							<div class="profile-name">
								<span class="fullname">${participant_name}</span>
								<span class="username">@${participant_username}</span>
							</div>
							<div class="last-message">
								<span>${last_message}</span>
							</div>
						</div>
						<div class="timestamp">
							<span>May 6</span>
						</div>
					</div>`;

	list.prepend(li);
}

function just() {
	alert("HEY");
}

