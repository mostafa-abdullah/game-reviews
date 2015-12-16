<?php

	$game_id = $game->g_id;
	$check1 = $db->query("SELECT * FROM Strategy_Games WHERE st_id={$game_id}");
	$check2 = $db->query("SELECT * FROM Action_Games WHERE ac_id={$game_id}");;
	$check3 = $db->query("SELECT * FROM Sport_Games WHERE sp_id={$game_id}");;
	$check4 = $db->query("SELECT * FROM RPG_Games WHERE RPG_id={$game_id}");;

	if($check1->num_rows){
		$type = 0;
        $t_s = 'strategy';
		$check1 = $check1->fetch_object();
	}
	else if($check2->num_rows){
		$type = 1;
        $t_s = 'action';
		$check2 = $check2->fetch_object();
	}
	else if($check3->num_rows){
		$type = 2;
        $t_s = 'sport';
		$check3 = $check3->fetch_object();
	}
	else if($check4->num_rows){
		$type = 3;
        $t_s = 'rpg';
		$check4 = $check4->fetch_object();
	}
	else{
        $t_s = 'unknown';
		$type = -1;
	}
?>

<div class="media member_preview" >

  <div class="media-left">
    <a href="game.php?id=<?= $game_id ?>">
        <?php if($type>=0){ ?>
      <img style="border-radius:0px;width:100px;" class="media-object" src="art/<?= $t_s ?>_game.png" alt="...">
      <?php }else{
        ?>
        <div style="width:100px;height:100px; background-color:#F7F7F7" class="media-object"></div>
        <?php
      } ?>
    </a>
  </div>

  <div class="media-body">
    <a href="game.php?id=<?= $game_id ?>"><h4 class="media-heading"><?= $game->g_name ?></h4></a>
 
    <table class="game_table">
    	<tr>
    		<td>Type: </td>
    		<td><?php 
    			if($type == 0)
    				echo 'Strategy';
    			else if($type == 1)
    				echo 'Action';
    			else if($type == 2)
    				echo 'Sport';
    			else if($type == 3)
    				echo 'RPG';
    			else
    				echo 'Unknown';
    		?></td>
    	</tr>
    	<tr>
    		<td>Release: </td>
    		<td><?= $game->g_r_date ?></td>
    	</tr>
    	<tr>
    		<td>Rating: </td>
    		<td><?= $game->g_rating ?></td>
    	</tr>
    	<tr>
    		<td>Age Limit: </td>
    		<td><?= $game->g_age_limit ?></td>
    	</tr>
    </table>
    
  </div>
</div>
	