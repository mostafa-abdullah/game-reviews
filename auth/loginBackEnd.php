<?php
	if(isset($_POST['login'])){
		$email = $_POST['login_email'];
		$password = $_POST['login_password'];
		$encPassword = md5($password);

		if(empty($email) || empty($password)){
			echo '<font color="red">Fields cannot be empty!</font>';
		}
		else{
			$user = $db->query("SELECT * FROM Members WHERE email = '{$email}' AND password = '{$encPassword}'");
			if(!$user->num_rows){
				echo '<font color="red">Incorrect email/password!</font>';		
			}
			else
			{
				$user = $user->fetch_object();
				$_SESSION['id'] = $user->id;
				$_SESSION['email'] = $user->email;
				$_SESSION['genre'] = $user->genre;
				$check1 = $db->query("SELECT * FROM Normal_Members WHERE id={$user->id}");
				$check2 = $db->query("SELECT * FROM Verified_Reviewrs WHERE id={$user->id}");
				$check3 = $db->query("SELECT * FROM Development_Teams WHERE id={$user->id}");
				if($check1->num_rows){
					$check1 = $check1->fetch_object();
					$_SESSION['account_type'] = 0;
					$_SESSION['first_name'] = $check1->f_name;
					$_SESSION['last_name'] = $check1->l_name;
					$_SESSION['d_o_b'] = $check1->date_of_birth;
					$_SESSION['age'] = $check1->age;
					
				}
				else if($check2->num_rows){
					$check2 = $check2->fetch_object();
					$_SESSION['account_type'] = 1;
					$_SESSION['first_name'] = $check2->f_name;
					$_SESSION['last_name'] = $check2->l_name;
					$_SESSION['years'] = $check2->years_of_experience;
					$_SESSION['is_verified'] = $check2->is_verified;
				}
				else if($check3->num_rows){
					$check3 = $check3->fetch_object();
					$_SESSION['account_type'] = 2;
					$_SESSION['team_name'] = $check3->team_name;
					$_SESSION['team_company'] = $check3->company;
					$_SESSION['team_foundation'] = $check3->founding_date;
					$_SESSION['is_verified'] = $check3->is_verified;
				}
				?>
				<script>
				 window.location.href = "http://localhost/GameReviews/";
				</script>
				<?php
			}
		}
	}


?>