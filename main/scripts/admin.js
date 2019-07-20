function deleteUser (u_id) {
	$.ajax({
		type: 'POST',
		url: '../main/deleteUser.php',
		data: {
			userID: u_id
		}
	});
}

function show_prompt(u_id) {
        var name = prompt('Please enter the new user role');
        if (name != null && name != "") {
            if(name == "admin" || name == "ADMIN"){
                editUser(u_id,2);
            }else{
                editUser(u_id,1);
            }
        }
}


function editUser (u_id, role_id) {
	$.ajax({
		type: 'POST',
		url: '../main/edit-role.php',
		data: {
			userID: u_id,
            roleID: role_id
		}
	});
}

function search() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[2];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
}
