<?php
	require_once('../includes/dbConnection.php');
	$my_id = $_GET['my_id'];
	$his_id = $_GET['his_id'];

	$db->query("DELETE FROM NormalMember_AddFriend_NormalMember WHERE ( m1_id = {$my_id} AND m2_id = {$his_id} ) OR ( m1_id = {$his_id} AND m2_id= {$my_id} ) ");




?>
<a href="#" disabled class="btn btn-info">Unfriended</a>