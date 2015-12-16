<?php 
if(!isset($_SESSION))
	session_start();
?>
<html>
<head>


</head>
<body>

	<?php if(!isset($_SESSION['id'])){   ?>
	<form method = "post" action="">
		<label for="email">Email: </label>
		<input type = "text" name = "email" id = "email">
		<br>
		<label for="password"></label>
		<input type = "password" name = "password" id = "password">
		<br>
		<input type = "submit" value = "Login" name ="login">
	</form>

	<?php }
	else{
		echo 'Hello'.' '.$_SESSION['name'];
		?>
		<form method = "post" action="">
			<input type = "submit" value = "Logout" name ="logout">
		</form>
		<?php
	}

	?>
</body>

</html>


<?php 


if(isset($_POST['logout'])){
	session_destroy();
	header("Location: login.php");
}
if(isset($_POST['login'])){

	$email = $_POST['email'];
	$password = md5($_POST['password']);

	if(validateLogin($email,$password)){
		header("Location: login.php");
	}
	else{
		echo 'invalid email/password';
	}

}

function validateLogin($email,$password){
	$db = new mysqli('localhost','root','','techhub');
	$result = $db->query("SELECT * FROM users WHERE email = '{$email}' && password = '{$password}'");
	if($result->num_rows){
		$result = $result->fetch_object();
		$_SESSION['id'] = $result->id;
		$_SESSION['name'] = $result->name;
		$_SESSION['email'] = $result->email;
		return true;
	}
	return false;
}

?>
