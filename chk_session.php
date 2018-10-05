<?php
	ob_start();
	session_start();	
	// if session is not set this will redirect to login page
	if( !isset($_SESSION['user_id']) ) {
		header("Location: ../index.php");
		exit;
	}
	
	?>