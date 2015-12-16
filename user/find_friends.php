<?php require_once('../includes/dbConnection.php'); 
$people = $db->query("CALL Search_The_Members({$_SESSION['id']})");
$db->next_result();


?>

<html>
<head>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/bootstrap-theme.min.css" rel="stylesheet">
	<!-- <link href="css/foundation.min.css" rel="stylesheet"> -->
	<link href="../css/normalize.css" rel="stylesheet">
	<script type="text/javascript" src="../js/jquery-1.11.3.js"></script>
</head>

<body>
	<?php require_once('../includes/nav.php'); ?>
	<div id="search_container" class="container" style="width:50%; text-align: left;background-color:#F7F7F7; margin-bottom:50px; padding:30px;">
		<?php while($member = $people->fetch_object()){ 
			$member_id = $member->id;
			$member_name = $member->f_name.' '.$member->l_name;
			$member = $db->query("SELECT email,profile_picture FROM Members WHERE id = {$member_id}")->fetch_object();
			$email = $member->email;
			$profile_picture = $member->profile_picture;

			?>
		<div class="media member_preview">

			<div class="media-left">
				<a href="../user.php?id=<?= $member_id ?>">
					<img style="border-radius:40px;width:100px;" class="media-object" src="<?= empty($profile_picture)?"../art/profile_default.jpg":$profile_picture  ?>" alt="...">
				</a>
			</div>

			<div class="media-body">
				<a href="../user.php?id=<?= $member_id ?>"><h4 class="media-heading"><?= $member_name ?></h4></a>
				<?= $email ?>
			</div>
		</div>

		<?php } ?>

	</div>
	<?php require_once('../includes/footer.php'); ?>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
</body>
</html>

<style>
.member_preview{
	margin: 10px 40px 20px 20px;
	padding: 10px;
	border-radius: 20px;
	background-color: #F1F1F1;

}

</style>