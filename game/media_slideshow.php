
<div style=" height:100%"id="media_carousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <?php
    for($i=0; $i<ceil($game_media->num_rows/2.0); $i++){
      ?>
      <li data-target="#media_carousel" data-slide-to="<?= $i ?>" class="<?= $i==0?'active':''?>"></li>
      <?php
    }
    ?>
  </ol>

  <!-- Wrapper for slides -->
  <div  class="carousel-inner" role="listbox">
    <?php
    $i=0;
    while($media = $game_media->fetch_object()){
      ?>
      <div style="text-align:center;" class="item <?= $i==0?'active':''?>">

        <?php if(strpos($media->m_path,'pictures')){ ?>
        <img class="center-block"style="height:100%;display:inline-block"src="art/<?= $media->m_path ?>" alt="...">
        <?php
      }
      else{
        ?>

        <!-- insert video -->
        <!-- Check if youtube or from server -->
      
        <video style="height:100%;margin-left:20px;display:inline-block;vertical-align:top"controls>
          <source  src="art/<?= $media->m_path ?>" type="video/mp4">
            Your browser does not support the video type.
          </video>
        
          <?php
        }
        if($media = $game_media->fetch_object()){
          ?>
          <?php if(strpos($media->m_path,'pictures')){ ?>
          <img class="center-block"style="height:100%;margin-left:20px;display:inline-block;vertical-align:top"src="art/<?= $media->m_path ?>" alt="...">
          <?php
        }
        else{
          ?>
          <!-- insert video -->


          
            
          <video style="height:100%;margin-left:20px;display:inline-block;vertical-align:top" controls>
            <source  src="art/<?= $media->m_path ?>" type="video/mp4">
              Your browser does not support the video type.
            </video>
           
            <?php
          }
        } 
        ?>


      </div>

      <?php
      $i++;
    }
    ?>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#media_carousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#media_carousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>