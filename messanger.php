<?php require_once('includes/dbConnection.php'); ?>
<?php if(!isset($_SESSION['id']) || $_SESSION['account_type'] != 0) die('You are not a normal member'); ?>
<html>
<head>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<!-- <link href="../css/bootstrap-theme.min.css" rel="stylesheet"> -->
	<!-- <link href="css/foundation.min.css" rel="stylesheet"> -->
	<link href="css/normalize.css" rel="stylesheet">
	<link href="css/tabs.css" rel="stylesheet">
	<link href="css/tabstyles.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-1.11.3.js"></script>
</head>
<body>
	<?php require_once('includes/nav.php'); ?>
	<div class="container" style="text-align: center;background-color:#F7F7F7; margin-bottom:50px; padding:30px;">
		<div id="friends_list">
			<?php require_once('user/messanger_friends_list.php'); ?>
		</div>
		<div id="chat_section">
			<div id="message_thread_section">
				<?php require_once('user/message_thread.php'); ?>
			</div>
			<?php if(isset($_GET['his_id'])){ ?>
			<div id="send_message_section">
				<textarea class="form-control" style="display:inline-block; resize:none; height:100%; width:80%" name="answer" id="message_text"></textarea>
				<a id="send_message_button" style="cursor:pointer" class="btn btn-default">Send message</a><br>
				<div style="color:red" id="message_feedback"></div>
			</div>
			<?php } ?>
		</div>

	</div>

	<?php require_once('includes/footer.php'); ?>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>

<script>
$('#send_message_button').click(function(){
	var message_text = $('#message_text').val();
	if(message_text == ''){
		$('#message_feedback').text('Message text cannot be empty!');
	}
	else{
		var my_id = <?= $_SESSION['id'] ?>;
		var his_id = <?= $_GET['his_id'] ?>;
		$('#message_feedback').text('');
		$('#message_text').val('');
		$.ajax({
			url: 'user/send_message.php',
			data: {my_id:my_id, his_id:his_id, message_text:message_text},
			success: function(data){
				$('#message_thread_section').html(data);
				$("#message_thread_section").animate({ scrollTop: $("#message_thread_section")[0].scrollHeight}, 0);
				
	},
});
}

});
var serverPull = <?= isset($_GET['his_id'])?'true':'false' ?>;
if(serverPull == true){
	
var interval = setInterval(function(){  
		$.ajax({
			url: 'user/message_thread.php?his_id=<?= $_GET["his_id"] ?>',
			success: function(data){
				$('#message_thread_section').html(data);
				$("#message_thread_section").animate({ scrollTop: $("#message_thread_section")[0].scrollHeight}, 0);
			}

		});
	},2500);
}
$(document).ready(function(){
	$("#message_thread_section").animate({ scrollTop: $("#message_thread_section")[0].scrollHeight}, 1000);
});
</script>
<style>
#friends_list{
	height: 90%;
	width: 30%;
	margin: 10px;
	padding: 20px;
	overflow: auto;
	display: inline-block;
	background-color: #F1F1F1;
	vertical-align: top;
}
#chat_section{
	height: 90%;
	width: 60%;
	//overflow: auto;
	margin: 10px;
	display: inline-block;

	vertical-align: top;
}
#message_thread_section
{
	height: 70%;
	width: 100%;
	overflow: auto;
	background-color: white;
	padding: 20px;
	display: inline-block;
}
#send_message_section{
	height: 23%;
	width: 100%;
	margin-top: 20px;
}
</style>