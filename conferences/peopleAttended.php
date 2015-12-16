<?php 
    require_once('includes/dbConnection.php');
    $people = $db->query("SELECT M.*  from Member_Attends_Conference INNER JOIN Members M
	ON m_id= M.id WHERE con_id = {$id}

 ");
echo "<h3><small>$name attended bY $people->num_rows People</small></h3><br>";

if($people->num_rows){
    while($row = $people->fetch_assoc()){
        ?>
		<div class="media" style=" background-color:#F7F7F7; padding:10px;">
			<div class="media-left">
				<a href="user.php?id=<?= $row['id'] ?>">
					<img class="media-object" height="60px" src="<?= (isset($row['profile_picture']) && !empty($row['profile_picture']))?$row['profile_picture']:$default_pp ?>" alt="...">
				</a>
			</div>
			<div class="media-body" style="text-align:left">
			<?php 
        $check1 = $db->query("SELECT * FROM Normal_Members WHERE id = {$row['id'] }

	");
    $check2 = $db->query("SELECT * FROM Verified_Reviewrs WHERE id = '{$row['id'] }

'");
$check3 = $db->query("SELECT * FROM Development_Teams WHERE id = '{$row['id'] }

'");

if($check1->num_rows){
    $check1 = $check1->fetch_object();
    $f_n = $check1->f_name;
    $s_n = $check1->l_name ;
    $m_name = $f_n ." ".$s_n ;
} else
if($check2->num_rows){
    $check2 = $check2->fetch_object();
    $f_n = $check2->f_name;
    $s_n  = $check2->l_name ;
    $m_name = $f_n ." ".$s_n ;
} else
if($check3->num_rows){
    $check3 = $check3->fetch_object();
    $m_name = $check3->team_name;
}

?>
				<a href='user.php?id=<?= $row['id'] ?>'><h4 class="media-heading"><?=$m_name?></h4></a>
			</div>
		</div>
		<?php 
}

}

?>