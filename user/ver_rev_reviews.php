<?php

$reviews = $db->query("SELECT * FROM game_reviews WHERE m_id = {$id}");

echo "<h3><small>$f_name wrote $reviews->num_rows reviews</small></h3>";

if($reviews->num_rows){
	while($review = $reviews->fetch_object()){
		
		?>
		<div class="media" style=" background-color:#F7F7F7; margin-left:15px; margin-right:15px; border-radius:10px; padding:10px;">
			
			<div class="media-body" style="text-align:left">
				<a href="game.php?id=<?= $review->g_id ?>"><h4 class="media-heading"><?= $db->query("SELECT g_name FROM Games WHERE g_id = {$review->g_id}")->fetch_object()->g_name; ?></h4></a>
				<small><?= substr($review->r_text, 0, 30).'...' ?><a href="game/game_review.php?gr_id=<?= $review->gr_id ?>">See full review</a></small>
			</div>
		</div>

		<?php
	}
}

?>