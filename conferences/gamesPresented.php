<?php 
    require_once('includes/dbConnection.php');
    $gms = $db->query("SELECT G.*  from Games G INNER JOIN DevelopmentTeam_Presents_Game G1
	ON G.g_id = G1.g_id  WHERE G1.c_id = {$id}

 ");
echo "<h3><small> $gms->num_rows Games Presented In  $name</small></h3><br>";
if($gms->num_rows){
    while($row = $gms->fetch_assoc()){
        $cheak = $db->query("SELECT *  from DevelopmentTeam_Presents_Game  WHERE g_id = {$row['g_id']}
	 ");
    ?>
			<div class="media" style=" background-color:#F7F7F7; padding:10px;">
			<div class="media-left">
				
			</div>
			<div class="media-body" style="text-align:left">
				<a href='game.php?id=<?= $row['g_id'] ?>'><h4 class="media-heading"><?=$row['g_name']?> 
				 <?php  if($row['d_c'] == $id) echo ' <span class="label label-warning">Debuted </span>'; ?>
</h4>
				</a>
			</div>
		</div>
		<?php 
}

}

?>