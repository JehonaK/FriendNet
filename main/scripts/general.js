function logout() {
	$.post("../main/phpscripts/logoutaction.php", function(data, status) {
		$(location).attr('href', '../main/friendnet.html');
	});
}