<?php require_once('includes/dbConnection.php'); ?>
<?php if(!isset($_GET['id'])){
	die('Invalid path');
} ?>
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
</head
<body>
	<?php require_once('includes/nav.php'); ?>
	<div class="container" style="text-align:center;background-color:#F7F7F7; margin-bottom:50px; padding:30px;">
		<?php
		$con = $db->query("SELECT * FROM Conferences WHERE c_id = {$_GET['id']}");
		if(!$con->num_rows){
			die('Conference not found.');
		}	
		$con = $con->fetch_object();
		$id = $con->c_id;
		$name = $con->c_name;
		$start = $con->c_start_date;
		$end = $con->c_end_date	;
		$dur = $con->duration;
		$place = $con->venue;
		$check1 = 1;
		if(isset($_SESSION['id']) ){
			$check1= $db->query("SELECT * FROM Member_Attends_Conference 
				WHERE con_id = {$_GET['id']} AND m_id = {$_SESSION['id']} ");
			if($check1->num_rows) 
				$check1 =3;
			else
				$check1 =2;
		}
		?>
		<div id="popup1" class="overlay">
		<div class="popup">
		<h2>Select a geme</h2>
		<a class="close" href="#">x</a>
		<div class="content">
<form method="post" action="">
<div class="select-style">
  <select name = "selectgame">
		<?php 

		$games = $db->query("SELECT   G.*  FROM DevelopmentTeam_Develops_Game G1 
		 INNER JOIN Games  G ON G1.g_id = G.g_id WHERE G1.team_id = {$_SESSION['id']} 
			AND G1.g_id NOT IN (SELECT G2.g_id FROM DevelopmentTeam_Presents_Game G2 WHERE G2.c_id = {$_GET['id']})");
	
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








		</div>
			</div>
			</div>

		<div class="page-header" style="text-align:left">
			<?php 
			 echo  "<h1>$name<small>$place</small></h1>";
			?>
		</div>
		<div id="info_coloumn" class="center-block">
			<div id="profile_picture_section" class="pull-left">
			<?php 

				echo '<img style="height:200px; " src="art/conference/'.$_GET['id'].'.jpg">';
			?>
			</div>
			<div id="info_section" >
					  <div class="btn-toolbar">

			<?php
				 if($check1==1){ 
				echo '<a href="auth/login.php" style="" class="pull-right btn btn-success">
				Attend</a> ' ;
				 } else if($check1==2){ 
				 echo '<a href="conferences/attendingRespond.php?id='.$id.'" style=""
				 class="pull-right btn btn-success">Attend</a> ';
				 } else if($check1==3){ 
				 echo '<a href="conferences/conferenceReviewNew.php?id='.$id.'" style=""
				 class="pull-right btn btn-success">Write Review</a> ';
				$check1 = $db->query("SELECT * FROM Development_Teams WHERE id = {$_SESSION['id']} ");
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
		<div id="people_coloumn">
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
							<?php require_once('conferences/peopleAttended.php'); ?>
						</section>
						<section id="games" class="">
							<?php require_once('conferences/gamesPresented.php'); ?>
						</section>
					</div><!-- /content -->
				</div>
			</div>

		</div>
		<div id="feed_coloumn">
			<div id="feed_section">
			<?php 
		$people = $db->query("SELECT M.*  from Member_Attends_Conference INNER JOIN Members M
					ON m_id= M.id WHERE con_id = {$id} ");
		echo "<h3><small>$name Attended BY $people->num_rows People</small></h3><br>";
		if($people->num_rows){
		while($row = $people->fetch_assoc()){
			?>
		<div class="media" style=" background-color:#F7F7F7; padding:10px;">
			<div class="media-left">
				<a href="user.php?id=<?= $row['id'] ?>">
					<img class="media-object" height="60px" src="art/profile_default.jpg" alt="...">
				</a>
			</div>
			<div class="media-body" style="text-align:left">
				<a href='user.php?id=<?= $row[id] ?>'><h4 class="media-heading"><?=$row['email']?></h4></a>
			</div>
		</div>
		<?php 
}

}


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
