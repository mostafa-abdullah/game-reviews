<?php
$my_id=$_SESSION['id'];
if($result=$db->query("SELECT * FROM Verified_Reviewrs WHERE id= {$my_id}")){
	if($result->num_rows){
		echo '<a href="#">Add Review</a>';
	}
	

}
?>