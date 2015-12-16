<?php
	require_once('../includes/dbConnection.php');
 $my_id = $_GET['my_id'];
 $his_id = $_GET['his_id'];
 $db->query("INSERT INTO NormalMember_AddFriend_NormalMember (m1_id,m2_id) VALUES ({$my_id},{$his_id})");
 
?>
<a href="#" id="friend_request_sent" disabled style="" class=" btn btn-info">Request sent</a>