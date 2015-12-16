


<h1><?= $record->g_name ?></h1>
<h4>Released on <?= date("d, M, Y",strtotime($record->g_r_date)) ?></h4>
<h4>With <?= $record->g_age_limit ?> years age limit.</h4>
<?php

	if($record->type == 'action'){
		echo '<h4>Sub-Genre: '.(($record->sub_genre==null)?'Unknown':$record->sub_genre).'</h4>';
	}
	else if($record->type == 'strategy'){
		echo '<h4>Real Time: '.(($record->is_real_time==null)?'Unknown':($record->is_real_time?'Yes':'No')).'</h4>';
	}
	else if($record->type == 'sport'){
		echo '<h4>Sport Type: '.(($record->sport_type==null)?'Unknown':$record->sport_type).'</h4>';
	}
	else if($record->type == 'rpg'){
		if($record->allow_PvP == null)
			echo '<h4>Unknown Player vs. Player state.</h4>';
		else if($record->allow_PvP)
			echo '<h4>Allows Player vs. Player</h4>';
		else
			echo '<h4>Doesn\'t allow Player vs. Player</h4>';
		echo '<h4>Storyline: <small>'.$record->story_line.'</small></h4>';
	}
 ?>

<div class="game_rating" >
	<?php 
	for($i = 0; $i<floor($record->g_rating); $i++){
		?>
		<span data-toggle="tooltip" data-placement="bottom" title="Game Rating: <?= $record->g_rating ?>" style="color:red;"class="glyphicon glyphicon-star"></span>
		<?php
	}
	for($i = floor($record->g_rating); $i<10; $i++){
		?>
		<span data-toggle="tooltip" data-placement="bottom" title="Game Rating: <?= $record->g_rating ?>" style="color:gray;"class="glyphicon glyphicon-star"></span>
		<?php
	}
	?>
	<br>
	<br>
	<?php if(isset($_SESSION['id'])){ ?>
	<a data-toggle="modal" data-target="#rate_modal" style="cursor:pointer" id="rate_game_button">Rate game</a>
	<?php
	if($_SESSION['account_type'] == 0){
	?>
	<a data-toggle="modal" data-target="#recommend_game_modal"class="btn btn-success pull-right" style="cursor:pointer" id="recommend_game_button">Recommend Game</a>
	<?php
}
}
?>
</div>
<?php require_once('game/recommend_game.php'); ?>
<?php require_once('game/rate_game.php'); ?>

<script>
$('#rate_game_button').click(function(){

});
</script>
