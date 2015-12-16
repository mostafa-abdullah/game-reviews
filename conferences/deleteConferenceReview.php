<?php require_once('../includes/dbConnection.php'); ?>
<?php if( !isset($_GET['id']) || !isset($_SESSION['id']) || !is_numeric($_GET['id']) 
	|| !is_numeric($_SESSION['id']) ){
	die('Invalid path');
} ?>

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
		if($m_id == $_SESSION['id']){
			$comments = $db->query("SELECT * FROM Conference_Review_Comments WHERE 	cr_id = {$id}");
			    while($row = $comments->fetch_assoc()) {
				$conR= $db->query("CALL   Delete_Comments_On_Conference_Review ({$row['com_id']})" );
   					 }
			$conR= $db->query("CALL  Delete_Conference_Review ({$_GET['id']}) ");
		}
 		header('Location: ../conference.php?id='.$c_id);
 ?>
 

