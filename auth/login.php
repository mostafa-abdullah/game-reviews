<?php require_once('../includes/dbConnection.php'); ?>
<?php 
if(isset($_SESSION['id']))
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
	<form id = "login_form" method="post" action="" class="form-horizontal center-block">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="email" name="login_email" class="form-control" id="login_email" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" name="login_password" class="form-control" id="login_password" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input name="remember_me" type="checkbox"> Remember me
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="login" class="btn btn-default">Sign in</button>
    </div>
  </div>
  <?php require_once('loginBackEnd.php'); ?>
</form>

	
	<?php require_once('../includes/footer.php');?>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
</body>
</html>

<style>
	#login_form
	{
		border-radius:10px; 
		border:1px solid #C1C1C1; 
		background-color: #F8F8F8; 
		padding:30px; 
		width:50%; 
		margin-top:100px;
		margin-bottom:130px;
	}
</style>