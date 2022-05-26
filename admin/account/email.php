<?php 
  ob_start();
  session_start();
  if(isset($_SESSION["MANAGERTOKENID"])){
    $page_title = "Change Your Email Address";
    // $js_file = "";
    $sub_folder_directory = true; // should come before init file
    include "../init.php";
    $manager_logged_email = $logged_manager_data["Email"];
    $manager_loggeed_permissions = $logged_manager_data["Privileges"];
    include $template . "header.php";
    include_once $template . "pageheader.php";
    include_once $static . "Validator.php";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      if(isset($_POST["submit"])){
        $email = $_POST["email"];
        $re_email = $_POST["reemail"];
        if(preg_match("/\w+@\w+.(com|net|org|edu)/", $email)){
          if($email == $re_email){
            $update_email = $logged_manager->update_key_value("Email", $email, $logged_manager_token);
            setcookie("EMAILUPDATED", "Your email has been successfully changed.", strtotime("+ 5 seconds"));
            redirect_within($_SERVER["PHP_SELF"]);
          }
          else{
            setcookie("EMAILDOESNOTMATCH", "Your email does not match. Please try again.", strtotime("+ 5 seconds"));
            redirect_within($_SERVER["PHP_SELF"]);
          }
        }
        else{
          setcookie("EMAILISNOTVALID", "Email is not valid. Please try again.", strtotime("+ 5 seconds"));
          redirect_within($_SERVER["PHP_SELF"]);
        }
      }
    }
    
    ?>
      <div class="settings">
        <?php
          $previous_page = "../personalinfo.php";
          $content_title = "Change Your Email Address";
          include_once $template . "contentheader.php";
        ?>
        <div class="setting">
          <?php 
            if(isset($_COOKIE["EMAILUPDATED"])){
              ?>
                <div class="added-the-manager">
                  <div class="icon">
                    <i class="fas fa-thumbs-up"></i>
                  </div>
                  <h3><?php echo $_COOKIE["EMAILUPDATED"] ?></h3>
                  <div class="close">
                    <i class="fas fa-times-circle"></i>
                  </div>
                </div>
              <?php
            }
          ?>
          <div class="change-name">
            <?php 
              if($manager_loggeed_permissions == 0):
                ?>
                  <div class="permissions ro">
                    <div class="permisiion-icon"><i class="fab fa-readme"></i></div>
                    <div class="permisiion-text">
                      <span>Read Only.</span>
                      <form action="" method="POST">
                        <input type="submit" value="Request Read Write Permissions" name="">
                      </form>
                    </div>
                  </div>
                <?php
              else:
                if($manager_loggeed_permissions == 1):
                  ?>
                    <div class="permissions rw">
                      <div class="permisiion-icon"><i class="fas fa-pen"></i></div>
                      <div class="permisiion-text">
                        <span>Read Write.</span>
                      </div>
                    </div>
                  <?php
                else:
                  ?>
                    <div class="permissions na">
                      <div class="permisiion-icon"><i class="fas fa-globe-africa"></i></div>
                      <div class="permisiion-text">
                        <span>Read, but needs approval for write permissions.</span>
                        <form action="" method="POST">
                          <input type="submit" value="Request Read Write Permissions" name="">
                        </form>
                      </div>
                    </div>
                  <?php
                endif;
              endif;
            ?>
            <div class="notice">
              <div class="icon"><i class="fas fa-bell"></i></div>
              <div class="text">
                <h3>Change your contact information</h3>
                <h4>Please make sure your email is correct and exist, so that others can reach you easily. <a href="../inputprivacy.php#emailPrivacy">Learn more about what domains are acceptable.</a></h4>
              </div>
            </div>
            <h2 class="form-title">Email Address</h2>
            <?php 
              if(isset($_COOKIE["EMAILDOESNOTMATCH"])){
                ?>
                  <div class="name-error">
                    <div class="icon"><i class="fas fa-exclamation-triangle"></i></div>
                    <div class="text">
                      <span><?php echo $_COOKIE["EMAILDOESNOTMATCH"] ?></span>
                    </div>
                  </div>
                <?php
              }
              if(isset($_COOKIE["EMAILISNOTVALID"])){
                ?>
                  <div class="name-error">
                    <div class="icon"><i class="fas fa-exclamation-triangle"></i></div>
                    <div class="text">
                      <span><?php echo $_COOKIE["EMAILISNOTVALID"] ?></span>
                    </div>
                  </div>
                <?php
              }
            ?>
            <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
              <div class="input">
                <label for="">Email Address</label>
                <input type="text" value="<?php echo $manager_logged_email ?>" name="email" autocomplete="off">
              </div>
              <div class="input">
                <label for="">Re-enter your Email Address</label>
                <input type="text" value="<?php echo $manager_logged_email ?>" name="reemail" autocomplete="off">
              </div>
                <div class="input">
                  <input type="submit" value="Save Changes" name="submit">
                  <a href="../personalinfo.php" class="cancel">Cancel</a>
                </div>
            </form>
          </div>
        </div>
      </div>
    <?php
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