<?php require_once('includes/dbConnection.php');
if(!isset($_GET['id']))
	die('Invalid path');
if($result=$db->multi_query("CALL View_Game({$_GET['id']})")){
//if($result=$db->query("SELECT * FROM Games WHERE g_id={$_GET['id']}")){
	$game_info = $db->store_result();
	$db->next_result();
	$game_media = $db->store_result();
	$db->next_result();
	$game_reviews = $db->store_result();
	$db->next_result();
	$record = $game_info->fetch_object();

}
?>
<html>
<head>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-theme.min.css" rel="stylesheet">
	<!-- <link href="css/foundation.min.css" rel="stylesheet"> -->
	<link href="css/normalize.css" rel="stylesheet">
	<link href="css/powerange.min.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-1.11.3.js"></script>
</head>

<body>

	<?php require_once('includes/nav.php'); ?>
	<div id="game_cover">
		<img src="art/game_default.jpg">

	</div>
	<div class="container" style="text-align:center;background-color:#F7F7F7; margin-bottom:50px; padding:30px;">
	
		<div id="info_section">
			<div id="game_info">
				<div id="game_type" class="pull-right" style="text-align:center; ">
					<img src="art/<?= $record->type ?>_game.png" width="100px">
					<br>
					<h4><?= ucfirst($record->type) ?> Game</h4>
				</div>
				<?php require_once('game/game_info.php') ?>


			</div>

			<div id="team_info">
				<?php require_once('game/game_developer_info.php'); ?>

			</div>
		</div>


		<div id="media_slideshow">
			<?php require_once('game/media_slideshow.php'); ?>
		</div>
		<div id="game_reviews">

			<h2>Game Reviews: </h2>
			<?php require_once('game/game_reviews.php'); ?>
		</div>
	</div>

	<?php require_once('includes/footer.php'); ?>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/powerange.js"></script>

</body>
</html>

<script>
$(document).ready(function(){


	
	$('[data-toggle="tooltip"]').tooltip();

	var elem = document.querySelector('#r_uniqueness');
	var init = new Powerange(elem, { min: 0, max: 10});

	var elem = document.querySelector('#r_graphics');
	var init = new Powerange(elem, { min: 0, max: 10});

	var elem = document.querySelector('#r_level_design');
	var init = new Powerange(elem, { min: 0, max: 10});

	var elem = document.querySelector('#r_interactivity');
	var init = new Powerange(elem, { min: 0, max: 10});
	//alert('<?= $uniqueness ?>');
	$('#r_uniqueness + .range-bar .range-handle').css('left','<?= $uniqueness*95/10 ?>%');
	$('#r_graphics + .range-bar .range-handle').css('left','<?= $graphics*95/10 ?>%');
	$('#r_interactivity + .range-bar .range-handle').css('left','<?= $interactivity*95/10 ?>%');
	$('#r_level_design + .range-bar .range-handle').css('left','<?= $level_design*95/10 ?>%');

	$('#r_uniqueness + .range-bar .range-quantity').css('width','<?= $uniqueness*95/10 ?>%');
	$('#r_graphics + .range-bar .range-quantity').css('width','<?= $graphics*95/10 ?>%');
	$('#r_interactivity + .range-bar .range-quantity').css('width','<?= $interactivity*95/10 ?>%');
	$('#r_level_design + .range-bar .range-quantity').css('width','<?= $level_design*95/10 ?>%');
	$('#uniqueness_display').text('<?= $uniqueness ?>');	
	$('#graphics_display').text('<?= $graphics ?>');
	$('#level_design_display').text('<?= $level_design ?>');
	$('#interactivity_display').text('<?= $interactivity ?>');


});

$('#r_uniqueness').change(function(){
	$('#uniqueness_display').text($(this).val()=='NaN'?0:$(this).val());	
});
$('#r_graphics').change(function(){
	$('#graphics_display').text($(this).val()=='NaN'?0:$(this).val());	
});
$('#r_level_design').change(function(){
	$('#level_design_display').text($(this).val()=='NaN'?0:$(this).val());	
});
$('#r_interactivity').change(function(){
	$('#interactivity_display').text($(this).val()=='NaN'?0:$(this).val());	
});

</script>

<style>
#game_cover{
	height: 300px;
	//text-align: center;
}
#game_cover img{
	z-index: -5;
	position: fixed;
	margin-left: 38%; 
	height: 250px;
	/*border: 1px solid black;*/
}

#info_section{
	width: 100%;
	//height: 400px;
}

#game_info{
	width: 50%;
	//height: 100%;
	background-color: #F1F1F1;
	display: inline-block;
	vertical-align: top;
	margin-right: 80px;
	border-radius: 50px;
	padding: 50px;
	padding-left: 50px;
	text-align: left;
}



#team_info{
	width: 30%;
	height: 100%;
	background-color: #F1F1F1;
	display: inline-block;
	vertical-align: top;
	border-radius: 50px;
}

#media_slideshow{
	margin-top: 50px;
	background-color: #F1F1F1;
	width: 100%;
	height: 250px;
	border-radius: 50px;
}

#game_reviews{
	margin-top: 50px;
	text-align: left;
	background-color: #F1F1F1;
	width: 60%;
	padding: 30px;
	border-radius: 50px;
}


</style>