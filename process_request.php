<?php
  if (isset($_POST['certificate_no'])) {
  //  echo "request made";
        $res ="";
        $certificate_no=$_POST['certificate_no'];
//echo $certificate_no;
        $mysqli = new mysqli('localhost', 'root', '', 'certi_validation');

        if ($mysqli->connect_errno) {
         
            echo "Sorry, this website is experiencing problems.";

            echo "Error: Failed to make a MySQL connection, here is why: \n";
            echo "Errno: " . $mysqli->connect_errno . "\n";
            echo "Error: " . $mysqli->connect_error . "\n";
            
            exit;
        }
//echo "connection Made";
        $sql = "SELECT * FROM certificate c join events e on c.certi_no = '".$certificate_no."' AND e.event_id =c.event;";
      //  echo $sql;
        if (!$result = $mysqli->query($sql)) {
            echo "Sorry, the website is experiencing problems.";
            echo "Error: Our query failed to execute and here is why: \n";
            echo "Query: " . $sql . "\n";
            echo "Errno: " . $mysqli->errno . "\n";
            echo "Error: " . $mysqli->error . "\n";
            exit;
            echo "queried";
        }
        if ($result->num_rows === 0) {
         
      //  echo "resuler fetched";
            echo "<h3 class='text-danger' style='padding-top: 15px;'>This Certificate is Not Vaid!</h3><p class='lead'> Certificate Number: ---<br>Participent Name: ---<br>Enrollment Number: ---<br>Event Name: ---<br> Organised by: ---<br>Date of Event: ---<br>Position Secured: ---<br>For Further Information Contact:  ---</p>";
            exit;
        }

        $row = $result->fetch_assoc();
        
       // echo $row;
        echo "<h3 class='text-success' style='padding-top: 15px;'>This Certificate is Vaid!</h3><p class='lead'> <b>Certificate Number:</b> ".$row['certi_no']."<br>Participent Name</b>: ".$row['name']."<br><b>Enrollment Number: </b>".$row['enrollment_no']."<br><b>Event Name:</b> ".$row['event_name']."<br> <b>Organised by:</b> ".$row['organiser']."<br><b>Date of Event:</b> ".$row['date']."<br><b>Position Secured:</b> ".$row['position']."<br><b>For Further Information Contact:</b>  ".$row['contact']."</p>" ;

        $result->free();
        $mysqli->close();
      

  }else{
    echo "error";

  }

?>