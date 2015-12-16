
<?php
while($r = $comm->fetch_object()) {
	$commenter_id = $r->m_id;
	$check1 = $db->query("SELECT * FROM Normal_Members WHERE id={$commenter_id}");
	$check2 = $db->query("SELECT * FROM Verified_Reviewrs WHERE id={$commenter_id}");
	$check3 = $db->query("SELECT * FROM Development_Teams WHERE id={$commenter_id}");
	if($check1->num_rows){
		$reviewer = $db->query("SELECT M.id,M.profile_picture, VR.f_name, VR.l_name FROM Members M INNER JOIN Normal_Members VR ON M.id = VR.id WHERE M.id={$commenter_id}");
		$reviewer = $reviewer->fetch_object();
	}
	if($check2->num_rows){
		$reviewer = $db->query("SELECT M.id,M.profile_picture, VR.f_name, VR.l_name FROM Members M INNER JOIN Verified_Reviewrs VR ON M.id = VR.id WHERE M.id={$commenter_id}");
		$reviewer = $reviewer->fetch_object();
	}
	if($check3->num_rows){
		$reviewer = $db->query("SELECT M.id,M.profile_picture, VR.team_name FROM Members M INNER JOIN Development_Teams VR ON M.id = VR.id WHERE M.id={$commenter_id}");
		$reviewer = $reviewer->fetch_object();
	}

	?>
	<div class="one_review_comment">
		<a href='../user.php?id=<?= $reviewer->id ?>' style="display:inline-block; vertical-align:top;"><img width="50px;" src="<?= (!$reviewer->profile_picture || empty($reviewer->profile_picture))?'../art/profile_default.jpg':$reviewer->profile_picture ?>"></a>
		<div style="display:inline-block; vertical-align:top;margin-left:10px;margin-top:-5px;">
		<a href='../user.php?id=<?= $reviewer->id ?>' style="vertical-align:top"><h4><?php if($check3->num_rows){
			echo $reviewer->team_name;
		} else {echo $reviewer->f_name.' '.$reviewer->l_name;} ?></h4></a>
		
		<?php
		echo $r->com_text;
		?>
	</div>
		<?php
		if(($r->m_id)==$_SESSION['id']){
			?>
			<form class="pull-right" method="post" action="">
				<input onclick="return confirm('Are you sure?');" class="btn-xsm btn-danger"type="submit" value="delete" name="delete_comment">
				<input type="hidden" name="comment_id" value="<?= $r->com_id ?>">
			</form>			
			<?php

		}
		?>
	</div>
	<?php
}
?>



<?php  

if(isset($_POST['delete_comment'])){
	$db->query("DELETE FROM game_review_comments WHERE com_id={$_POST['comment_id']}");
				//$db->query("CALL Add_Comment({$_SESSION['id']},{$_GET['gr_id']},'{$comment_text}','game')");
		echo '<script>window.location.href="game_review.php?gr_id='.$_GET['gr_id'].'"</script>';
}


if(isset($_SESSION['id'])){
	?>
	<form method="post" action="" class="form" style="margin-top:30px;">
		<div class="form-group">
		<textarea style="resize:none; height:100px; width:80%; font-size:17px;" class="form-control" name="comment_text" id="comment" autocomplete="off"></textarea>
	</div>
		<input class="btn-sm btn-success" type="submit" value="Add comment" name="submit_comment">
	</form>
	<?php 

	if(isset($_POST['submit_comment'])){
		if(empty($_POST['comment_text'])){
			echo 'you didn\'t enter any comments';
		}else{

			$comment_text = $_POST['comment_text'];
			$db->query("INSERT INTO game_review_comments (com_text,m_id,gr_id) VALUES ('{$comment_text}',{$_SESSION['id']},{$_GET['gr_id']})");
				//$db->query("CALL Add_Comment({$_SESSION['id']},{$_GET['gr_id']},'{$comment_text}','game')");
			echo '<script>window.location.href="game_review.php?gr_id='.$_GET['gr_id'].'"</script>';	
		}			
	}
}

?>


<style>
.one_review_comment{
	padding: 20px;
	background-color: #F7F7F7;
	margin-top: 20px;
	border: 2px solid #E7E7E7;
	border-radius: 10px;
}

</style>
