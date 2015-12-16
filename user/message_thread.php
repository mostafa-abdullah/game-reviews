
<?php
if(file_exists('../includes/dbConnection.php'))
	require_once('../includes/dbConnection.php');
if(isset($_GET['his_id'])){
	
$my_id = $_SESSION['id'];
$his_id = $_GET['his_id'];
if(!isset($_SESSION['id']))
	die('Sorry, you are not logged in');
$checkFriends = $db->query("SELECT is_accepted FROM NormalMember_addFriend_NormalMember WHERE (m1_id={$my_id} AND m2_id={$his_id} OR m1_id={$his_id} AND m2_id={$my_id}) AND is_accepted=TRUE");
if(!$checkFriends->num_rows)
	die('Sorry, you can only message your friends');

$messages = $db->query("SELECT * FROM NormalMember_SendMessage_NormalMember WHERE (m1_id={$my_id} AND m2_id={$his_id}) OR (m1_id={$his_id} AND m2_id={$my_id})");
if(!$messages->num_rows){
	echo 'No messages to show';
}
else{
	while($message = $messages->fetch_object()){
		?>
		<div class="<?= $message->m1_id==$my_id?'my_message':'his_message' ?>">
			<div class="message_text">
				<?= $message->message_text ?>
			</div>
		</div>
		<br>

		<?php
	}
	$db->query("UPDATE NormalMember_SendMessage_NormalMember SET is_read = TRUE WHERE m1_id = {$his_id} AND m2_id = {$my_id}");
}
}

?>
<style>
.my_message .message_text{
	float: right;
	//display: inline-block;
	background-color: #DAE9FF;
	border-radius: 10px;
	padding: 7px;

	max-width: 40%;


	}
	.his_message .message_text{
		float: left;
		background-color: #FF9F9F;
		border-radius: 10px;
		padding: 7px;
		max-width: 40%;
		
	}
	.my_message{
		width: 100%;
		//margin-top: 20px;
		//background-color: red;
		//width: 100px;
	}
	.his_message{
		width: 100%;
		//height: 100px;
		//margin-top: 20px;
		//background-color: green;
	}

	</style>

	<script type="text/javascript">
		$(document).ready(function(){
			$('.my_message').css('height',$(this).find('.message_text').height());
			$('.his_message').css('height',$(this).find('.message_text').height());
		});
	</script>
