<?php require_once('includes/dbConnection.php'); ?>
<?php if(!isset($_GET['id'])){
	die('Invalid path');
} ?>
<html>
<head>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-theme.min.css" rel="stylesheet">
	<!-- <link href="css/foundation.min.css" rel="stylesheet"> -->
	<link href="css/normalize.css" rel="stylesheet">
	<link href="css/tabs.css" rel="stylesheet">
	<link href="css/tabstyles.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-1.11.3.js"></script>
</head>
<body>
	<?php require_once('includes/nav.php'); ?>
	<div class="container" style="text-align:center;background-color:#F7F7F7; margin-bottom:50px; padding:30px;">

		<?php
		$user = $db->query("SELECT * FROM Members WHERE id = {$_GET['id']}");
		if(!$user->num_rows){
			die('User not found.');
		}
		$user = $user->fetch_object();
		$id = $user->id;
		$email = $user->email;
		$genre = $user->genre;
		$profile_picture = $user->profile_picture;
		$check1 = $db->query("SELECT * FROM Normal_Members WHERE id = {$_GET['id']}");
		$check2 = $db->query("SELECT * FROM Verified_Reviewrs WHERE id = {$_GET['id']}");
		$check3 = $db->query("SELECT * FROM Development_Teams WHERE id = {$_GET['id']}");
		if($check1->num_rows){
			$check1 = $check1->fetch_object();
			$account_type 	= 0;
			$f_name 		= $check1->f_name;
			$l_name 		= $check1->l_name;
			$d_o_b 			= $check1->date_of_birth;
			$age 			= $check1->age;
		}
		else if($check2->num_rows){
			$check2 = $check2->fetch_object();
			$account_type 	= 1;
			$f_name 		= $check2->f_name;
			$l_name 		= $check2->l_name;
			$years 			= $check2->years_of_experience;
			$is_verified 	= $check2->is_verified;
		}
		else if($check3->num_rows){
			$check3 = $check3->fetch_object();
			$account_type 		= 2;
			$team_name 			= $check3->team_name;
			$company 			= $check3->company;
			$team_foundation	= $check3->founding_date;
			$is_verified 		= $check3->is_verified;
		}


		?>
		<div class="page-header" style="text-align:left">
			<?php 
			if($account_type == 0) echo "<h1><?php  ?>Normal Member <small>$f_name $l_name</small></h1>";
			else if($account_type == 1) echo "<h1><?php  ?>Verified Reviewer <small>$f_name $l_name</small></h1>";
			else echo "<h1><?php  ?>Development Team <small>$team_name</small></h1>";
			?>
			
		</div>
		<div id="info_coloumn" class="center-block">
			<?php require_once('user/update_info_modal.php'); ?>
			<div id="profile_picture_section" class="pull-left">
				<?php if(isset($_SESSION['id']) && $_SESSION['id'] == $id){  ?>
				<div class="center-block" id="change_pp_label" style="cursor:pointer;margin-bottom:-49px;  background-color:#F1F1F1; width:200px; opacity:0.6;">
					<label style="font-size:13; margin-top:15px; margin-bottom:15px; text-align:center; cursor:pointer; width:100%;">Change Profile Picture</label>
				</div>
				<?php } ?>
				<?php if(!isset($profile_picture) || empty($profile_picture)){ ?>
				<img style="height:200px; border-radius:100px;" src="art/profile_default.jpg">
				<?php } else{ ?>
				<img style="height:200px; border-radius:100px;" src="<?= $profile_picture ?>">
				<?php } ?>
				<?php if(isset($_SESSION['id']) && $_SESSION['id'] == $id){  ?>
				<form id="change_pp_form" style="margin-top:10px;"  action="" method="post" enctype="multipart/form-data">
					<label><small>Set/Change Profile Picture:</small></label>
					<input name="profile_picture_file" id="profile_picture" type="file" accept="image/*" >
					<input class="btn btn-link" type="submit" id="upload_profile_picture" value="Upload">
				</form>
				<?php require_once('user/profile_picture_uploader.php'); ?>
				<?php } ?>
				
			</div>
			<div id="info_section" >
				<?php if(isset($_SESSION['id']) && $_SESSION['id'] == $id){ ?>
				<a href="#" data-toggle="modal" data-target="#update_info_modal" style="" class="pull-right btn btn-primary">Update info</a> <?php } ?>
				<?php if(isset($_SESSION['id']) && $_SESSION['account_type'] == 0 && $_SESSION['id'] != $id && $account_type == 0){ ?>
				<div class= "pull-right" id="friend_request_container">
					<?php 
					$checkISent = $db->query("SELECT * FROM NormalMember_AddFriend_NormalMember WHERE m1_id = {$_SESSION['id']} AND m2_id = {$id}");
					$checkHeSent = $db->query("SELECT * FROM NormalMember_AddFriend_NormalMember WHERE m1_id = {$id} AND m2_id = {$_SESSION['id']}");
					if(!$checkISent->num_rows && !$checkHeSent->num_rows){
						?>
						<a href="#" id="send_friend_request" style="" class=" btn btn-success">Send friend request</a> 
						<?php }
						else if($checkISent->num_rows){
							$checkISent = $checkISent->fetch_object();
							if($checkISent->is_accepted){
								?>
								<a href="#" id="unfriend" style="" class=" btn btn-info">Unfriend <?= $f_name; ?></a>

								<?php
							}
							else if($checkISent->is_accepted == '0')
							{
								?>
								<a href="#" id="friend_request_rejected" disabled style="" class=" btn btn-danger">Friend request rejected</a>
								<?php
							}
							else{
								?>
								<a href="#" id="friend_request_sent" disabled style="" class=" btn btn-info">Request sent</a>
								<?php
							}
						}
						else{
							$checkHeSent = $checkHeSent->fetch_object();
							if($checkHeSent->is_accepted){
								?>
								<a href="#" id="unfriend" style="" class=" btn btn-info">Unfriend <?= $f_name; ?></a>
								<?php
							}
							else if($checkHeSent->is_accepted == '0')
							{
								?>
								<a href="#" id="you_rejected_request" disabled style="" class=" btn btn-danger">You rejected <?= $f_name ?>'s request</a>
								<?php
							}
							else{
								?>
								<a href="#" id="friend_request_sent" disabled style="" class=" btn btn-info">Accept <?= $f_name.'\'s ' ?>request</a>
								<?php
							}
						}
						?>
					</div>
					<?php } ?>
					<?php 
					if($account_type == 0){
						?>

						<table id="info_table">
							<tr>
								<td>Name:</td>
								<td><?= $f_name.' '.$l_name ?></td>

							</tr>
							<tr>
								<td>Email: </td>
								<td><?= $email ?></td>

							</tr>
							<tr>
								<td>Genre:</td>
								<td><?= $genre ?></td>

							</tr>
							<tr>
								<td>Date of birth:</td>
								<td><?= date("d, M Y",strtotime($d_o_b)) ?></td>

							</tr>
							<tr>
								<td>Age:</td>
								<td><?= $age ?></td>

							</tr>					
						</table>




						<?php
					}
					else if($account_type == 1){
						?>
						<table id="info_table">
							<tr>
								<td>Name:</td>
								<td><?= $f_name.' '.$l_name ?></td>

							</tr>
							<tr>
								<td>Email: </td>
								<td><?= $email ?></td>

							</tr>
							<tr>
								<td>Genre:</td>
								<td><?= $genre ?></td>

							</tr>
							<tr>
								<td>Years of experience:</td>
								<td><?= $years ?></td>

							</tr>
							<tr>
							</table>
							<br><br>
							<?php if($is_verified){ ?>
							<p><font color="green">This reviewer has been verified by the admin</font></p>
							<?php }else{ ?>
							<p><font color="red">This reviewer hasn't been verified yet by the admin</font></p>
							<?php } ?>

						</tr>					

						<?php 
					}else{
						?>
						<table id="info_table">
							<tr>
								<td>Team Name:</td>
								<td><?= $team_name ?></td>

							</tr>
							<tr>
								<td>Email: </td>
								<td><?= $email ?></td>

							</tr>
							<tr>
								<td>Genre:</td>
								<td><?= $genre ?></td>

							</tr>
							<tr>

								<td>Company:</td>
								<td><?= $company ?></td>
							</tr>
							<tr>
								<td>Founding Date:</td>
								<td><?= date("d, M Y",strtotime($team_foundation)) ?></td>


							</tr>					
						</table>
						<br><br>
						<?php if($is_verified){ ?>
						<p><font color="green">This team has been verified by the admin</font></p>
						<?php }else{ ?>
						<p><font color="red">This team hasn't been verified yet by the admin</font></p>
						<?php } ?>
						<?php
					}
					?>

				</div>
				<?php
				if(isset($checkISent->is_accepted) && $checkISent->is_accepted || isset($checkHeSent->is_accepted) && $checkHeSent->is_accepted){
					?>
					<a href="messanger.php?his_id=<?= $id ?>" id="send_message" style="" class=" btn btn-default">Message</a>
					<?php } ?>
				</div>
				<div id="friends_coloumn">
					<?php if($account_type == 0){ ?>
					<div id="toggle_friends" style="margin-top:20px; width:100%; height:50px;" class="center-block">
						<div class="tabs tabs-style-linebox">
							<nav>
								<ul>
									<?php if(isset($_SESSION['id']) && $_SESSION['id'] == $id){ ?>
									<li class="tab-current"><a href="#" class="icon"><span>Friend Requests</span></a></li>
									<?php } ?>
									<li class=""><a href="#" class="icon"><span>Friends</span></a></li>

								</ul>
							</nav>
							<div class="content-wrap">
								<?php if(isset($_SESSION['id']) && $_SESSION['id'] == $id){ ?>
								<section id="friend_requests_section" class="content-current">
									<?php require_once('user/get_friend_requests.php'); ?>
								</section>
								<?php } ?>
								<section id="friends_section" class="">
									<?php require_once('user/friends.php'); ?>
								</section>

								
							</div><!-- /content -->
						</div>
					</div>

					<div id="friends_section">

					</div>
					<?php } else if($account_type == 1){
						require_once('user/ver_rev_reviews.php');

					}
					else{
						require_once('user/dev_team_games.php');
					} ?>
				</div>
				<div id="feed_coloumn">
					<div id="feed_section">
						<?php 

						if(isset($_SESSION['id']) && $_SESSION['id'] == $id && $_SESSION['account_type'] == 0)
							require_once('user/game_recommended_to_me.php');
						?>
					</div>
				</div>

			</div>


			<?php require_once('includes/footer.php'); ?>
			<script type="text/javascript" src="js/bootstrap.min.js"></script>
			<script type="text/javascript" src="js/cbpFWTabs.js"></script>
			<!-- <script type="text/javascript" src="js/modernizr.custom.js"></script> -->
		</body>
		</html>
		<script>
		$('#unfriend').click(function(){
			var sure = confirm('Are you sure?');
			if(sure){
				var my_id = <?= $_SESSION['id'] ?>;
				var his_id = <?= $id ?>;
				$.ajax({
					url: 'user/unfriend.php',
					data: {my_id:my_id, his_id:his_id},
					success: function(data){
						$('#unfriend').parent().html(data);
					},


				});
			}

		})
		$('[data-toggle="tooltip"]').tooltip();
		(function() {

			[].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
				new CBPFWTabs( el );
			});

		})();
		$("#profile_picture_section").hover(function(){

			$("#change_pp_label").fadeIn("fast");
		}, function(){
			$("#change_pp_label").fadeOut("fast");
		});
		$("#change_pp_label").click(function(){
			$("#change_pp_form").toggle("fast");
		});
		$(document).ready(function(){
			$("#change_pp_label").hide();
			$("#change_pp_form").hide();
		});

		$('#send_friend_request').click(function(){
			var my_id = <?= $_SESSION['id']; ?>;
			var his_id = <?= $id; ?>;
			$.ajax({
				url: 'user/send_friend_request.php',
				data: {my_id:my_id, his_id:his_id},
				success: function(data){
					$('#send_friend_request').parent().html(data);
				},


			});


		});


		</script>

		<style>
		#info_coloumn{
			width:80%;
			//height: 300px;
			background-color: #F1F1F1;

			border-radius: 50px;
			padding: 30px;

		}
		#friends_coloumn{
			border-radius: 50px;
			width:30%;
			height: 600px;
			background-color: #F1F1F1;
			margin-top: 50px;
			display: inline-block;
			vertical-align:top
		}
		#feed_coloumn{
			border-radius: 50px;
			width:40%;
			height: 600px;
			background-color: #F1F1F1;
			display: inline-block;
			margin-top: 50px;
			margin-left: 30px;
			//vertical-align:top
		}
		#profile_picture_section{
			height: 240px;
			display: inline-block;
			vertical-align: top;

		}
		#info_section{
			height: 240px;
			width: 50%;
			display: inline-block;
			vertical-align: top;
			text-align: left;
		}

		#info_table{
			padding: 20px;
		}

		#info_table tr td{
			padding: 5px;
		}
		.tabs-style-linebox a{
			text-decoration: none;
		}
		#friends_section{
			height: 400px;

			margin: 10px;
			overflow: auto;
		}
		</style>

