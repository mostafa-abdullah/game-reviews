<?php

$reviews=array();
if($game_reviews ->num_rows){
	while($row2=$game_reviews->fetch_object()){
		$reviews[]=$row2;
	}
	$game_reviews->free();
}
?>

<?php if(isset($_SESSION['id']) && $_SESSION['account_type'] == 1 && $_SESSION['is_verified'] == 1){ 
	$prevReview = $db->query("SELECT r_text FROM Game_Reviews WHERE m_id={$_SESSION['id']} AND g_id = {$_GET['id']}");
	?>
<a data-toggle="modal" data-target="#add_review_modal" style="cursor:pointer" class="btn btn-info pull-right"><?= $prevReview->num_rows?'Edit Review':'Add Review' ?></a>
<?php require_once('game/add_review.php'); ?>
<?php } ?>
<?php
foreach ($reviews as $r2) {
	$reviewer_id = $r2->id;

	$reviewer = $db->query("SELECT M.id, M.profile_picture, VR.f_name, VR.l_name FROM Members M INNER JOIN verified_reviewrs VR ON M.id = VR.id WHERE M.id={$reviewer_id}");
	$reviewer = $reviewer->fetch_object();
	?>

	<div class="media one_review">

		<div class="media-left">
			
			<a class="thumbnail" style="width:100px;" href='user.php?id=<?= $reviewer->id ?>'><img  src="<?= (!isset($reviewer->profile_picture) || empty($reviewer->profile_picture))?'art/profile_default.jpg':$reviewer->profile_picture ?>"></a>
		</div>

		<div class="media-body">
			<a href='user.php?id=<?= $reviewer->id ?>'><h4><?= $reviewer->f_name.' '.$reviewer->l_name ?></h4></a>
			<?php
			echo substr($r2->r_text,0,50 );
			?>....
			<!-- URL will be ADDed -->
			<a href="game/game_review.php?gr_id=<?php echo $r2->gr_id ?>">See full review</a> 
		</div>
	</div>
	<?php
}
?>


<style type="text/css">
.one_review{
	margin: 20px;
	background-color: #F7F7F7;
	padding: 20px;
	border-radius: 20px;
	width: 70%;
}
</style>