<?php 
  ob_start();
  session_start();
  if(isset($_SESSION["MANAGERTOKENID"])){
    $page_title = "Change Your Email Address";
    // $js_file = "";
    $sub_folder_directory = true; // should come before init file
    include "../init.php";
    include $template . "header.php";
    $manager_loggeed_permissions = $logged_manager_data["Privileges"];
    if($manager_loggeed_permissions != 1){
      include_once $template . "pageheader.php";
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        // TODO send request to manager to approve current manager permissions request
      }
      ?>
        <div class="settings">
          <?php
            $previous_page = "../personalinfo.php";
            $content_title = "Request permissions changes";
            include_once $template . "contentheader.php";
          ?>
          <div class="setting">
            <div class="change-name">
              <div class="notice">
                <?php 
                  $permissions = "";
                  if($manager_loggeed_permissions == 0):
                    $permissions .= "Read Only";
                    ?>
                      <div class="icon">
                        <i class="fab fa-readme"></i>
                      </div>
                    <?php
                  else:
                    if($manager_loggeed_permissions == 2):
                      $permissions .= "Read, but need approval for write permissions.";
                      ?>
                        <div class="icon">
                          <i class="fas fa-globe-africa"></i>
                        </div>
                      <?php
                    endif;
                  endif;
                ?>
                <div class="text">
                  <h3>Your current Permission over the site is <strong><?php echo $permissions ?></strong></h3>
                  <h4>You can now send a request to the manager to approve your promotion to a manager who has all the full access. Check the notification box in your account to see the result of your request.</h4>
                </div>
              </div>
              <h2 class="form-title">Request read write permissions. </h2>
              <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
                  <div class="input">
                    <input type="submit" value="Send Request" name="submit">
                    <a href="../personalinfo.php" class="cancel">Cancel</a>
                  </div>
              </form>
            </div>
          </div>
        </div>
      <?php
    }
    else{
      ?>
        <div class="settings">
          <?php
            $previous_page = "../personalinfo.php";
            $content_title = "Already have full access";
            include_once $template . "contentheader.php";
          ?>
          <div class="setting">
            <div class="cannot-request">
              <div class="unable-text">
                <i class="fas fa-check-circle"></i>
                <h2>You are already a read write manager.</h2>
                <span>
                You cannot now send a request to enhance your tasks on the site, because you are a manager who has the ability to access everything and modify anything
                </span>
              </div>
            </div>
          </div>
        </div>
      <?php
    }
    include $template . "footer.php";
  }
  else{
    include_once "init.php";
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