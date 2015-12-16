<?php
	$team = $db->query("SELECT * FROM Games G INNER JOIN developmentteam_develops_game DDG on G.g_id = DDG.g_id
		INNER JOIN Development_Teams DT ON DDG.team_id = DT.id WHERE G.g_id = {$_GET['id']}
		");

	$team = $team->fetch_object();

	if(!$team){
		echo 'Developer: Unknown';
	}

	else
		echo 'Developed by: <a href="user.php?id='.$team->id.'">'.$team->team_name.'</a>';

?>