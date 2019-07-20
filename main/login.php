<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Log In</title>
	<link rel="stylesheet" type="text/css" href="styles/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/theme-default.min.css"
          rel="stylesheet" type="text/css" />
</head>
<body>
	<div class="container">
			<div class="login-main">
				<div class="imgcontainer">
					<img src="images/jehona_logo.png" style="width: 200px; float: center;" class="avatar">
				</div>
				<form method="POST" action="phpscripts/loginaction.php" name="login-form">
					<div>
						<label for="uname"><b>Email Address</b></label>
					    <input type="text" name="email" data-validation = "email" data-validation-error-msg="Email/Password combination incorrect!" >

					    <label for="psw"><b>Password</b></label>
					    <input type="password" name="password_confirmation" data-validation = "required" data-validation-error-msg="Email/Password combination incorrect!" >
					    <label>
					      <input class="checkbox" type="checkbox" checked="checked" name="remember"> Remember this device <a href="">  ·  Forgot password?</a>
		    			</label>
		    			<button type="submit">Log In</button>
					</div>
				</form>
				
				<div class="help-div">
					<p>
						Need help? <a href="">Visit our Help Center.</a>
					</p>
				</div>
			</div>
			<div class="login-secondary">
				© 2019 
				<a href="friendnet.html">FriendNet</a>
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

    </script>
</body>
</html>