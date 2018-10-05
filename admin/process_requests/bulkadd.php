<?php
	if (isset($_POST)) {
		$event = $_POST['event'];
		unset($_POST['event']);
		$total=count($_POST);
		$caeri_no = array();
		$enroll = array();
		$name = array();
		$position = array();

		for ($i=0; $i <$total/4 ; $i++) { 
			$certi_no[$i] = $_POST['certino'.$i];
			$enroll[$i] = $_POST['enrollment'.$i];
			$name[$i] = $_POST['name'.$i];
			$position[$i] = $_POST['position'.$i];
		}
		$mysqli = new mysqli('localhost', 'root', '', 'certi_validation');

        if ($mysqli->connect_errno) {
         
            echo "Sorry, this website is experiencing problems.";

            echo "Error: Failed to make a MySQL connection, here is why: \n";
            echo "Errno: " . $mysqli->connect_errno . "\n";
            echo "Error: " . $mysqli->connect_error . "\n";
            
            exit;
        }
        $progress = array();
        for ($j=0; $j <$total/4 ; $j++) { 
        	$sql = "INSERT INTO `certificate` (`certi_no`, `event`, `name`, `position`, `enrollment_no`) VALUES ('{$certi_no[$j]}', '{$event}', '{$name[$j]}','{$position[$j]}','{$enroll[$j]}');";
				      //  echo $sql;
				        if ($mysqli->query($sql) === TRUE) {
				    	$progress[$j]= "all ok";
				} else {
				     $progress[$j]= "not ok";
				}
        	        }
        	        if (in_array("not ok", $progress))
						  {
						  echo "Not Inserted";
						  }
						else
						  {
						  echo "all ok";
						  }
						  $mysqli->close();
	}else{
		echo "No Post Data";
	}

?>