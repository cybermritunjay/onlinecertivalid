<html lang="en" class="gr__getbootstrap_com"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/logo.ico">

    <title>SATI | Certificate Validation</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">

  </head>

  <body data-gr-c-s-loaded="true" class="gorgias-loaded">

    <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand"><img src="img/college-logo.png" width="40" height="50"></h3>
              <nav>
                <ul class="nav masthead-nav">
                  <li class="active"><a href="#">Home</a></li>
                  <li><a href="login.php">Master Login</a></li>
                  <li><a href="#">Contact</a></li>
                </ul>
              </nav>
            </div>
          </div>

          <div class="inner cover">
            <h1 class="cover-heading">VALIDATE CERTIFICATE</h1>
            <form id="valform">
                  <div class="form-group">
                    <label for="certificate_no">Certificate Number</label>
                    <input type="text" class="form-control" name="certificate_no" id="certificate_no"placeholder="Enter Certificate Number"> 
                  </div>
                <p class="lead" id="err"></p>
              <button class="btn btn-lg btn-success" id="validate">Validate</button>
            
            </form>
          </div>

          <div class="mastfoot">
            <div class="inner">
              <p>Certificate Validation for <a href="http://satiengg.in">S.A.T.I.</a>, by <a href="https://fb.com/cybermritunjay">mritunjay</a>.</p>
            </div>
          </div>

        </div>

      </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
  <script>
    document.getElementById('validate').addEventListener("click", function(event) {
  event.preventDefault();
  var certificate_no = document.getElementById('certificate_no').value;
  if (certificate_no != "") {
    $.ajax({
      url: 'process_request.php',
      type: 'post',
      data: {certificate_no: certificate_no},
    })
    .done(function(data) {
      console.log(data);
      if (data == "error") {
        document.getElementById("err").innerHTML = "Something Went Wrong";
      }else{
        document.getElementById("valform").innerHTML = data;
      }
    });
    
  }else{
    document.getElementById("err").innerHTML = "Enter Certificate Number";
  }

});
  </script>
</body>

</html>