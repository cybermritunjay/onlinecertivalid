<?php
  if (isset($_POST)) {
  //  echo "request made";
        $event_name=$_POST['event_name'];
        $organiser = $_POST['event_organiser'];
        $contact = $_POST['contact_person'];
        $date = $_POST['event_date'];
        $created_by= $_POST['user'];
        $logo = $_POST['logo'];
        $locked = 0;
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
        $sql = "INSERT INTO `events` (`event_name`, `organiser`, `contact`, `date`, `created_by`, `locked`,`logo`) VALUES ('{$event_name}', '{$organiser}', '{$contact}', '{$date}', '{$created_by}', '{$locked}','{$logo}');";
      //  echo $sql;
        if ($mysqli->query($sql) === TRUE) {
    echo "all ok";
} else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
}
$mysqli->close();

  }else{
    echo "error";

  }

?>