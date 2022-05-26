<?php 
  ob_start();
  session_start();
  if(isset($_SESSION["MANAGERTOKENID"])){
    $page_title = "Change Your Name";
    // $js_file = "";
    $sub_folder_directory = true; // should come before init file
    $restriction_time = "+ 30 days";
    include "../init.php";
    $manager_fullname = $logged_manager_data["Fullname"];
    $fullname_arr = explode(" ", $manager_fullname);
    $first = $fullname_arr[0];
    $middle = $fullname_arr[1];
    $last = $fullname_arr[2];
    include $template . "header.php";
    include_once $template . "pageheader.php";
    include_once $static . "Validator.php";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      if(isset($_POST["submit"])){
        $first_name = $_POST["first"];
        $middle_name = $_POST["middle"];
        $last_name = $_POST["last"];
        $pattern = "/^[a-zA-Z]{3,}$/";
        if(preg_match($pattern, $first_name) && preg_match($pattern, $middle_name) && preg_match($pattern, $last_name)){
          $fullname = $first_name . " " . $middle_name . " " . $last_name;
          // ! variables are declared in the init file.
          $update_fullname = $logged_manager->update_key_value("Fullname", $fullname, $logged_manager_token);
          if($update_fullname):
            $date_when_posted = date("d-m-Y h:i:s", strtotime("+ 1 hour"));
            $restrict_name_changes = date("d-m-Y h:i:s", strtotime("+ 1 hour"));
            $_SESSION["RESTRICTIONNAMETIME"] = $restrict_name_changes;
            $_SESSION["DATEWHENPOSTED"] = $date_when_posted;
            setcookie("NAMECHANGEDSUCCESSFULLY", "Your fullname has been changed successfully.", strtotime("+ 5 seconds"));
            redirect_within($_SERVER["PHP_SELF"]);
          endif;
        }else{
          setcookie("NAMENOTVALID", "The information sent contains errors. Please try again", strtotime("+ 5 seconds"));
          redirect_within($_SERVER["PHP_SELF"]);
        }
      }
    }
    if(isset($_SESSION["RESTRICTIONNAMETIME"])){
      $open_at = date("d-m-Y h:i:s", strtotime($_SESSION["RESTRICTIONNAMETIME"] . $restriction_time));
      $posted_at = $_SESSION["DATEWHENPOSTED"];
      $now = date("d-m-Y h:i:s", strtotime("+ 1 hour"));
      if($now > $open_at){
        // allowed
        setcookie("DISABLENAMECHANGES", "Name changes opened", strtotime("- 1 second"));
      }
      else{
        // denied
        setcookie("DISABLENAMECHANGES", $open_at, strtotime($restriction_time));
      }
    }
    
    ?>
      <div class="settings">
        <?php
          $previous_page = "../personalinfo.php";
          $content_title = "Change Your Name";
          include_once $template . "contentheader.php";
        ?>
        <div class="setting">
          <?php 
            if(isset($_COOKIE["NAMECHANGEDSUCCESSFULLY"])){
              ?>
              <div class="added-the-manager">
                <div class="icon">
                  <i class="fas fa-thumbs-up"></i>
                </div>
                <h3><?php echo $_COOKIE["NAMECHANGEDSUCCESSFULLY"] ?></h3>
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
                <h3>Restriction may occur on your account</h3>
                <h4>Please note: If you change your name now, you can't change it again for 30 days. Make sure your new name is valid, don't add any punctuation, characters or numbers. <a href="../inputprivacy.php#fullnamePrivacy">Learn more</a></h4>
              </div>
            </div>
            <h2 class="form-title">Name</h2>
            <?php 
              if(isset($_COOKIE["NAMENOTVALID"])){
                ?>
                  <div class="name-error">
                    <div class="icon"><i class="fas fa-exclamation-triangle"></i></div>
                    <div class="text">
                      <span><?php echo $_COOKIE["NAMENOTVALID"] ?></span>
                    </div>
                  </div>
                <?php
              }
            ?>
            <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
              <div class="input">
                <label for="">Firstname</label>
                <input type="text" value="<?php echo $first ?>" name="first" autocomplete="off">
              </div>
              <div class="input">
                <label for="">Middle name</label>
                <input type="text" value="<?php echo $middle ?>" name="middle" autocomplete="off">
              </div>
              <div class="input">
                <label for="">Last name</label>
                <input type="text" value="<?php echo $last ?>" name="last" autocomplete="off">
              </div>
              <?php 
                if(isset($_COOKIE["DISABLENAMECHANGES"])){
                  ?>
                    <div class="name-changes-disabled">
                      <i class="fas fa-info-circle"></i>
                      <div class="restriction-text">
                        <span>You are now restricted from changing your name again. When the limitation period expires, you can change the name again</span>
                        <?php 
                          $opens_at = $_COOKIE["DISABLENAMECHANGES"]; 
                          $now = date("d-m-Y h:i:s", strtotime("+ 1 hour"));
                          $restriction_removed_at = new DateTime($opens_at);
                          $time_now = new DateTime($now);
                          $diff = $restriction_removed_at->diff($time_now);
                          $remained_time = $diff->format("%d days, %h hours and %i minutes remained");
                        ?>
                        <span class="remained-time"><?php echo $remained_time ?></span>
                      </div>
                    </div>
                  <?php
                }
                else{
                  ?>
                    <div class="input">
                      <input type="hidden" name="date" value="<?php echo date("d-m-Y h:i:s") ?>">
                      <input type="submit" value="Save Changes" name="submit">
                      <a href="#" class="cancel">Cancel</a>
                    </div>
                  <?php
                }
              ?>
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