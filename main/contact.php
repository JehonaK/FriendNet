<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">	
        <link rel="stylesheet" type="text/css" href="styles/contactStyle.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script type="text/javascript" src="scripts/home.js"></script>
        <script type="text/javascript" src="../main/scripts/general.js"></script>
        <script type="text/javascript" src="../main/scripts/jquery.js"></script>
        <title>Contact</title>
    </head>
    
    <body>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
        <script>
          $.validate({
            validateOnBlur : false,
            errorMessagePosition : 'top',
            showHelpOnFocus : false,
            addSuggestions : false
          });
        </script>
        
        <div class = "content">        
            <div class="mid-content">
                <div class="top-mid">
                    <h1 id="contact-title"style="color:#45a29e;">Contact Support Team</h1>
                </div>
                <form class="mid-mid" method="POST" action="phpscripts/submitContactForm.php" name="contact-form">
                    <div class="problem-intro formitem">
                        <h3>What is your problem?</h3>
                        <label class="option-container option-item">I am having problems with creating a new account
                            <input type="checkbox" name="problem[]" value="creatingAccount">
                            <span class="checkmark"></span>
                        </label>
                        <label class="option-container option-item">Messages not coming in real time
                            <input type="checkbox" name="problem[]" value="messagesNotComming">
                            <span class="checkmark"></span>
                        </label>
                        <label class="option-container option-item">I cannot upload images for my posts
                            <input type="checkbox" name="problem[]" value="cannotUploadImages">
                            <span class="checkmark"></span>
                        </label>
                        <label class="option-container option-item">Notifications not showing up
                            <input type="checkbox" name="problem[]" value="notificationsNotShowing">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="problem-details formitem">
                        <h3>Describe your problem in detail:</h3>
                        <textarea value="" data-validation="required" name="problemDescription" data-validation-error-msg="<br>This field is required"></textarea>
                    </div>
                    <div class="choosing-contact formitem">
                        <h3>How do you want to be contacted in behalf of this problem?</h3>
                        <label class="radio-option-container option-item">Through this account  email
                            <input type="radio" name="radio-contact" data-validation="required" data-validation-error-msg="<br>This field is required" value="default">
                            <span class="checkmark-radio"></span>
                        </label>
                        <label class="radio-option-container option-item">Another Email
                            <input type="radio" name="radio-contact" data-validation="required" data-validation-error-msg="<br>This field is required" value="another">
                            <span class="checkmark-radio"></span>
                        </label>
                    </div>
                    <div class="email-section formitem">
                        <h3>Enter your email:</h3>
                        <input type="text" name="email" data-validation="email" data-validation-error-msg="<br>Please enter a valid email address">
                    </div>
                    <div class="submission-section formitem">
                        <button type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>  
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
        <script>
          $.validate({
            validateOnBlur : false,
            errorMessagePosition : 'right',
            showHelpOnFocus : false,
            addSuggestions : false
          });
        </script>
    </body>

</html>