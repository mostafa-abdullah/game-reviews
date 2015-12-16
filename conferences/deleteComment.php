<?php require_once('../includes/dbConnection.php'); ?>
<?php if( !isset($_GET['id']) || !isset($_SESSION['id']) || !is_numeric($_GET['id']) 
	|| !is_numeric($_SESSION['id']) ){
	die('Invalid path');
} ?>

<?php
		$cr = $db->query("SELECT * FROM Conference_Review_Comments WHERE com_id = {$_GET['id']}");
		if(!$cr->num_rows){
			die('Conference_Review not found.');
		}
		$cr = $cr->fetch_object();
		$id = $cr->com_id;
		$m_id = $cr->m_id;
		$cr_id = $cr->cr_id;
		if($m_id == $_SESSION['id'])
			$conR= $db->query("CALL   Delete_Comments_On_Conference_Review  ({$id}) ");
 		header('Location: ../conferenceReview.php?id='.$cr_id);
 ?>
 

