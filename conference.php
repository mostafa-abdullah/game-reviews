<?php  require_once('includes/dbConnection.php'); ?>
<?php   require_once 'conferences/Paginator.class.php'; ?>
<?php 

if(!isset($_GET['id'])){
	die('Invalid path');
}

?>
<html>
<head>
	<style>
	#info_coloumn{
		width:80%;
		//height: 300px;
		background-color: #F1F1F1;
		border-radius: 50px;
		padding: 30px;
	}
	#people_coloumn{
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
	#review{
		border-radius: 10px;
		width:90%;
		background-color: #F7F7F7;
		display: inline-block;
		margin-top: 30px;
		border: 1px solid #E0E0E0;
		text-align: left;
		//vertical-align:top
	}

	#review h3 {
		border-radius: 5px;
		margin-left: 5px;
		margin-bottom: 10px;
		color :#FFFFFF;
		background-color: #7cabcb;


	}
	#review a {
		margin-right: 10px;
		margin-bottom: 10px;


	}

	#review p {
		margin-left: 5px;


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
	.button:hover {
		background: orange;
	}
	.overlay {
		position: absolute;
		top: 0;
		bottom: 0;
		left: 0;
		right: 0;
		background: rgba(0, 0, 0, 0.7);

		transition: opacity 500ms;
		visibility: hidden;
		opacity: 0;
	}
	.overlay:target {
		visibility: visible;
		opacity: 1;
	}
	.popup {
		margin: 70px auto;
		padding: 20px;
		background: #fff;
		border-radius: 5px;
		width: 30%;
		position: relative;
		transition: all 5s ease-in-out;
	}
	.select-style {
		padding: 0;
		margin: 0;
		border: 1px solid #ccc;
		width: 120px;
		border-radius: 3px;
		overflow: hidden;
		background-color: #fff;
		background: #fff url("http://www.scottgood.com/jsg/blog.nsf/images/arrowdown.gif") no-repeat 90% 50%;
	}
	.select-style select {
		padding: 5px 8px;
		width: 130%;
		border: none;
		box-shadow: none;
		background-color: transparent;
		background-image: none;
		-webkit-appearance: none;
		-moz-appearance: none;
		appearance: none;
	}
	.select-style select:focus {
		outline: none;
	}
	.popup h2 {
		margin-top: 0;
		color: #333;
		font-family: Tahoma, Arial, sans-serif;
	}
	.popup .close {
		position: absolute;
		top: 20px;
		right: 30px;
		transition: all 200ms;
		font-size: 30px;
		font-weight: bold;
		text-decoration: none;
		color: #333;
	}
	.popup .close:hover {
		color: orange;
	}
	.popup .content {
		max-height: 30%;
		overflow: auto;
	}
	</style>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<!-- <link href="../css/bootstrap-theme.min.css" rel="stylesheet"> -->
	<!-- <link href="css/foundation.min.css" rel="stylesheet"> -->
	<link href="css/normalize.css" rel="stylesheet">
	<link href="css/tabs.css" rel="stylesheet">
	<link href="css/tabstyles.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-1.11.3.js"></script>
