<?php
$topic = $crud->Select('Forum_Topic', 'ID', $_SESSION['topicid']);
$countans = $crud->SelectCountWhere('Forum_Answers', 'Forum_Topic_ID', $_SESSION['topicid']);
$author = $crud->Select('Profiles', 'SteamID64', $topic->Author_ID);
 ?>
<div class="container">
  <script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
<div class="row">
    <div class="col-lg-12 white-bg rounded content">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="ibox-content m-b-sm border-bottom">
                <div class="p-xs">
                    <div class="pull-left m-r-md">
                        <img class="text-navy mid-icon" src="gfx/logo.avif"></img>
                    </div>
                    <h2>PFULifeRP Forum</h2>
                    <span></span>
                </div>
            </div>

            <div class="ibox-content forum-container border-bottom">
              <div id="fcat">
                <div class="forum-title">
                  <h3><?php echo ucfirst($topic->Topic_Name); ?></h3>
                </div>
                <div class="forum-sub-title">
                  <p>
                    startet af: <img class="nav-avatar" height="40px" width="40px" src="<?php echo $author->SteamAvatarMedium; ?>" alt="profil picture"/> <i><?php echo $author->Displayname ?></i>
                  </p>
                </div>
                <?php
                $topic = $crud->SelectAll('Forum_Topic', 'ID', $_SESSION['topicid']);
                while($row = $topic->fetch_object()){
                ?>
                    <div class="forum-item active">
                        <div class="row">
                            <div class="col-md-12">
                              <div>
                                <p>
                                  <?php echo ucfirst($row->Topic_Text); ?>
                                </p>
                              </div>
                            </div>
                        </div>
                    </div>
                    <?php
                  }
                  ?>
                    <div>
                      <h5 class="text-muted">Kommentarer:</h5>
                      <?php
                      $answer = $crud->SelectAll('Forum_Answers', 'Forum_Topic_ID', $_SESSION['topicid']);
                      while($row = $answer->fetch_object()){
                        $ansauthor = $crud->Select('Profiles', 'SteamID64', $row->Author_ID);
                      ?>
                      <div class="row">
                        <div class="col-md-12">
                          <div>
                            <p>
                              <?php echo ucfirst($row->Topic_Answers_Text); ?>
                            </p>
                            <p><img class="nav-avatar" height="40px" width="40px" src="<?php echo $author->SteamAvatarMedium; ?>" alt="profil picture"/> <i><?php echo $author->Displayname ?></i></p>
                          </div>
                        </div>
                      </div>
                      <hr class="fspacer" />
                      <?php
                       }
                      ?>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div>
                          <form onsubmit="return false">
                            <textarea name="answer"></textarea>
                            <br />
                            <input class="btn btn-pfu float-right" type="submit" name="submit" value="Opret Kommentar"/>
                          </form>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
  window.onload = function() {
    CKEDITOR.replace( 'answer' );
  };
</script>
