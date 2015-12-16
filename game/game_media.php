<?php

$media=array();
if($game_media ->num_rows){
		while($row1=$game_media->fetch_object()){
			$media[]=$row1;

		}
		$game_media->free();
	}
	?>
	<!DOCTYPE html>
<body>
	<?php
				foreach ($media as $r1) {
					
					?>
					<img src= <?php  echo $r1->m_path; ?> />
					<?php
				}
				?>

</body>
</html>
