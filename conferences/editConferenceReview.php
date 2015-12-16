<?php require_once('includes/dbConnection.php'); ?>
<?php if(!isset($_GET['id'])){
	die('Invalid path');
} ?>
<html>
<head>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/normalize.css" rel="stylesheet">
	<link href="css/tabs.css" rel="stylesheet">
	<link href="css/tabstyles.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-1.11.3.js"></script>
</head>
<body>
	<?php require_once('includes/nav.php'); ?>
	<div class="container" style="text-align:center;background-color:#F7F7F7; margin-bottom:50px; padding:30px;">

		<?php
		$cr = $db->query("SELECT * FROM Conference_Reviews WHERE cr_id = {$_GET['id']}");
		if(!$cr->num_rows){
			die('Conference_Review not found.');
		}
		$cr = $cr->fetch_object();
		$id = $cr->cr_id;
		$text = $cr->r_text;
		$m_id = $cr->m_id;
		$c_id = $cr->c_id;
		$title = $cr->title;

		?>
		<div class="page-header" style="text-align:left">
		<?php 
		if($_SESSION['id']==$m_id){
		 echo '<a href="conferences/deleteConferenceReview.php?id='.$id.'" style=""
			 class="pull-right btn btn-success">Delete</a> 
		 <a href="conferences/editConferenceReview.php?id='.$id.'" style=""
			 class="pull-right btn btn-success">Edit</a> ';

		}
		?>
		<h1> <?= $title ?></h1>
		</div>
		<div id="info_coloumn" class="center-block">
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