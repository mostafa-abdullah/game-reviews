<?php

if(isset($_SESSION['id']) && $id == $_SESSION['id']){
	$recommendations = $db->query("SELECT * FROM normalmember_recommendsgameto_normalmember NRN 
		INNER JOIN Normal_Members NM ON NRN.m1_id = NM.id 
		INNER JOIN Games G ON NRN.g_id = G.g_id
		WHERE m2_id = {$id}");

	if($recommendations->num_rows){
	while($recomm = $recommendations->fetch_object()){
		
		?>
		<div class="media" style="margin-top:10px; padding:5px; background-color:#F7F7F7; margin-left:15px; margin-right:15px; border-radius:10px; padding:10px;">
			
			<div class="media-body" style="text-align:left;font-size:20px; ">
				
				<a href="user.php?id=<?= $recomm->id ?>"><?= $recomm->f_name.' '.$recomm->l_name ?></a> recommended <a href="game.php?id=<?= $recomm->g_id ?>"><?= $recomm->g_name  ?></a> to you
				
			</div>
		</div>

		<?php
	}
}













}
?>