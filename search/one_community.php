
<div class="member_preview media">
  <div class="media-body">
    <h4 class="media-heading"><a href="#"><?= $community->c_name ?></a></h4>
    <?= $community->description;?>
    <br>
    <small>Created by: <?= $db->query("SELECT CONCAT(f_name,' ',l_name) AS name FROM Normal_Members WHERE id={$community->m_id}")->fetch_object()->name; ?></small>
  </div>
</div>
