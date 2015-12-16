<?php
	require_once('../includes/dbConnection.php');
	if(isset($_SESSION))
		session_destroy();
	header('Location: http://localhost/GameReviews/');

?>