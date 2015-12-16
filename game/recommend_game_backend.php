<?php
	require_once('../includes/dbConnection.php');
	$my_id = $_SESSION['id'];
	$his_id = $_GET['id'];
	$game_id = $_GET['g_id'];

	$db->query("CALL Recommend_Game_To_Normal_Member({$my_id},{$his_id},{$game_id})");

?>