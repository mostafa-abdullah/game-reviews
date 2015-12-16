<?php require_once('includes/dbConnection.php'); ?>
<html>
<head>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-theme.min.css" rel="stylesheet">
	<!-- <link href="css/foundation.min.css" rel="stylesheet"> -->
	<link href="css/normalize.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-1.11.3.js"></script>
</head>
<body>
	<?php require_once('includes/nav.php'); ?>


	<div class="center-block"style="height:420px;width:400px;text-align:center; padding:50px; background-color:#F7F7F7;	margin-bottom:30px;">
		<?php 
			if(isset($_SESSION['email'])){
				echo 'Hello '.$_SESSION['email'].'<br>';
				if(($_SESSION['account_type'] == 1 || $_SESSION['account_type'] == 2 )&& !$_SESSION['is_verified'])
					echo '<font color = "red">Your account is not verified!</font>';
			}
		?>

	</div>


	<?php require_once('includes/footer.php');?>

	<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>

</html>

