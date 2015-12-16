<?php
	require_once('../includes/dbConnection.php');
	$my_id = $_GET['my_id'];
	$his_id = $_GET['his_id'];
	$message_text = mysql_real_escape_string($_GET['message_text']);
	$db->query("CALL Send_Message_To_Friend({$my_id},{$his_id},'{$message_text}')");

	require_once('message_thread.php');

?>