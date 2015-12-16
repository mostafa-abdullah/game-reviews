<?php
if(isset($_SESSION['info_updated'])  && $_SESSION['info_updated'] == 1){
		unset($_SESSION['info_updated']);
		?>


		<div class="alert alert-success">Info updated successfully</div>
		<?php 
	}
if(isset($_POST['update_info'])){

	$genre = $_POST['update_genre'];
	if($account_type == 0){
		$first_name = $_POST['update_normal_firstName'];
		$last_name = $_POST['update_normal_lastName'];
		$dob = $_POST['update_normal_dob'];
		$errors = verify_normal_user($first_name, $last_name, $dob);
		if(count($errors) == 0){
			$success = 1;
			$db->query("UPDATE Members SET genre = '{$genre}' WHERE id={$id}");
			$db->query("CALL Update_Normal_Member({$id},'{$first_name}','{$last_name}','{$dob}')");
			$_SESSION['info_updated'] = 1;
			$_SESSION['first_name'] = $first_name;
			$_SESSION['last_name'] = $last_name;
			$_SESSION['d_o_b'] = $dob;
			$_SESSION['genre'] = $genre;
			$_SESSION['age'] = $db->query("SELECT age FROM Normal_Members WHERE id={$id}")->fetch_object()->age;
			echo '<script>window.location.href = "http://localhost/GameReviews/user.php?id='.$id.'";</script>';
		}
		else{
			?>
			<div class="alert alert-danger">
				<?php 
				foreach ($errors as $error) {
					echo '<li>'.$error.'</li>';
				}
				?>
			</div>
			<?php
		}
	}
	else if($account_type == 1){
		$first_name = $_POST['update_vf_firstName'];
		$last_name = $_POST['update_vf_lastName'];
		$years = $_POST['update_vf_years'];
		$errors = verify_vf($first_name, $last_name, $years);
		if(count($errors) == 0){
			$success = 1;
			$db->query("UPDATE Members SET genre = '{$genre}' WHERE id={$id}");
			$db->query("CALL Update_Verified_Reviewer({$id},'{$first_name}','{$last_name}','{$years}')");
			$_SESSION['info_updated'] = 1;
			$_SESSION['first_name'] = $first_name;
			$_SESSION['last_name'] = $last_name;
			$_SESSION['years'] = $years;
			$_SESSION['genre'] = $genre;
			echo '<script>window.location.href = "http://localhost/GameReviews/user.php?id='.$id.'";</script>';
		}
		else{
			?>
			<div class="alert alert-danger">
				<?php 
				foreach ($errors as $error) {
					echo '<li>'.$error.'</li>';
				}
				?>
			</div>
			<?php
		}
	}
	else
	{
		$team_name = $_POST['update_team_name'];
		$team_company = $_POST['update_team_company'];
		$team_foundation = $_POST['update_team_foundation'];
		$errors = verify_team($team_name, $team_company, $team_foundation);
		if(count($errors) == 0){
			$success = 1;
			$db->query("UPDATE Members SET genre = '{$genre}' WHERE id={$id}");
			$db->query("CALL Update_Development_Team({$id},'{$team_name}','{$team_company}','{$team_foundation}')");
			$_SESSION['info_updated'] = 1;
			$_SESSION['team_name'] = $team_name;
			$_SESSION['team_company'] = $company;
			$_SESSION['team_foundation'] = $team_foundation;
			$_SESSION['genre'] = $genre;
			echo '<script>window.location.href = "http://localhost/GameReviews/user.php?id='.$id.'";</script>';
		}
		else{
			?>
			<div class="alert alert-danger">
				<?php 
				foreach ($errors as $error) {
					echo '<li>'.$error.'</li>';
				}
				?>
			</div>
			<?php
		}
	}
	

	
}


function verify_normal_user($first_name, $last_name, $dob){
	$errors = array();
	if(empty($first_name) || empty($last_name) || empty($dob))
		$errors[] = 'Normal user fields cannot be empty!';
	return $errors;
}

function verify_vf($first_name, $last_name, $years){
	$errors = array();
	if(empty($first_name) || empty($last_name) || empty($years))
		$errors[] = 'Verified reviewer fields cannot be empty!';
	return $errors;
}


function verify_team($team_name, $team_company, $team_foundation){
	$errors = array();
	if(empty($team_name) || empty($team_company) || empty($team_foundation))
		$errors[] = 'Development team fields cannot be empty!';
	return $errors;
}


?>