<div class="modal fade" id="add_review_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Review: </h4>
			</div>
			<form method="post" action="" class="center-block form-horizontal">
			<div class="modal-body">
				<div class="container" style="width:90%">
					
						<div class="form-group">
							<label for="review_text" class="col-sm-3 control-label">Review:</label>
							<div class="col-sm-7">
							<textarea style="resize:none; width:100%; height:300px;"class="form-control" name="review_text" id="review_text" autocomplete="off" placeholder="Review Text"><?php if($prevReview->num_rows){ $rev = $prevReview->fetch_object(); echo $rev->r_text;} ?></textarea>
						</div>
						</div>

						
						
					
				</div>
			</div>
			

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<input class="pull-right btn btn-primary" type="submit" value="Add review" name="submit_review">
					
				
			</div>
			</form>

		</div>
	</div>
</div>


<?php 

if(isset($_POST['submit_review'])){
	if(empty($_POST['review_text'])){
		echo 'you didn\'t enter any text';
	}else{

		$review_text = $_POST['review_text'];
		
		if($prevReview->num_rows)
			$db->query("UPDATE Game_Reviews SET r_text='{$review_text}' WHERE m_id = {$_SESSION['id']} AND g_id={$_GET['id']}");
		else
			$db->query("INSERT INTO Game_Reviews (r_text,m_id,g_id) VALUES ('{$review_text}',{$_SESSION['id']},{$_GET['id']})");

		echo '<script>window.location.href="game.php?id='.$_GET['id'].'"</script>';
	}			
}

?>
