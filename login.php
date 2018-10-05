<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login | SATI Certificate Validation</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	    <link rel="icon" href="img/logo.ico">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">


	<link rel="stylesheet" type="text/css" href="css/style.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="img/college-logo.png" alt="IMG">
					<h4>Samrat Ashok Technological Institute</h4>
				</div>

				<form class="login100-form validate-form" id="login_form">
					<span class="login100-form-title">
						Admin Login
					</span>
					<div id="err"></div>
					<div class="wrap-input100 validate-input" data-validate = "Username can not be empty">
						<input class="input100" type="text" name="user_name" placeholder="User Name">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" id="login">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!--===============================================================================================-->
	<script src="js/bootstrap.min.js"></script>
<!--===============================================================================================-->

	<script src="js/script.js"></script>
<script>
	var input = $('.validate-input .input100');

    $('#login').on('click',function(e){
      e.preventDefault();
        var check = true;
    //    console.log("event triggered");
        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }
       // console.log(check);
      //  console.log(input);
        if (check==true) {
       // 	console.log("going to make request");
          $.ajax({
            url: 'login_requests.php',
            type: 'post',
            data: {username: input[0].value,pass:input[1].value}
          })
          .done(function(data) {
        //  	console.log(data);
            if (data=="ok") {
            	window.location.replace("admin/dashboard.php");
            }else{
              $("#err").html("Invalid Username or Password!!!");
            }
          });
          }else{
          	console.log("request not made");
          }
    });


    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }
    
    

</script>
</body>
</html>