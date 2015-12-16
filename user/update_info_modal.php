<!-- Modal -->
<?php if(isset($_SESSION['id']) && $_SESSION['id'] == $id){ 
  if($account_type == 0 || $account_type == 1)
    $name = $f_name.' '.$l_name;
  else
    $name = $team_name;

  ?>

  <div class="modal fade" id="update_info_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Update my info: </h4>
        </div>
        <form id="update_info_form" class="center-block form-horizontal" method="post" action="">
        <div class="modal-body">
          
            <div class="form-group">
              <label for="inputGenre" class="col-sm-3 control-label">Genre:</label>
              <div class="col-sm-7">
                <input type="text" name="update_genre" class="form-control" id="inputGenre" placeholder="Genre" value="<?= $genre ?>">
              </div>
            </div>
            <?php if($account_type == 0){ ?>
            <!-- Update normal member -->
            <div class="form-group">
              <label for="normal_firstName" class="col-sm-3 control-label">First Name:</label>
              <div class="col-sm-7">
                <input type="text" name="update_normal_firstName" class="form-control" id="normal_firstName" value="<?= $f_name ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="normal_lastName" class="col-sm-3 control-label">Last Name:</label>
              <div class="col-sm-7">
                <input type="text" name="update_normal_lastName" class="form-control" id="normal_lastName" value="<?= $l_name ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="normal_dob" class="col-sm-3 control-label">Date of Birth</label>
              <div class="col-sm-7">
                <input type="date" name="update_normal_dob" class="form-control" id="normal_dob" value="<?= date("Y-m-d",strtotime($d_o_b)) ?>">
              </div>
            </div>
            <?php } else if($account_type == 1){ ?>
            <!-- Update vf -->
            <div class="form-group">
              <label for="vf_firstName" class="col-sm-3 control-label">First Name:</label>
              <div class="col-sm-7">
                <input type="text" name="update_vf_firstName" class="form-control" id="vf_firstName" value="<?= $f_name ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="vf_lastName" class="col-sm-3 control-label">Last Name:</label>
              <div class="col-sm-7">
                <input type="text" name="update_vf_lastName" class="form-control" id="vf_lastName" value="<?= $l_name ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="vf_years" class="col-sm-3 control-label">Experience:</label>
              <div class="col-sm-7">
                <input type="number" name="update_vf_years" class="form-control" id="vf_years" value="<?= $years ?>">
              </div>
            </div>

            <?php } else{ ?>
            <!-- Update dev team -->
            <div class="form-group">
              <label for="team_name" class="col-sm-3 control-label">Team Name:</label>
              <div class="col-sm-7">
                <input type="text" name="update_team_name" class="form-control" id="team_name" value="<?= $team_name ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="team_company" class="col-sm-3 control-label">Company Name:</label>
              <div class="col-sm-7">
                <input type="text" name="update_team_company" class="form-control" id="team_company" value="<?= $company ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="team_foundation" class="col-sm-3 control-label">Foundation Date:</label>
              <div class="col-sm-7">
                <input type="date" name="update_team_foundation" class="form-control" id="team_foundation" value="<?= date("Y-m-d",strtotime($team_foundation)) ?>">
              </div>
            </div>
            <?php }?>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="submit" name="update_info" class="btn btn-primary" value="Save changes">
        </div>
        </form>
      </div>
    </div>
  </div>
  <?php } 
  require_once('update_info_backend.php');

  ?>