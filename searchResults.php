<?php require_once('includes/dbConnection.php'); ?>
<?php if(!isset($_GET['key']) || empty($_GET['key'])){
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
	<div id="search_container" class="container" style="width:50%; text-align: left;background-color:#F7F7F7; margin-bottom:50px; padding:30px;">
		<?php 
		$query = "CALL Search('{$_GET['key']}')";
		if ($db->multi_query($query)) {
			
			$result = $db->store_result();
			$db->next_result();
			$normal_members = $db->store_result();
			$db->next_result();
			$games = $db->store_result();
			$db->next_result();
			$conferences = $db->store_result();
			$db->next_result();
			$ver_rev = $db->store_result();
			$db->next_result();
			$dev_teams = $db->store_result();
			$db->next_result();
			$communties = $db->store_result();
			$db->next_result();
			?>
			
			<div style="cursor:pointer" href="#normal_members_resutls" data-toggle="collapse" class="page-header" style="text-align:left">
				<h1>Normal Members:</h1>
			</div>
			<div id="normal_members_resutls" class="collapse">
				<?php 
				if(!$normal_members->num_rows){
					echo 'No normal members to show.';
				}
				else{
					$type = 0;
					while($member = $normal_members->fetch_object()){
						require('search/one_normal_member.php');
					}
				}
				?>
			</div>

			
			<div class="separator"></div>
			<div style="cursor:pointer" href="#games_resutls" data-toggle="collapse" class="page-header" style="text-align:left">
				
				<h1>Games:</h1>
				

			</div>
			<div id="games_resutls" class="collapse in">
				<?php 
				if(!$games->num_rows){
					echo 'No games to show.';
				}
				else{
					while($game = $games->fetch_object()){
						require('search/one_game.php');
					}
				}
				?>
			</div>
			<div class="separator"></div>
			<div style="cursor:pointer" href="#conferences_resutls" data-toggle="collapse" class="page-header" style="text-align:left">
				<h1>Conferences:</h1>
				
			</div>
			<div id="conferences_resutls" class="collapse in">
				<?php 
				if(!$conferences->num_rows){
					echo 'No conferences to show.';
				}
				else{
					while($conference = $conferences->fetch_object()){
						require('search/one_conference.php');
					}
				}
				?>
			</div>
			<div class="separator"></div>
			<div style="cursor:pointer" href="#ver_rev_resutls" data-toggle="collapse" class="page-header" style="text-align:left">
				<h1>Verified Reviewrs:</h1>
				
			</div>
			<div id="ver_rev_resutls" class="collapse in">
				<?php 
				if(!$ver_rev->num_rows){
					echo 'No verified reviewers to show.';
				}
				else{
					$type = 1;
					while($member = $ver_rev->fetch_object()){
						require('search/one_normal_member.php');
					}
				}
				?>
			</div>
			<div class="separator"></div>
			<div style="cursor:pointer" href="#dev_teams_resutls" data-toggle="collapse" class="page-header" style="text-align:left">
				<h1>Development Teams:</h1>
				
			</div>
			<div id="dev_teams_resutls" class="collapse in">
				<?php 
				if(!$dev_teams->num_rows){
					echo 'No development teams to show.';
				}
				else{
					$type = 2;
					while($member = $dev_teams->fetch_object()){
						require('search/one_normal_member.php');
					}
				}
				?>
			</div>
			<div class="separator"></div>
			<div style="cursor:pointer" href="#communities_resutls" data-toggle="collapse" class="page-header" style="text-align:left">
				<h1>Communities:</h1>
				
			</div>
			<div id="communities_resutls" class="collapse in">
				<?php 
				if(!$communties->num_rows){
					echo 'No communties to show.';
				}
				else{
					while($community = $communties->fetch_object())
					{
						require('search/one_community.php');
					}
				}
				?>
			</div>


			<?php


		}
		// $results = $db->query("CALL Search('mostafa')");
		// var_dump($results->fetch_object()->num_rows);




		?>
	</div>
	<?php require_once('includes/footer.php'); ?>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>
</body>
</html>

<script>
$('.collapse').collapse();
</script>
<style>
.separator{
	height: 60px;
	background-color: white;
	//width: 110%; 
	margin-top: 20px;
	margin-left: -36px;
	margin-right: -36px;
	border-top: 2px solid #D8D8D8;
	border-bottom: 2px solid #D8D8D8;
	border-radius: 20px;
}
.member_preview{
	margin: 10px 40px 20px 20px;
	padding: 10px;
	border-radius: 20px;
	background-color: #F1F1F1;

}
#search_container{
	border: 2px solid #D8D8D8;
	border-radius: 20px;
}
 .game_table td{
    padding: 5px;
    width: 150px;
}
.conference_table td{
	padding: 10px;
    width: 250px;
}
.conference_preview{
	margin: 40px 40px 40px 20px;
	padding: 20px;
	border-radius: 20px;
	background-color: #F1F1F1;
}

</style>