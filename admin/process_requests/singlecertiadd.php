<?php
if (isset($_POST)) {
	$event = $_POST['event'];
			$certi_no = $_POST['certino'];
			$enroll = $_POST['enrollment'];
			$name = $_POST['name'];
			$position = $_POST['position'];
	$mysqli = new mysqli('localhost', 'root', '', 'certi_validation');

        if ($mysqli->connect_errno) {
         
            echo "Sorry, this website is experiencing problems.";

            echo "Error: Failed to make a MySQL connection, here is why: \n";
            echo "Errno: " . $mysqli->connect_errno . "\n";
            echo "Error: " . $mysqli->connect_error . "\n";
            
            exit;
        }
        $sql = "INSERT INTO `certificate` (`certi_no`, `event`, `name`, `position`, `enrollment_no`) VALUES ('{$certi_no}', '{$event}', '{$name}','{$position}','{$enroll}');";
				      //  echo $sql;
				        if ($mysqli->query($sql) === TRUE) {
				    	echo "all ok";
				} else {
				     echo "not ok";
				}

				$mysqli->close();
}else{
	echo "No Post Data";
}
	
?>