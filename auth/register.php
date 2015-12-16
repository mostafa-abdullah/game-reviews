<?php require_once('../includes/dbConnection.php'); ?>
<?php if(isset($_SESSION['id']))
		header("Location: http://localhost/GameReviews/index.php");
 ?>
<html>
<head>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<!-- <link href="../css/bootstrap-theme.min.css" rel="stylesheet"> -->
	<!-- <link href="css/foundation.min.css" rel="stylesheet"> -->
	<link href="../css/normalize.css" rel="stylesheet">
	<script type="text/javascript" src="../js/jquery-1.11.3.js"></script>
</head>
<body>
	<?php require_once('../includes/nav.php'); ?>

	<form id ="register_form" method="post" action="" style="" class="center-block form-horizontal">
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">Email:</label>
			<div class="col-sm-7">
				<input type="email" name="reg_email" class="form-control" id="inputEmail3" placeholder="Email">
			</div>
		</div>
		<div class="form-group">
			<label for="inputPassword3" class="col-sm-3 control-label">Password:</label>
			<div class="col-sm-7">
				<input type="password" name="reg_password" class="form-control" id="inputPassword3" placeholder="Password">
			</div>
		</div>
		<div class="form-group">
			<label for="inputPassword3" class="col-sm-3 control-label">Confirm Password:</label>
			<div class="col-sm-7">
				<input type="password" name="reg_password2" class="form-control" id="inputPassword32" placeholder="Password">
			</div>
		</div>
		<div class="form-group">
			<label for="inputGenre" class="col-sm-3 control-label">Genre:</label>
			<div class="col-sm-7">
				<input type="text" name="reg_genre" class="form-control" id="inputGenre" placeholder="Genre">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Account Type:</label>
			<div class="col-sm-7">
				<div class="radio">
					<label>
						<input type="radio" name="reg_accountType" id="type0" value="0" checked>
						Normal User
					</label>
				</div>
				<div class="radio">
					<label>
						<input type="radio" name="reg_accountType" id="type1" value="1">
						Verified Reviewer
					</label>
				</div>
				<div class="radio">
					<label>
						<input type="radio" name="reg_accountType" id="type2" value="2">
						Development Team
					</label>
				</div>
			</div>
		</div>
		<div id="normalUserForm">
			<!-- Normal Member special form -->
			<div class="form-group">
				<label for="normal_firstName" class="col-sm-3 control-label">First Name:</label>
				<div class="col-sm-7">
					<input type="text" name="reg_normal_firstName" class="form-control" id="normal_firstName" placeholder="First name">
				</div>
			</div>
			<div class="form-group">
				<label for="normal_lastName" class="col-sm-3 control-label">Last Name:</label>
				<div class="col-sm-7">
					<input type="text" name="reg_normal_lastName" class="form-control" id="normal_lastName" placeholder="Last name">
				</div>
			</div>
			<div class="form-group">
				<label for="normal_dob" class="col-sm-3 control-label">Date of Birth</label>
				<div class="col-sm-7">
					<input type="date" name="reg_normal_dob" class="form-control" id="normal_dob" placeholder="Date of birth">
				</div>
			</div>
		</div>
		<div id="verifiedReviwerForm">
			<!-- Verified Reviewer special form -->
			<div class="form-group">
				<label for="vf_firstName" class="col-sm-3 control-label">First Name:</label>
				<div class="col-sm-7">
					<input type="text" name="reg_vf_firstName" class="form-control" id="vf_firstName" placeholder="First name">
				</div>
			</div>
			<div class="form-group">
				<label for="vf_lastName" class="col-sm-3 control-label">Last Name:</label>
				<div class="col-sm-7">
					<input type="text" name="reg_vf_lastName" class="form-control" id="vf_lastName" placeholder="Last name">
				</div>
			</div>
			<div class="form-group">
				<label for="vf_years" class="col-sm-3 control-label">Experience:</label>
				<div class="col-sm-7">
					<input type="number" name="reg_vf_years" class="form-control" id="vf_years" placeholder="Years of experience">
				</div>
			</div>
		</div>
		<div id="developmentTeamForm">
			<!-- Dev Team special form -->
			<div class="form-group">
				<label for="team_name" class="col-sm-3 control-label">Team Name:</label>
				<div class="col-sm-7">
					<input type="text" name="reg_team_name" class="form-control" id="team_name" placeholder="Team name">
				</div>
			</div>
			<div class="form-group">
				<label for="team_company" class="col-sm-3 control-label">Company Name:</label>
				<div class="col-sm-7">
					<input type="text" name="reg_team_company" class="form-control" id="team_company" placeholder="Company name">
				</div>
			</div>
			<div class="form-group">
				<label for="team_foundation" class="col-sm-3 control-label">Foundation Date:</label>
				<div class="col-sm-7">
					<input type="date" name="reg_team_foundation" class="form-control" id="team_foundation" placeholder="Date of foundation">
				</div>
			</div>
		</div>

		<!-- <div class="form-group">
			<div class="col-sm-offset-2 col-sm-7">
				<div class="checkbox">
					<label>
						<input type="checkbox"> Remember me
					</label>
				</div>
			</div>
		</div> -->
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-7">
				<button type="submit" name="register" class="btn btn-default">Register</button>
			</div>
		</div>
		<?php require_once('registerBackEnd.php'); ?>
	</form>

	
	<?php require_once('../includes/footer.php');?>

	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
</body>

</html>


<script>
$(document).ready(function(){

	$('#verifiedReviwerForm').hide();
	$('#developmentTeamForm').hide();
});
$('input[type=radio][name=reg_accountType]').change(function(){
	if(this.value == 0){
		$('#normalUserForm').show();
		$('#verifiedReviwerForm').hide();
		$('#developmentTeamForm').hide();
	}
	else if(this.value == 1){
		$('#normalUserForm').hide();
		$('#verifiedReviwerForm').show();
		$('#developmentTeamForm').hide();
	}
	else{
		$('#normalUserForm').hide();
		$('#verifiedReviwerForm').hide();
		$('#developmentTeamForm').show();
	}
});
</script>

<style>
	#register_form
	{
		border-radius:10px; 
		border:1px solid #C1C1C1; 
		background-color: #F8F8F8; 
		padding:30px; 
		width:50%; 
		margin-top:20px;
		margin-bottom:30px;
	}
</style>
