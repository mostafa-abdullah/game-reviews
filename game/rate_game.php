<?php 
if(isset($_SESSION['id'])){ 
	$uniqueness = 0;
	$graphics = 0;
	$level_design = 0;
	$interactivity = 0;
	$my_rating = $db->query("SELECT * FROM Member_Rates_Game WHERE m_id ={$_SESSION['id']} AND g_id = {$_GET['id']}");
	if($my_rating->num_rows){
		$rating = $my_rating->fetch_object();
		$uniqueness = $rating->uniqueness;
		$graphics = $rating->graphics;
		$level_design = $rating->level_design;
		$interactivity = $rating->interactivity;
	}




	?>
	<div id="rate_modal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class=""  style="background-color:rgba(255,255,255,0.8)">

				<button style="margin-right:15px;margin:top:10px;"type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"></h4>

				<br>
				<div class="modal-body" style="text-align:center">
					<h3><p>Rating criteria: </p></h3>
					
					<?php if($my_rating->num_rows){ echo '<font color="red">Attention: this will replace your previous rating!</font>'; } ?>
					<br>
					<form method="post" action="">
						<div style="width:85%;margin-left:30px;">

							<h1><small>Uniquness <span id="uniqueness_display" class="label label-info"></span></small></h1>
							<input type="text" id="r_uniqueness" name="r_uniqueness">
							<br>

							<h1><small>Graphics <span id="graphics_display" class="label label-info"></span></small></h1>
							<input type="text" value="<?= $graphics ?>" id="r_graphics" name="r_graphics">
							<br>

							<h1><small>Level Design <span id="level_design_display" class="label label-info"></span></small></h1>
							<input type="text" value="<?= $level_design ?>" id="r_level_design" name="r_level_design">
							<br>

							<h1><small>Interactivity <span id="interactivity_display" class="label label-info"></span></small></h1>
							<input type="text" value="<?= $interactivity ?>" id="r_interactivity" name="r_interactivity">
							<br>

						</div>

						<button style="margin:10px;"class="btn" data-dismiss="modal">Close</button>
						<input type="submit" name="save_rating" class="btn" value="Save Rating">
					</form>

				</div>
				<!-- <div class="modal-footer"> -->

				<!-- </div> -->
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>
	<?php 
} 
if(isset($_POST['save_rating'])){
	
	if($my_rating->num_rows){
		$_POST['r_graphics'] = $_POST['r_graphics']=='NaN'?$graphics : $_POST['r_graphics'];
		$_POST['r_uniqueness'] = $_POST['r_uniqueness']=='NaN'?$uniqueness : $_POST['r_uniqueness'];
		$_POST['r_interactivity'] = $_POST['r_interactivity']=='NaN'?$interactivity : $_POST['r_interactivity'];
		$_POST['r_level_design'] = $_POST['r_level_design']=='NaN'?$level_design : $_POST['r_level_design'];
		
		$db->query("UPDATE Member_Rates_Game SET graphics={$_POST['r_graphics']}, interactivity={$_POST['r_interactivity']}, level_design={$_POST['r_level_design']}, uniqueness={$_POST['r_uniqueness']} WHERE g_id={$_GET['id']} AND m_id={$_SESSION['id']}");
	}
	else
		$db->query("CALL Rate_Game({$_SESSION['id']},{$_GET['id']},{$_POST['r_graphics']},{$_POST['r_interactivity']},{$_POST['r_uniqueness']},{$_POST['r_level_design']})");
	echo "<script>window.location.href='http://localhost/GameReviews/game.php?id=".$_GET['id']."'</script>";
}


?>
