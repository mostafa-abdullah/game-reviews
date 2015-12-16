<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="http://localhost/GameReviews/index.php">Game Reviews</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="http://localhost/GameReviews/index.php">Home </a></li>
        <li><a href="#">About</a></li>
       <!--  <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li> -->
      </ul>
      <form method="get" action="http://localhost/GameReviews/searchResults.php" class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input id="search_bar"  name="key" type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" id="search_button" class="btn btn-default">Search</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">How it works</a></li>
        <?php if(isset($_SESSION['id']) && $_SESSION['account_type'] == 0){ 
          $newMessages = $db->query("SELECT * FROM NormalMember_SendMessage_NormalMember WHERE m2_id={$_SESSION['id']} AND (is_read=FALSE OR is_read IS NULL) AND m1_id IN (
            SELECT m1_id FROM Normalmember_AddFriend_NormalMember WHERE m2_id = {$_SESSION['id']} AND is_accepted=true
            UNION
            SELECT m2_id FROM Normalmember_AddFriend_NormalMember WHERE m1_id = {$_SESSION['id']} AND is_accepted=TRUE
            )");
          ?>
        <li><a href="http://localhost/GameReviews/messanger.php">Messages <?php if($newMessages->num_rows){ ?> <span class="label label-danger"><?= $newMessages->num_rows ?></span>  <?php } ?></a></li>

        <?php } ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo isset($_SESSION['id'])?'Hello '.$_SESSION['email']:'Register/Login' ?><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php 
              if(!isset($_SESSION['id'])){
            ?>
            <li><a href="http://localhost/GameReviews/auth/login.php">Login</a></li>
            <li><a href="http://localhost/GameReviews/auth/register.php">Register</a></li>
            <?php 
          }
          else {
            ?>
            <li><a href="http://localhost/GameReviews/user.php?id=<?= $_SESSION['id'] ?>">Profile</a></li>
            <li><a href="http://localhost/GameReviews/auth/logout.php">Logout</a></li>
            

            <?php
}
            ?>
           <!--  <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li> -->
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<script>
$(document).ready(function(){
  $('#search_button').attr('disabled',true);
});
  $('#search_bar').mouseenter(function(){
    $(this).stop().animate({
      width:'300px'
    });
  });
  $('#search_bar').mouseleave(function(){
    if(!($(this).is(':focus'))){
    $(this).stop().animate({
      width:'200px'
    });
  }
  });
 $('#search_bar').keyup(function(){
    if($(this).val().trim().length !=0)
      $('#search_button').attr('disabled', false);            
    else
      $('#search_button').attr('disabled',true);
 });
</script>
<style>
body{
  margin-top: 80px;
}

</style>