</head>
<body>
	<?php  require_once('includes/nav.php'); ?>
	<div class="container" style="text-align:center;background-color:#F7F7F7; margin-bottom:50px; padding:30px;">
		<?php
		$con = $db->query("SELECT * FROM Conferences WHERE c_id = {$_GET['id']}

			");

		if(!$con->num_rows){
			die('Conference not found.');
		}

		$con = $con->fetch_object();
		$id = $con->c_id;
		$name = $con->c_name;
		$start = $con->c_start_date;
		$end = $con->c_end_date;
		$dur = $con->duration;
		$place = $con->venue;
		$check1 = 1;
		$limit      = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 25;
		$page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
		$links      = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 7;
		$query      = "SELECT *  FROM Conference_Reviews WHERE c_id = '{$id}'";
		$Paginator  = new Paginator( $db, $query );
		$results    = $Paginator->getData(  $limit,$page );

		if(isset($_SESSION['id']) ){
			$check1= $db->query("SELECT * FROM Member_Attends_Conference 
				WHERE con_id = {$_GET['id']}

				AND m_id = {$_SESSION['id']}

				");

			if($check1->num_rows) $check1 =3; else $check1 =2;
		}

		?>
		<div id="popup1" class="overlay">
			<div class="popup">
				<h2>Select a geme</h2>
				<a class="close" href="">x</a>
				<div class="content">
					<form method="post" action="">
						<div class="select-style">
							<select name = "selectgame">
								<?php 
								$games = $db->query("SELECT   G.*  FROM DevelopmentTeam_Develops_Game G1 
									INNER JOIN Games  G ON G1.g_id = G.g_id WHERE G1.team_id = {$_SESSION['id']}
									
									AND G1.g_id NOT IN (SELECT G2.g_id FROM DevelopmentTeam_Presents_Game G2 WHERE G2.c_id = {$_GET['id']}

										)");

								if($games->num_rows){
									while($row = $games->fetch_assoc()){
										?>
										<option value="<?= $row['g_id'] ?>"><?= $row['g_name'] ?></option>
										<?php 
									}

								}

								?>
							</select>
						</div>		
						<button type="submit" name="choose" class="btn btn-default">Choose</button>
					</form>
					<?php

					if(isset($_POST['choose'])){
						$selectOption = $_POST['selectgame'];
						$chk = $db->query("SELECT * FROM Games WHERE  g_id ={$selectOption} ");
						$chk = $chk->fetch_object();
						$vl = $chk->d_c;
						if( $vl==NULL)
							$qr = $db->query("UPDATE  Games SET d_c ={$id} WHERE  g_id ={$selectOption}");
						$qr = $db->query("INSERT INTO DevelopmentTeam_Presents_Game ( team_id,g_id,c_id) 
							VALUES ({$_SESSION['id']}

								,{$selectOption}

								,{$_GET['id']}

								)");
						echo '<script>window.location.href="conference.php?id='.$id.'"</script>';
						//header('Location: conference.php?id='.$id);
					}

					?>
				</div>
			</div>
		</div>
		<div class="page-header" style="text-align:left">
			<?php  echo  "<h1>$name<small>$place</small></h1>"; ?>
		</div>
		<div id="info_coloumn" class="center-block">
			<div id="profile_picture_section" class="pull-left">
				<?php  echo '<img style="height:200px; " src="art/conference/'.$_GET['id'].'.jpg">'; ?>
			</div>
			<div id="info_section" >
				<div class="btn-toolbar">
					<?php

					if($check1==1){
						echo '<a href="auth/login.php" style="" class="pull-right btn btn-success">
						Attend</a> ' ;
					} else
					if($check1==2){
						echo '<a href="conferences/attendingRespond.php?id='.$id.'" style=""
						class="pull-right btn btn-success">Attend</a> ';
					} else
					if($check1==3){
						echo '<a href="conferences/conferenceReviewNew.php?id='.$id.'" style=""
						class="pull-right btn btn-success">Write Review</a> ';
						$check1 = $db->query("SELECT * FROM Development_Teams WHERE id = {$_SESSION['id']} AND   is_verified = 1

							");

						if($check1->num_rows){
							echo '<a href="#popup1" style=""
							class="pull-right btn btn-success">Add A Game</a> ';
						}

					}

					?>	
				</div>
				<table id="info_table">
					<tr>
						<td>Name:</td>
						<td><?= $name ?></td>
					</tr>
					<tr>
						<td>Start Date:</td>
						<td><?= date("d, M Y",strtotime($start)) ?></td>
					</tr>
					<tr>
						<td>End Date:</td>
						<td><?= date("d, M Y",strtotime($end)) ?></td>
					</tr>
					<tr>
						<td>Duration: </td>
						<td><?= $dur ?></td>
					</tr>
					<tr>
						<td>Place:</td>
						<td><?= $place ?></td>
					</tr>
				</table>
			</div>
		</div>
		<div id="people_coloumn" style="overflow:auto">
			<div id="toggle_friends" style="margin-top:20px; width:100%; height:50px;" class="center-block">
				<div class="tabs tabs-style-linebox">
					<nav>
						<ul>
							<li class="tab-current"><a href="#" class="icon"><span>People</span></a></li>
							<li class=""><a href="#" class="icon"><span>Games</span></a></li>
						</ul>
					</nav>
					<div class="content-wrap">
						<section id="people" class="content-current">	
							<?php  require_once('conferences/peopleAttended.php'); ?>
						</section>
						<section id="games" class="">
							<?php  require_once('conferences/gamesPresented.php'); ?>
						</section>
					</div><!-- /content -->
				</div>
			</div>
		</div>
		<div id="feed_coloumn">
			<div id="feed_section">
				<?php for( $i = 0; $i < count( $results->data ); $i++ ) : ?>
				<div id = "review">
					<h3 style="	"><strong> 	<?=  $results->data[$i]['title'] ?></strong></h3>
					<p><?= substr($results->data[$i]['r_text'], 0 , 100) ?></p>
					<?php  
					echo   ' <a href="conferenceReview.php?id='. $results->data[$i]['cr_id'].'" style=""
					class="pull-right btn btn-success">Continue</a> ';
					?>
				</div>
			<?php endfor; ?>
			<?php echo $Paginator->createLinks( $links, 'pagination pagination-sm',$id ); ?> 
		</div>
	</div>
</div>
<?php  require_once('includes/footer.php'); ?>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/cbpFWTabs.js"></script>
<!-- <script type="text/javascript" src="js/modernizr.custom.js"></script> -->
</body>
</html>
<script>
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
	// if(profile_pic_form == false){
	// 	$("#change_pp_form").fadeIn("fast");
	// 	profile_pic_form = true;
	// }
	// else{
	// 	$("#change_pp_form").fadeOut("fast");
	// 	profile_pic_form = false;
	// }
});
$(document).ready(function(){
	$("#change_pp_label").hide();
	$("#change_pp_form").hide();
});
</script>