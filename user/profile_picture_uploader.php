
<?php 

if (isset($_FILES['profile_picture_file'])){
	if (empty($_FILES['profile_picture_file']['name'])){
		echo '<font color="red">Please choose a file!</font>';
	}
	else
	{
		$allowed = array('jpg','png','jpeg');
		$file_name = $_FILES['profile_picture_file']['name'];
		$file_tmp = $_FILES['profile_picture_file']['tmp_name'];
		$file_extn = explode('.', $file_name);
		$file_extn = end($file_extn);
		$file_extn = strtolower($file_extn);

		if (!in_array($file_extn, $allowed)){
			echo '<font color="red">Only .jpg, .png, .jpeg extenstions are allowed.</font>';
		}
		else if ($_FILES["profile_picture_file"]["size"] > 700000 || $_FILES["profile_picture_file"]["size"]==0){
			echo '<font color="red">Max size limit is 700 KB</font>';
		}
		else{

			$file_path = 'art/profile_pictures/'.substr(md5(time()),0,10).'.'.$file_extn;
			$file_path = resize(400, 400,$file_path);
						//move_uploaded_file($file_tmp, $file_path);
			$result = $db->query("SELECT profile_picture FROM Members WHERE id={$_SESSION['id']} LIMIT 1");
			$result = $result->fetch_object();
			$file_path = 'http://localhost/GameReviews/'.$file_path;
			$old_path = $result->profile_picture;
			$old_path = substr($old_path, 29);
			unlink($old_path);
			$upd=$db->prepare("UPDATE Members SET profile_picture='{$file_path}' WHERE id={$_SESSION['id']}");
			$upd->execute();
			?>
			<script>
			window.location.assign("user.php?id=<?php echo $_SESSION['id']; ?>");
			</script>
			<?php
						//header('Location: user.php?user_id='.$_SESSION['id']);
		}

	}
} 


function resize($width, $height, $file_path){
	/* Get original image x y*/
	list($w, $h) = getimagesize($_FILES['profile_picture_file']['tmp_name']);
	/* calculate new image size with ratio */
	$ratio = max($width/$w, $height/$h);
	$h = ceil($height / $ratio);
	$x = ($w - $width / $ratio) / 2;
	$w = ceil($width / $ratio);
	/* new file name */
	$path = $file_path;
	/* read binary data from image file */
	$imgString = file_get_contents($_FILES['profile_picture_file']['tmp_name']);
	/* create image from string */
	$image = imagecreatefromstring($imgString);
	$tmp = imagecreatetruecolor($width, $height);
	imagecopyresampled($tmp, $image,
		0, 0,
		$x, 0,
		$width, $height,
		$w, $h);
	/* Save image */
	switch ($_FILES['profile_picture_file']['type']) {
		case 'image/jpeg': 
		imagejpeg($tmp, $path, 100);
		break;
		case 'image/png':
		imagepng($tmp, $path, 0);
		break;
		case 'image/gif':
		imagegif($tmp, $path);
		break;
		default:
		exit;
		break;
	}
	return $path;
	/* cleanup memory */
	imagedestroy($image);
	imagedestroy($tmp);
}

?>