<?php require_once('../includes/dbConnection.php'); ?>
<?php if( !isset($_GET['id']) || !isset($_SESSION['id']) || !is_numeric($_GET['id']) 
	|| !is_numeric($_SESSION['id']) ){
	die('Invalid path');
} ?>

<?php
		$con = $db->query("SELECT * FROM  Conferences WHERE c_id ={$_GET['id']} ");
		if(!$con->num_rows){
			die('Invalid path');
		}
		$today = new DateTime("now");
		$con = $con->fetch_object();
		$id = $con->c_id;
		$name = $con->c_name;
		$start = $con->c_start_date;
		$end = $con->c_end_date	;
		$dur = $con->duration;
		$place = $con->venue;
		$today_time = strtotime($today);
		$end_time = strtotime($end);
		if($today_time < $end_time){
			 $db->query("CALL Add_Attended_Conference('{$_SESSION['id']}','{$_GET['id']}')")
 				or die(mysql_error()); 
 			header('Location: ../conference.php?id='.$id);
		}else{

 			header('Location: ../conference.php?id='.$id);
		}

		
 ?>
 

