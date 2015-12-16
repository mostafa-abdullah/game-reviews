<?php

$games = $db->query("SELECT * FROM developmentteam_develops_game WHERE team_id = {$id}");

echo "<h3><small>$team_name developed $games->num_rows games</small></h3>";

if($games->num_rows){
	while($game = $games->fetch_object()){
		$game_vars  = $db->query("SELECT g_name FROM Games WHERE g_id = {$game->g_id}")->fetch_object();
		?>
		<div class="media" style=" background-color:#F7F7F7; margin-left:15px; margin-right:15px; border-radius:10px; padding:10px;">
			
			<div class="media-body" style="text-align:left">
				<a href="game.php?id=<?= $game->g_id ?>"><h4 class="media-heading"><?= $game_vars->g_name  ?></h4></a>
				
			</div>
		</div>

		<?php
	}
}

?>