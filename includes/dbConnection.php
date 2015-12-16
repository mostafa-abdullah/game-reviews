<?php
	if(!isset($_SESSION))
		session_start();
	$db = new mysqli('localhost','root','','gamereviews');
	if(!$db)
		die('Error connecting to the database');

	$default_pp = 'http://localhost/GameReviews/art/profile_default.jpg';
	// $dob = date("Y/m/d",strtotime('1995-2-1'));
	// echo $dob;
	//error_reporting(0);
	


?>