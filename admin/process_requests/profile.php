<?php
if (isset($_POST)) {
	$user_name = $_POST['username'];
	$full_name = $_POST['fullname'];
			$email = $_POST['email'];
			$mob= $_POST['mob'];
			$designation= $_POST['designation'];
			$department = $_POST['department'];
	$mysqli = new mysqli('localhost', 'root', '', 'certi_validation');

        if ($mysqli->connect_errno) {
         
            echo "Sorry, this website is experiencing problems.";

            echo "Error: Failed to make a MySQL connection, here is why: \n";
            echo "Errno: " . $mysqli->connect_errno . "\n";
            echo "Error: " . $mysqli->connect_error . "\n";
            
            exit;
        }
        $sql = "UPDATE admin
  SET full_name = '{$full_name}',email = '{$email}',mob='{$mob}', department='{$department}',designation='{$designation}' WHERE username='{$user_name}'";
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