<?php 
  ob_start();
  session_start();
  if(isset($_SESSION["MANAGERTOKENID"])){
    if(isset($_COOKIE["PREVIEWEXPERIENCE"])){
      $experince_id = $_COOKIE["PREVIEWEXPERIENCE"];
      $page_title = "Preview Experience";
      $js_file = "previewexp-min.js";
      $sub_folder_directory = true;
      include "../init.php";
      $manager_logged_id = $logged_manager_data["ID"];
      include_once $static . "Experience.php";
      $experience = new Experience($connect, $manager_logged_id);
      $data = $experience->singleExpData($experince_id);
      $exp_data = $data[0];
      $exp_details = $data[1][0];
      $length = strlen($exp_details) - 1;
      $details = explode("%", substr($exp_details, 0, $length));
      $status = $experience->appearenceStatus($experince_id);
      include $template . "header.php";
      ?>
        <div class="settings">
          <?php 
            $previous_page = "./experience.php";
            $content_title = "Preview Experience";
            include_once $template . "contentheader.php";
          ?>
          <div class="setting">
            <div class="experience request-successfullt-sent">
              <div class="notice">
                <div class="icon"><i class="fas fa-bell"></i></div>
                <div class="text">
                  <h3>Preview</h3>
                  <h4>Every time you create a new experience you can preview the information you sent from here.</h4>
                </div>
              </div>
              <?php 
                if($status == 0):
                  ?>
                    <div class="request-sent">
                      <i class="fas fa-check"></i>
                      <div class="text">
                        <span>You have successfully send a request to add the experience. Check you inbox for the request status.</span>
                      </div>
                    </div>
                  <?php
                else:
                  ?>
                  <div class="request-sent">
                    <i class="fas fa-check"></i>
                    <div class="text">
                      <span>Experience has been successfully added to the portfolio.</span>
                    </div>
                  </div>
                  <?php
                endif;
              ?>
              <h2 class="form-title">Experience Preview</h2>
              <div class="preview-exp">
                <div class="preview-data">
                  <div class="head">
                    <h2>Experience Information</h2>
                    <i class="fas fa-chevron-down"></i>
                  </div>
                  <div class="body">
                    <div class="the-exp-data">
                      <h3>Project Type</h3>
                      <span><?php echo $exp_data[1] ?></span>
                    </div>
                    <div class="the-exp-data">
                      <h3>Project Name</h3>
                      <span><?php echo $exp_data[2] ?></span>
                    </div>
                    <div class="the-exp-data">
                      <h3>Project Place</h3>
                      <span><?php echo $exp_data[3] ?></span>
                    </div>
                    <div class="the-exp-data">
                      <h3>Modified</h3>
                      <span>
                        <?php 
                          if($exp_data[4] == 0):
                            echo "No";
                          else:
                            echo "Yes";
                          endif;
                        ?>
                      </span>
                    </div>
                    <div class="the-exp-data">
                      <h3>Finished</h3>
                      <span>
                        <?php 
                          if($exp_data[5] == 0):
                            echo "No";
                          else:
                            echo "Yes";
                          endif;
                        ?>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="preview-data">
                  <div class="head">
                    <h2>Experience Details</h2>
                    <i class="fas fa-chevron-down"></i>
                  </div>
                  <div class="body">
                    <?php 
                      foreach($details as $index=>$detail):
                        ?>
                          <div class="the-exp-data">
                            <h3>Project Detail - <?php echo $index + 1 ?></h3>
                            <span><?php echo $detail ?></span>
                          </div>
                        <?php 
                      endforeach;
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php
      include $template . "footer.php";
    }
    else{
      echo "add experience to view preview.";
    }
  }
  else{
    include_once "../init.php";
    include_once $template . "header.php";
    ?>
      <div class="info-container error">
        <div class="holder">
          <div class="icon">
            <i class="fas fa-exclamation-triangle"></i>
          </div>
          <div class="msg">
            <h1>Access Denied</h1>
            <span>
              Sorry, you do not have access to view content of this page. Please sign in to continue.
            </span>
          </div>
          <div class="options">
            <a href="adminlogin.php">Login</a>
          </div>
        </div>
      </div>
    <?php
  }
  ob_end_flush();