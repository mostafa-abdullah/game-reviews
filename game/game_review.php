<?php
require_once '../includes/dbConnection.php';

if($result=$db->query("SELECT * FROM Game_Reviews WHERE gr_id={$_GET['gr_id']}")){
	$result=$result->fetch_object();
}
if($comm=$db->query("CALL Comments_On_Game_Review({$_GET['gr_id']})")){
	
	$db->next_result();
}
?>
<!DOCTYPE html>
<html>
<head>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/bootstrap-theme.min.css" rel="stylesheet">
	<!-- <link href="css/foundation.min.css" rel="stylesheet"> -->
	<link href="../css/normalize.css" rel="stylesheet">
	<link href="../css/powerange.min.css" rel="stylesheet">
	<script type="text/javascript" src="../js/jquery-1.11.3.js"></script>
</head>
<body>
	<?php
	require_once('../includes/nav.php');
	$result_id = $result->m_id;

	$reviewer = $db->query("SELECT M.profile_picture, VR.f_name, VR.l_name FROM Members M INNER JOIN verified_reviewrs VR ON M.id = VR.id WHERE M.id={$result_id}");
	$reviewer = $reviewer->fetch_object();
	?>
	<div class="container" style="text-align:left;background-color:#F7F7F7; margin-bottom:50px; padding:30px; width:60%;">
		<div id="reviewer_info" style="background-color:#F1F1F1; padding:25px; border-radius:25px; width:50%;">
			<a href='../user.php?id=<?= $result->m_id ?>' style="display:inline-block; vertical-align:top"><img width="100px" src="<?= (!$reviewer->profile_picture || empty($reviewer->profile_picture))?'../art/profile_default.jpg':$reviewer->profile_picture ?>"></a>
			<a href='../user.php?id=<?= $result->m_id ?>'  style="display:inline-block; vertical-align:top; margin-left:15px; margin-top:-10px;"><h2><?= $reviewer->f_name.' '.$reviewer->l_name ?></h2></a>

		</div>
		<hr><hr>

		<h3><?= $reviewer->f_name ?>'s review for <a href='../game.php?id=<?= $result->g_id ?>'><?= $db->query("SELECT g_name FROM Games WHERE g_id={$result->g_id}")->fetch_object()->g_name; ?></a>:</h3>
		<div id="review_text" class="center-block" style="font-size:22px; background-color:#F1F1F1; padding:25px; border-radius:25px; width:80%;">
			<?= $result->r_text ?>
		</div>
		<div id="review_comments">
			<?php require_once 'comments_on_gameReview.php'; ?>
		</div>
	</div>
	<?php
	
	?>

	<?php
	require_once('../includes/footer.php');
	?>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>

</body>

</html>
<style>
#review_comments{
padding: 20px;
background-color: #F1F1F1;
margin-top: 30px;
width: 60%;
border-radius: 20px;
}
</style>