<?php
if(isset($_POST['register'])){
	$email = $_POST['reg_email'];
	$password = $_POST['reg_password'];
	$confirmPassword = $_POST['reg_password2'];
	$genre = $_POST['reg_genre'];
	$accType = $_POST['reg_accountType'];

	$errors = verify_general_date($email,$password,$confirmPassword,$genre);
	$checkExists = $db->query("SELECT email FROM Members WHERE email = '{$email}'");
	if($checkExists->num_rows){
		$errors[] = 'This email is already registered!';
	}
	if(count($errors) == 0){

		
		$password = md5($password);
		if($_POST['reg_accountType'] == 0){
			//register as normal user
			$first_name = $_POST['reg_normal_firstName'];
			$last_name = $_POST['reg_normal_lastName'];
			$dob = $_POST['reg_normal_dob'];
			$errors = verify_normal_user($first_name, $last_name, $dob);

			if(count($errors) == 0){
				$dob = date("Y/m/d",strtotime($dob));
				$db->query("CALL Sign_up('{$email}','{$password}','{$genre}',{$accType})");
				$my_id = $db->query("SELECT id FROM Members WHERE email = '{$email}'");
				$my_id = $my_id->fetch_object()->id;
				$db->query("CALL Update_Normal_Member({$my_id},'{$first_name}','{$last_name}','{$dob}')");
				echo '<script>window.location.href="login.php"</script>';
			}
			else{
				foreach ($errors as $error) {
					echo '<li style="color:red">'.$error.'</li>';
				}
			}
		}

		else if($_POST['reg_accountType'] == 1){
			//register as verified reviewer
			$first_name = $_POST['reg_vf_firstName'];
			$last_name = $_POST['reg_vf_lastName'];
			$years = $_POST['reg_vf_years'];
			$errors = verify_vf($first_name, $last_name, $years);

			if(count($errors) == 0){
				$db->query("CALL Sign_up('{$email}','{$password}','{$genre}',{$accType})");
				$my_id = $db->query("SELECT id FROM Members WHERE email = '{$email}'");
				$my_id = $my_id->fetch_object()->id;
				$db->query("CALL Update_Verified_Reviewer({$my_id},'{$first_name}','{$last_name}','{$years}')");
				echo '<script>window.location.href="login.php"</script>';
			}
			else{
				foreach ($errors as $error) {
					echo '<li style="color:red">'.$error.'</li>';
				}
			}
		}

		else{
			//register as dev team
			$team_name = $_POST['reg_team_name'];
			$team_company = $_POST['reg_team_company'];
			$team_foundation = $_POST['reg_team_foundation'];
			$errors = verify_team($team_name, $team_company, $team_foundation);
			if(count($errors) == 0){
				$db->query("CALL Sign_up('{$email}','{$password}','{$genre}',{$accType})");
				$my_id = $db->query("SELECT id FROM Members WHERE email = '{$email}'");
				$my_id = $my_id->fetch_object()->id;
				$db->query("CALL Update_Development_Team({$my_id},'{$team_name}','{$team_company}','{$team_foundation}')");
				echo '<script>window.location.href="login.php"</script>';
			}
			else{
				foreach ($errors as $error) {
					echo '<li style="color:red">'.$error.'</li>';
				}
			}
		}
	}
	else
	{
		// show errors
		foreach ($errors as $error) {
			echo '<li style="color:red">'.$error.'</li>';
		}
	}
}


function verify_general_date($email,$password,$confirmPassword,$genre){
	$errors = array();
	if($password != $confirmPassword)
		$errors[] = 'Passwords don\'t match!';
	if(empty($email) || empty($password) || empty($confirmPassword) || empty($genre))
		$errors[] = 'Fields cannot be empty!';
	else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
		$errors[] = 'Email format is invalid. Must be \'email@something.something\'';

	return $errors;
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