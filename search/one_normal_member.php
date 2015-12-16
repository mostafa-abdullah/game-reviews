<?php

	$member_id = $member->id;
	if($type == 0 || $type == 1)
		$member_name = $member->f_name.' '.$member->l_name;
	else
		$member_name = $member->team_name;
	
	$email_and_picture = $db->query("SELECT email,profile_picture FROM Members WHERE id = {$member_id}")->fetch_object();
	$email = $email_and_picture->email;
	$profile_picture = $email_and_picture->profile_picture;

?>

<div class="media member_preview" style="<?= isset($_SESSION['id']) && $_SESSION['id'] == $member_id?'border:2px solid #D7D7D7':'' ?>">

  <div class="media-left">
    <a href="user.php?id=<?= $member_id ?>">
      <img style="border-radius:40px;width:100px;" class="media-object" src="<?= empty($profile_picture)?"art/profile_default.jpg":$profile_picture  ?>" alt="...">
    </a>
  </div>

  <div class="media-body">
    <a href="user.php?id=<?= $member_id ?>"><h4 class="media-heading"><?= $member_name ?></h4></a>
    <?= $email ?>
  </div>
</div>
	

