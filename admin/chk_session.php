<?php
	ob_start();
	session_start();	
	// if session is not set this will redirect to login page
	if( !isset($_SESSION['user']) ) {
		header("Location: ../index.php");
		exit;
	}
	?>
	
	