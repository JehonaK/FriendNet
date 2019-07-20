<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sign Up</title>
	<link rel="stylesheet" type="text/css" href="styles/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/theme-default.min.css"
          rel="stylesheet" type="text/css" />
</head>
<body>
	<div class="container">
		<div>
			<div class="login-main">
				<div class="imgcontainer">
					<img src="images/jehona_logo.png" style="width: 200px; float: center;" class="avatar">
				</div>
				<div class="sign-up-page">
					<form method="POST" action="phpscripts/signupaction.php" name="signup-form">
						<div class="signup-information">
							<div class="name">
								<label for="name"><b>Firstname</b></label>
						    	<input type="text" name="name" data-validation="custom" data-validation-regexp="^([a-zA-Z]+)$" data-validation-error-msg="Enter your name" >
							</div>

							<div class="lastname">
								<label for="surname"><b>Lastname</b></label>
						    	<input type="text" name="surname" data-validation="custom" data-validation-regexp="^([a-zA-Z]+)$" data-validation-error-msg="Enter your surname" >
							</div>

							<div class="email">
								<label for="email"><b>Email</b></label>
						    	<input type="text" name="email" data-validation = "email" data-validation-error-msg="Enter a valid email address">
							</div>

							<div class="birth-date">
								<label for="birth-date"><b>Birth-Date</b></label>
                                <label id="lblError"></label>

						    	<input id = "txtDate" type="text" data-date-format="DD MMMM YYYY" name="birth-date" onblur="ValidateDOB()">
							</div>

							<div class="gender">
								<label for="gender"><b>Gender</b></label>
								<div class="gender-options" >
									<input type="radio" name="gender" value="male" data-validation = "required" data-validation-error-msg="Choose a gender" > Male<br>
									<input type="radio" name="gender" value="female" data-validation = "required" data-validation-error-msg="Choose a gender" > Female<br>
								</div>
							</div>

							<div class="username">
								<label for="username"><b>Username</b></label>
						    	<input type="text" name="username" data-validation="custom" data-validation-regexp="^([a-zA-Z0-9]+)$" data-validation-error-msg="Enter a valid username">
							</div>

							<div class="password">
								<label for="password"><b>Password</b></label>
						    	<input id = "password" type="password" name="password_confirmation" data-validation="length" data-validation-length="min6" data-validation-error-msg="Enter a valid password (min 6 characters)">
							</div>

							<div class="confirm-password">
                                <label for="confirm-password"><b>Confirm Password</b></label>
                                <label id='message'></label>
						    	<input id = "confirm_password" type="password" name="confirm-password" >
                                
							</div>
						</div>
						<button type="submit" name="signup-submit">Sign Up</button> 
					</form>
				</div>
				<div class="help-div">
					<p>
						Need help? <a href="">Visit our Help Center.</a>
					</p>
				</div>
			</div>
			<div class="login-secondary">
				© 2019 
				<a href="">FriendNet</a>
			</div>
		</div>	
	</div>
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="scripts/jqueryValidation.js"></script>
    <script>
        $.validate({
        validateOnBlur : false,
        errorMessagePosition : 'top',
        showHelpOnFocus : false,
        addSuggestions : false
        });
        
        $('#password, #confirm_password').on('keyup', function () {
        if ($('#password').val() == $('#confirm_password').val()) {
        $('#message').html('<img src = "images/validationChecked.png"/>').css('color', 'green');
        } else 
            $('#message').html('<img src = "images/validationError.png"/>').css('color', 'red');
        });
        
    </script>
    
    <script type="text/javascript">
    function ValidateDOB() {
        var lblError = document.getElementById("lblError");
 
        //Get the date from the TextBox.
        var dateString = document.getElementById("txtDate").value;
        var regex = /(((0|1)[0-9]|2[0-9]|3[0-1])\/(0[1-9]|1[0-2])\/((19|20)\d\d))$/;
 
        //Check whether valid dd/MM/yyyy Date Format.
        if (regex.test(dateString)) {
            var parts = dateString.split("/");
            var dtDOB = new Date(parts[1] + "/" + parts[0] + "/" + parts[2]);
            var dtCurrent = new Date();
            lblError.innerHTML = "You must be over 18 to sign up!";
            lblError.style.color="red";

            if (dtCurrent.getFullYear() - dtDOB.getFullYear() < 18) {
                return false;
            }
 
            if (dtCurrent.getFullYear() - dtDOB.getFullYear() == 18) {
 
                //CD: 11/06/2018 and DB: 15/07/2000. Will turned 18 on 15/07/2018.
                if (dtCurrent.getMonth() < dtDOB.getMonth()) {
                    return false;
                }
                if (dtCurrent.getMonth() == dtDOB.getMonth()) {
                    //CD: 11/06/2018 and DB: 15/06/2000. Will turned 18 on 15/06/2018.
                    if (dtCurrent.getDate() < dtDOB.getDate()) {
                        return false;
                    }
                }
            }
            lblError.innerHTML = "";
            return true;
        } else {
            lblError.innerHTML = "Wrong date-format! (DD/MM/YYYY)"
            lblError.style.color="red";
            return false;
        }
    }
    </script>
</body>
</html>