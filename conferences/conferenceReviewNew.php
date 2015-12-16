<?php require_once('../includes/dbConnection.php'); ?>
<?php if( !isset($_GET['id']) || !isset($_SESSION['id']) || !is_numeric($_GET['id']) 
	|| !is_numeric($_SESSION['id']) ){
	die('Invalid path');
} ?>
<?php 
$checkExists = $db->query("SELECT cr_id FROM Conference_Reviews WHERE m_id ='{$_SESSION['id']}'AND c_id = '{$_GET['id']}' ");

if( $checkExists->num_rows ){
	$checkExists = $checkExists->fetch_object();
	$id = $checkExists->cr_id;
	//echo '<script>http://localhost/GameReviews/conferenceReview.php?id='..$'</script>'
	header('Location: http://localhost/GameReviews/conferenceReview.php?id='.$id);

}

?>


<html>
<head>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/normalize.css" rel="stylesheet">
	<script type="text/javascript" src="../js/jquery-1.11.3.js"></script>
</head>
<body>
	<?php require_once('../includes/nav.php'); ?>

	<form id ="review_form" method="post" action="" style="height:400px;" class="center-block form-horizontal">
		<div class="form-group">
			<label  class="col-sm-3 control-label">Title :</label>
			<div class="col-sm-7">
				<input type="text" name="title" class="form-control" id="inputEmail3" placeholder="Title">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Body :</label>
			<div class="col-sm-7">
				<textarea style="resize:none; width:100%; height:70%;" name="text"  class="form-control" form="review_form" placeholder="You Can Write In HTML tags....."> </textarea> 
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-7">
				<button type="submit" name="write" class="btn btn-default">Write</button>
			</div>

		</div>

		<?php
		if(isset($_POST['write'])){

			$title  = $_POST['title'];
			$text = $_POST['text'];
			$d = date("Y/m/d") ;	
			$checkExists = $db->query("CALL Add_Conference_Review  ('{$_SESSION['id']}','{$_GET['id']}','{$text}','{$title}','{$d}')");
			$checkExists = $db->query("SELECT cr_id FROM Conference_Reviews WHERE m_id ='{$_SESSION['id']}'AND c_id = '{$_GET['id']}' ");
			if( $checkExists->num_rows ){
				$checkExists = $checkExists->fetch_object();
				$id = $checkExists->cr_id;
				echo '<script>window.location.href = "../conferenceReview.php?id='.$id.'"</script>';
				
			}
		}

		?>
	</form>

	
	<?php require_once('../includes/footer.php');?>

	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
</body>

</html>


<style>
#review_form
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
