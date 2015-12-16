<?php
	require_once('../includes/dbConnection.php');
	$my_id = $_GET['my_id'];
	$his_id = $_GET['his_id'];

	$db->query("CALL Accept_Or_Reject_Friendship({$his_id},{$my_id},FALSE)");
	echo '<small style="color:red">You rejected the request.</small>';

?>