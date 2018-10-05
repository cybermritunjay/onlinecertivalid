<?php 
if (isset($_POST['certificate_no'])) {
    $result_Text="";
        $res ="";
        $certificate_no=$_POST['certificate_no'];

        ?><html lang="en" class="gr__getbootstrap_com"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>SATI | Certificate Validation</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">

  </head>

  <body data-gr-c-s-loaded="true" class="gorgias-loaded">
<script>
  console.log("<?php echo $certificate_no; ?>");
</script>
    <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">
  <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand"><img src="img/college-logo.png" width="40" height="50"></h3>
              <nav>
                <ul class="nav masthead-nav">
                  <li class="active"><a href="http://www.satiengg.in">Home</a></li>
                  <li><a>Master Login</a></li>
                  <li><a href="#">Contact</a></li>
                </ul>
              </nav>
            </div>
          </div>
          <div class="inner cover">
            <h1 class="cover-heading">This Certificate is Vaid!</h1>
            <p class="lead" id="result">
              <?php
  
        $mysqli = new mysqli('localhost', 'root', '', 'certi_validation');

        if ($mysqli->connect_errno) {
         
            echo "Sorry, this website is experiencing problems.";

            echo "Error: Failed to make a MySQL connection, here is why: \n";
            echo "Errno: " . $mysqli->connect_errno . "\n";
            echo "Error: " . $mysqli->connect_error . "\n";
            
            exit;
        }

        $sql = "SELECT * FROM certificate c join events e on c.certi_no = '".$certificate_no."' AND e.event_id =c.event;";
        
        if (!$result = $mysqli->query($sql)) {
            echo "Sorry, the website is experiencing problems.";
            echo "Error: Our query failed to execute and here is why: \n";
            echo "Query: " . $sql . "\n";
            echo "Errno: " . $mysqli->errno . "\n";
            echo "Error: " . $mysqli->error . "\n";
            exit;

        if ($result->num_rows === 0) {
         
        
            $res = "This Certificate is NOT-Vaid!";
            $result_Text =" Certificate Number: ---<br>Participent Name: ---<br>Enrollment Number: ---<br>Event Name: ---<br> Organised by: ---<by>Date of Event: ---<br>Position Secured: ---<br>For Further Information Contact:  ---";
            exit;
        }

        $row = $result->fetch_assoc();
        

        $res = "This Certificate is Vaid!";
        $result_Text=" Certificate Number: ".$row['certi_no']."<br>Participent Name: ".$row['name']."<br>Enrollment Number:".$row['enrollment_no']."<br>Event Name: ".$row['event_name']."<br> Organised by: ".$row['organiser']."<by>Date of Event: ".$row['date']."<br>Position Secured: ".$row['position']."<br>For Further Information Contact:  ".$row['contact'] ;

 
?><?php echo $result_Text; ?><?php        $result->free();
        $mysqli->close();
      }

  }else{
    header('LOCATION: index.php');
  }
?></p>
            <p class="lead">
              <a href="#" class="btn btn-lg btn-default">Contact</a>
            </p>
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
      window.onload = function() {
  document.getElementById('result').innerHTML = "<?php echo $result_Text; ?>";
};
    </script>
  
</body>

</html>