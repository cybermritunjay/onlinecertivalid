<?php

 $mysqli = new mysqli('localhost', 'root', '', 'certi_validation');

        if ($mysqli->connect_errno) {
         
            echo "Sorry, this website is experiencing problems.";

            echo "Error: Failed to make a MySQL connection, here is why: \n";
            echo "Errno: " . $mysqli->connect_errno . "\n";
            echo "Error: " . $mysqli->connect_error . "\n";
            
            exit;
        }
//echo "connection Made";
    $sql= "SELECT * FROM admin a join events e on a.id = '{$_SESSION['user']}' AND e.created_by=a.id";
   
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
            echo "No Such User";
            header("Location: ../index.php");
            exit;
        }

      $event_id = array();
      $event_name= array();
      $organiser= array();
      $contact= array();
      $date= array();
      $locked= array();
      $logo = array();
      $i=0;
    
      $total_events = $result->num_rows;

      while (  $row = $result->fetch_assoc()) {
        $event_id[$i] = ucfirst($row['event_id']);
        $event_name[$i] = ucfirst($row['event_name']);
        $organiser[$i] = ucfirst($row['organiser']);
        $contact[$i] = ucfirst($row['contact']);
        $date[$i] = date('Y-m-d',strtotime(ucfirst($row['date'])));
        $locked[$i] = ucfirst($row['locked']);
        if ($row['logo']) {
          $logo[$i] = $row['logo'];
        }else{
          $logo[$i] = "assets/img/logos/default.png";
        }
          $user_name = $row['username']; 
      $email = $row['email'];
      $full_name = ucfirst($row['full_name']);
      $department = ucfirst($row['department']);
      $designation = ucfirst($row['designation']);
      $phone = ucfirst($row['mob']);
       if ($row['avatar']) {
        $avatar = $row['avatar'];
      }else{
        $avatar = "assets/img/default.jpg";
      }
       if ($row['cover']) {
        $cover = $row['cover'];
      }else{
        $cover = "assets/img/covers/default.jpg";
      }

        $i++;
      }
    
     $unlocked =array();
     $in = 0;

     for ($k=0; $k < sizeof($locked) ; $k++) { 
       if ($locked[$k] == '0') {
         $unlocked[$in]= $locked[$k];
         $in++;
       }
     }
     

      ?>      
