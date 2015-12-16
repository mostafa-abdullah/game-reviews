<?php
	require_once('../includes/dbConnection.php');
	$my_id = $_GET['my_id'];
	$his_id = $_GET['his_id'];

	$db->query("CALL Accept_Or_Reject_Friendship({$his_id},{$my_id},TRUE)");
	echo '<small style="color:green">You are now friends</small>';

?>