<?php 

$friends = $db->query("SELECT m2_id AS f_id from NormalMember_AddFriend_NormalMember NAN WHERE m1_id = {$_SESSION['id']} AND is_accepted = TRUE
	UNION
	select m1_id AS f_id from NormalMember_AddFriend_NormalMember NAN WHERE m2_id = {$_SESSION['id']} AND is_accepted = TRUE");



if($friends->num_rows){
	while($friend = $friends->fetch_object()){
		$friend_id = $friend->f_id;
 		$friend = $db->query("SELECT * FROM Members M INNER JOIN Normal_Members NM ON M.id = NM.id AND M.id = {$friend_id}");
 		$friend = $friend->fetch_object();
 		$newMessages = $db->query("SELECT * FROM NormalMember_SendMessage_NormalMember WHERE m1_id = {$friend_id} AND m2_id = {$_SESSION['id']} AND is_read=FALSE");
 		$newMessages = $newMessages->num_rows;
 		
		?>
		<div class="media" style=" background-color:#F7F7F7; padding:10px;">
			<div class="media-left">
				<a href="messanger.php?his_id=<?= $friend_id ?>">
					<?php if(isset($friend->profile_picture) && !empty($friend->profile_picture)) { ?>
					<img class="media-object" height="60px" src="<?= $friend->profile_picture ?>" alt="...">
					<?php }else{ ?>
					<img class="media-object" height="60px" src="art/profile_default.jpg" alt="...">
					<?php } ?>
				</a>
			</div>
			<div class="media-body" style="text-align:left">
				<a href='messanger.php?his_id=<?= $friend_id ?>'><h4 class="media-heading"><?= $friend->f_name.' '.$friend->l_name ?></h4></a>
				<?php if($newMessages) { ?>
				<small><font color="red"><?= $newMessages.' new messages.' ?></font></small>
				<?php } ?>
			</div>
		</div>

		<?php
	}
}
?>