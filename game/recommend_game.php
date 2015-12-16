<div class="modal fade" id="recommend_game_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Recommend Game: </h4>
			</div>
			<div class="modal-body">
				<div class="container" style="width:90%">
					<?php 
					$members = $db->query("SELECT * FROM Normal_Members NM INNER JOIN Members M ON NM.id = M.id WHERE NM.id <> {$_SESSION['id']}
						AND NM.id NOT IN
						(
							SELECT m2_id FROM normalmember_recommendsgameto_normalmember WHERE m1_id = {$_SESSION['id']}	
							)
					");
					while($member = $members->fetch_object()){
						?>
						<div class="recommend_to_member">
							<div class="recommend_to_member_pp">
								<a href="user.php?id=<?= $member->id ?>"><img width="60px" src="<?= empty($member->profile_picture)?'art/profile_default.jpg':$member->profile_picture ?>"></a>
							</div>
							<div class="recommend_to_member_info">
								<h4><a href="user.php?id=<?= $member->id ?>"><?= $member->f_name.' '.$member->l_name ?></a></h4>
								<?= $member->email ?>

							</div>
							<a  style="cursor:pointer; margin-top:30px; font-size:12px; width:100px; height:30px;" class="recommend_game_button btn btn-success pull-right">Recommend</a>
							<input type="hidden" value="<?= $member->id ?>">
						</div>

						<?php 
					}

					?>
				</div>
			</div>
			

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				
			</div>

		</div>
	</div>
</div>

<style>
.recommend_to_member_pp{
	display: inline-block;
	margin-right: 10px; 
	vertical-align: top;
}

.recommend_to_member_info{
	display: inline-block;
	//background-color: red;
	vertical-align: top;
}

.recommend_to_member{
	padding: 10px;
	background-color: #F7F7F7;
	width: 100%;
	margin-top: 15px;
	border-radius: 15px;
	border: 2px solid #F1F1F1;
}
</style>

<script>
$('.recommend_game_button').click(function(){
	var id = $(this).parent().find('input[type=hidden]').val();
	var g_id = <?= $_GET['id'] ?>;
	var this_button = $(this);
	$.ajax({
		url: 'game/recommend_game_backend.php',
		data: {id:id, g_id:g_id},
		success: function(data){
			$(this_button).html('Recommended');
			$(this_button).attr('disabled','true');
			$(this_button).css('width','120px');
		},


	});
});

</script>