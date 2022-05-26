<?php 
  ob_start();
  session_start();
  if(isset($_SESSION["MANAGERTOKENID"])){
    $page_title = "Change Your Password";
    $js_file = "changepassword-min.js";
    $sub_folder_directory = true; // should come before init file
    include "../init.php";
    $manager_logged_password = $logged_manager_data["Password"];
    include $template . "header.php";
    include_once $template . "pageheader.php";
    include_once $static . "Validator.php";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      if(isset($_POST["submit"])){
        $pass = $_POST["password"];
        $re_pass = $_POST["repassword"];
        if(preg_match("/[a-zA-Z]{6,}\d+\W+/", $pass)){
          if($pass != $re_pass){
            setcookie("PASSDOESNOTMATCH", "Your Password did not match. Please try again.", strtotime("+ 5 seconds"));
            redirect_within($_SERVER["PHP_SELF"]);
          }
          else{
            $update_password = $logged_manager->update_key_value("Password", $pass, $logged_manager_token);
            if($update_password):
              setcookie("PASSWORDUPDATED", "Your Password has been updated.", strtotime("+ 5 seconds"));
              redirect_within($_SERVER["PHP_SELF"]);
            endif;
          }
        }
        else{
          setcookie("PASSISNOTVALID", "Password is not valid. Please try again.", strtotime("+ 5 seconds"));
          redirect_within($_SERVER["PHP_SELF"]);
        }
      }
    }
    ?>
      <div class="settings">
        <?php
          $previous_page = "../settings.php";
          $content_title = "Change Your Password";
          include_once $template . "contentheader.php";
        ?>
        <div class="setting">
          <?php 
            if(isset($_COOKIE["PASSWORDUPDATED"])){
              ?>
                <div class="added-the-manager">
                  <div class="icon">
                    <i class="fas fa-thumbs-up"></i>
                  </div>
                  <h3><?php echo $_COOKIE["PASSWORDUPDATED"] ?></h3>
                  <div class="close">
                    <i class="fas fa-times-circle"></i>
                  </div>
                </div>
              <?php
            }
          ?>
          <div class="change-name">
            <div class="notice">
              <div class="icon"><i class="fas fa-bell"></i></div>
              <div class="text">
                <h3>Change your security information</h3>
                <h4>To stay safe, please choose a complex password consisting of numbers, uppercase and lowercase letters, and signs. <a href="../inputprivacy.php#passwordPrivacy">Learn more about how you should write your password</a></h4>
              </div>
            </div>
            <h2 class="form-title">Password</h2>
            <?php 
              if(isset($_COOKIE["PASSDOESNOTMATCH"])){
                ?>
                  <div class="name-error">
                    <div class="icon"><i class="fas fa-exclamation-triangle"></i></div>
                    <div class="text">
                      <span><?php echo $_COOKIE["PASSDOESNOTMATCH"] ?></span>
                    </div>
                  </div>
                <?php
              }
              if(isset($_COOKIE["PASSISNOTVALID"])){
                ?>
                  <div class="name-error">
                    <div class="icon"><i class="fas fa-exclamation-triangle"></i></div>
                    <div class="text">
                      <span><?php echo $_COOKIE["PASSISNOTVALID"] ?></span>
                    </div>
                  </div>
                <?php
              }
            ?>
            <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
              <div class="input password-field">
                <label for="">Password</label>
                <input type="password" value="<?php echo $manager_logged_password ?>" name="password" autocomplete="off">
              </div>
              <div class="input password-field">
                <label for="">Re-enter Password</label>
                <input type="password" value="<?php echo $manager_logged_password ?>" name="repassword" autocomplete="off">
              </div>
              <div class="show-password">
                <label for="show-pass">Show Password</label>
                <input type="checkbox" id="show-pass" class="show-security-pass" autocomplete="off">
              </div>
              <div class="input">
                <input type="submit" value="Save Changes" name="submit">
                <a href="../settings.php" class="cancel">Cancel</a>
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