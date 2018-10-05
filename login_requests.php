<?php
  if (isset($_POST)) {
  //  echo "request made";
        $user_name=$_POST['username'];
        $pass=$_POST['pass'];
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
        $sql = "SELECT * FROM admin WHERE username= '".$user_name."';";
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
            echo "not found";
            exit;
        }else{
            $row = $result->fetch_assoc();
            if ($row['pass'] == $pass) {
                session_start();
                $_SESSION['user'] = $row['id'];
                echo "ok" ;
            }else{
                echo "password error";
            }
       // echo $row;
        

        }

        
        $result->free();
        $mysqli->close();
      

  }else{
    echo "error";

  }

?>