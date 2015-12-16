<?php require_once('includes/dbConnection.php'); ?>
<?php if(!isset($_GET['id'])){
	die('Invalid path');
} ?>
<html>
<head>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/normalize.css" rel="stylesheet">
	<link href="css/tabs.css" rel="stylesheet">
	<link href="css/tabstyles.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-1.11.3.js"></script>
</head>
<body>
	<?php require_once('includes/nav.php'); ?>
	<div class="container" style="text-align:center;background-color:#F7F7F7; margin-bottom:50px; padding:30px;">

		<?php
		$cr = $db->query("SELECT * FROM Conference_Reviews WHERE cr_id = {$_GET['id']}");
		if(!$cr->num_rows){
			die('Conference_Review not found.');
		}
		$cr = $cr->fetch_object();
		$id = $cr->cr_id;
		$text = $cr->r_text;
		$m_id = $cr->m_id;
		$c_id = $cr->c_id;
		$title = $cr->title;
		$cr_date = $cr->cr_date;
		?>
		<div class="page-header" style="text-align:left">
		  <div class="btn-toolbar">
		<?php 
		 echo '<a onclick="return confirm(\'Are you sure?\');" href="conferences/deleteConferenceReview.php?id='.$id.'" style=""
			 class="pull-right btn btn-success">Delete</a> ';

		?> 

		<h1> <?= $title ?></h1>
		<a href="conference.php?id=<?= $c_id ?>">Back to conference</a>
		</div>
		</div>
		<div id="text_coloumn" class="center-block">
			<div id='review_info' >
			<p class="post-info">
			<i class="icon-author"></i>
			<?php 

				 echo '<a href="user.php?id='.$m_id.'"
					 >Author</a>' ;
			 		?> 
			<i class="icon-cal"></i>
			<time datetime="2010-02-16"><?= date("d, M Y",strtotime($cr_date)) ?></time>
			</p>
			</div>
			<div id='post'>
				<?php 		
				echo $text;
			 		?> 
			</div>


		</div>

			<div id="comment_coloumn" class="center-block">
			<?php 
				 $comments = $db->query("SELECT  * FROM Conference_Review_Comments WHERE  cr_id ='$id'");

			 ?>
			 <?php if(isset($_SESSION['id'])){   ?>

			<form method='post' action=""  style="text-align:left">
 		 	<textarea id="comment" name = "comm" placeholder="Write Your Comment Here....."></textarea>
  				<br>

 			 <input type="submit" name="writecomm" value="Post Comment">
 			 </form>

 			 <?php 
				if(isset($_POST['writecomm'])){
					$comm  = $_POST['comm'];
 				 $addcomm = $db->query("CALL Add_Comment({$_SESSION['id']} ,{$id},'{$comm}','conference')");
				echo '<script>window.location.href = "conferenceReview.php?id='.$id.'"</script>';
				

 			} 
}
 			     while($row = $comments->fetch_assoc())
    		{
    			$com_id = $row["com_id"];
    			 $mem_id = $row["m_id"];
    			$comment = $row["com_text"];
    			  $cr_id = $row["cr_id"];
      	$check1 = $db->query("SELECT * FROM Normal_Members WHERE id = {$mem_id}");
		$check2 = $db->query("SELECT * FROM Verified_Reviewrs WHERE id = '{$mem_id}'");
		$check3 = $db->query("SELECT * FROM Development_Teams WHERE id = '{$mem_id}'");
		if($check1->num_rows){
			$check1 = $check1->fetch_object();
			$f_n 		= $check1->f_name;
			$s_n 		= $check1->l_name ;
			$name = $f_n ." ".$s_n ;
		}
		else if($check2->num_rows){
			$check2 = $check2->fetch_object();
			$f_n 		= $check2->f_name;
			$s_n  		= $check2->l_name ;
			$name = $f_n ." ".$s_n ;

		}
		else if($check3->num_rows){
			$check3 = $check3->fetch_object();
			$name 	= $check3->team_name;
		}

?>
      <div class="comment_div"> 
      <?php  
      		if($_SESSION['id']==$m_id){

		 echo '<a onclick="return confirm(\'Are you sure?\');" href="conferences/deleteComment.php?id='.$com_id.'" style=""
			 class="pull-right btn btn-success">Delete</a> ';
		}
		?>


	  <p class="name">Posted By: <?php echo '<a href="user.php?id='.$mem_id.'" style = "color : white ;">'.$name.'</a>';?></p>
      <p class="comment"><?php echo $comment;?></p>	
	</div>


    <?php
    }
    ?>


			</div>


		</div>



	<?php require_once('includes/footer.php'); ?>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/cbpFWTabs.js"></script>
	<!-- <script type="text/javascript" src="js/modernizr.custom.js"></script> -->
</body>
</html>
<script>
</script>

<style>
#text_coloumn
{
    width: 90%;
    /* Just for looks: */

    background-color:  #F1F1F1;
    border-radius: 50px;
	padding: 30px;
    margin: 25px;
}
#comment_coloumn
{
    width: 90%;
    /* Just for looks: */

    background-color:  #F1F1F1;
    border-radius: 50px;
	padding: 30px;
    margin: 25px;
}


#info_table{
	padding: 20px;
}
#info_table tr td{
	padding: 5px;
}
.tabs-style-linebox a{
	text-decoration: none;
}
#friends_section{
	height: 400px;
	
	margin: 10px;
	overflow: auto;
}

#post {

	text-align: left;

}
#text_coloumn p.post-info {
    color: #6a6a6a;
    font-size: 12px;
    margin-bottom: 16px;
}
#text_coloumn p.post-info i {
    background-image: url("http://cdn.tutorialzine.com/wp-content/themes/tzine/img/sprite.png");
    background-repeat: no-repeat;
    display: inline-block;
    height: 16px;
    vertical-align: text-bottom;
    width: 16px;
}
#text_coloumn p .icon-author {
    background-position: 0 -195px;
}
#text_coloumn p .icon-cal {
    background-position: -33px -195px;
    margin: 0 6px 0 20px;
    }
textarea
{
	width:600px;
	height:100px;
	border:1px solid silver;
	border-radius:5px;
	font-size:17px;
	padding:10px;
	font-family:helvetica;
}
input[type="text"]
{
	width:600px;
	height:35px;
	border:1px solid silver;
	margin-top:10px;
	border-radius:5px;
	font-size:17px;
	padding:10px;
	font-family:helvetica;
}
input[type="submit"]
{
	width:150px;
	height:40px;
	border:none;
	background-color:#2E64FE;
	color:white;
	margin-top:10px;
	border-radius:5px;
	font-size:17px;
}
.comment_div
{
	width:600px;
	background-color:white;
	margin-top:10px;
	border-radius: 9px;
	text-align:left;
}
.comment_div .name
{
	border-radius: 9px;
	height:50px;
	line-height:30px;
	padding:10px;
	background-color:#0066FF;
	color:white;
	text-align:left;
}
.comment_div .comment
{
	padding:10px;
}

</style>