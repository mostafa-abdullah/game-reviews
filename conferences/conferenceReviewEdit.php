<?php 
require_once('includes/dbConnection.php');
$games = $db->query("SELECT G.*  from DevelopmentTeam_Presents_Game INNER JOIN Games G
	ON g_id = G.g_id  WHERE con_id = {$id} ");
echo "<h3><small>$games->num_rows Games Presented In  $name</small></h3><br>";
if($games->num_rows){
	while($row = $games->fetch_assoc()){
		?>
		<div class="media" style=" background-color:#F7F7F7; padding:10px;">
			<div class="media-left">
				<a href="game.php?id=<?= $row['id'] ?>">
					<img class="media-object" height="60px" src="art/profile_default.jpg" alt="...">
				</a>
			</div>
			<div class="media-body" style="text-align:left">
				<a href='game.php?id=<?= $row[id] ?>'><h4 class="media-heading"><?=$row['name']?></h4></a>
			</div>
		</div>
		<?php 
}

}


?>
