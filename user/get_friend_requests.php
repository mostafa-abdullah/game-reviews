<?php


$requests = $db->query("SELECT  NAN.m1_id AS m_id  FROM NormalMember_AddFriend_NormalMember NAN 
	where NAN.m2_id={$_SESSION['id']} and NAN.is_accepted IS NULL;");
	//$requests = $db->query("CALL Pending_Requests(".$_SESSION['id'].")");
if(!$requests->num_rows){
	echo '<p style="font-size:40px; color:#AAAAAA">No requests.</p>';
}
while ($request = $requests->fetch_object()) {
	$user = $db->query("SELECT * FROM Normal_Members WHERE id= {$request->m_id}");
	$user = $user->fetch_object();
	?>
	<div class="media" style=" background-color:#F7F7F7; padding:10px;">
		<div class="media-left">
			<a href="user.php?id=<?= $user->id ?>">
				<?php if(isset($user->profile_picture) && !empty($user->profile_picture)) { ?>
				<img class="media-object" height="60px" src="<?= $friend->profile_picture ?>" alt="...">
				<?php }else{ ?>
				<img class="media-object" height="60px" src="art/profile_default.jpg" alt="...">
				<?php } ?>
			</a>
		</div>
		<div class="media-body" style="text-align:left">
			<a href='user.php?id=<?= $user->id ?>'><h4 class="media-heading"><?= $user->f_name.' '.$user->l_name ?></h4></a>
			<div class="pull-right">
				<input class="requester_id" type="hidden" value="<?= $user->id; ?>">
				<a class="accept_friend_request" data-toggle="tooltip" data-placement="bottom" style="margin-right:20px;" title="Accept" ><font color="Green"><span class="glyphicon glyphicon-ok"></span></font></a>
				<a class="reject_friend_request" data-toggle="tooltip" data-placement="bottom" title="Reject"><font color="#CC0000"><span class="glyphicon glyphicon-remove"></span></font></a>
			</div>

		</div>
	</div>

	<?php
}

?>

<script>
$('.accept_friend_request').click(function(){
	var my_id = <?= $_SESSION['id']; ?>;
	var his_id = $(this).parent().find('.requester_id').val();
	var thisElemet = $(this);
	$.ajax({
		url: 'user/accept_friend_request.php',
		data: {my_id:my_id, his_id:his_id},
		success: function(data){
			thisElemet.parent().html(data);
		},


	});
});

$('.reject_friend_request').click(function(){
	var my_id = <?= $_SESSION['id']; ?>;
	var his_id = $(this).parent().find('.requester_id').val();
	var thisElemet = $(this);
	$.ajax({
		url: 'user/reject_friend_request.php',
		data: {my_id:my_id, his_id:his_id},
		success: function(data){
			thisElemet.parent().html(data);
		},


	});
});
</script>