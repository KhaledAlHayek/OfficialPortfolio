<?php 
  ob_start();
  session_start();
  $page_title = "Admin Login - Khaled Ali Hayek Portfolio";
  $js_file = "adminlogin-min.js";
  include_once "init.php";
  include_once $template . "header.php";
  $restriction_time = " + 1 minutes";
  $limit = 4;
  include_once $static . "Validator.php";
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["submit"])){
      $validation = new Validator($_POST, ["email", "password"]);
      $errors = $validation->validata_form();
      // if no error occured while submittin the form, check the db for user existance
      $save_data = isset($_POST["save"]) ? true : false;
      if(empty($errors)){
        $email = $_POST["email"];
        $manager = new Manager($connect);
        $login = $manager->login("Email", $email);
        if($login != 0): // manager found in our db
          if($save_data): // save data for another login
            $_SESSION["MANAGEREMAIL"] = $_POST["email"];
            $_SESSION["MANAGERPASSWORD"] = $_POST["password"];
          else:
            unset($_SESSION["MANAGEREMAIL"]);
            unset($_SESSION["MANAGERPASSWORD"]);
          endif;
          $_SESSION["MANAGERTOKENID"] = $login;
          setcookie("LOGINSUCCEEDED", "Login Successfull", strtotime("+ 10 seconds"));
          redirect_within($_SERVER["PHP_SELF"]);
        else: // manager not found in our db
          // print form errors to user screen
          setcookie("DATAINVALID", "Data is invalid! You only have limited attempts to try loging in again.", strtotime("+ 5 seconds"));
          $date = $_POST["date"];
          // set counter for every submit for the form
          if(!isset($_SESSION["TOTALATTEMPTS"])){
            $_SESSION["TOTALATTEMPTS"] = 1;
          }
          else{
            // if total submission does not exceed our limit, increase total by one
            if($_SESSION["TOTALATTEMPTS"] < $limit){
              $count = $_SESSION["TOTALATTEMPTS"] + 1;
              $_SESSION["TOTALATTEMPTS"] = $count;
            }
            if($_SESSION["TOTALATTEMPTS"] == 1){
              // 2 attempts left
            }
            else if($_SESSION["TOTALATTEMPTS"] == 2){
              // 1 attempts left
            }
            else if($_SESSION["TOTALATTEMPTS"] == 3){
              // 0 attempts left
              setcookie("DISABLEFUNCTIONALITY", "no attempts left", strtotime($restriction_time));
              $suspend_to = date("j-n-Y h:i:s", strtotime($date . $restriction_time));
              $_SESSION["RESTRICTIONTIME"] = $suspend_to;
            }
          }
          // redirect_within($_SERVER["PHP_SELF"]);
        endif;
      }
    }
  }
  // remove restriction on account after time expired
  if(isset($_SESSION["RESTRICTIONTIME"])){
    $restriction = date("d-m-y h:i:s", strtotime($_SESSION["RESTRICTIONTIME"] . " + 1 hour"));
    $now = date("d-m-y h:i:s", strtotime("+ 1 hour"));
    if($now > $restriction){
      // $_SESSION["TOTALATTEMPTS"] = 1;
      unset($_SESSION["TOTALATTEMPTS"]);
      unset($_SESSION["RESTRICTIONTIME"]);
      redirect_within($_SERVER["PHP_SELF"]);
    }
  }
  // show login page if there is no restriction
  if(!isset($_COOKIE["DISABLEFUNCTIONALITY"])){
    // if error occured
    if(isset($_COOKIE["DATAINVALID"])){
      ?>
        <div class="login-error-msg">
          <div class="error-holder">
            <span><?php echo $_COOKIE["DATAINVALID"] ?></span>
          </div>
        </div>
      <?php
    }
    if(isset($_COOKIE["LOGINSUCCEEDED"])){
      $random = rand(2, 5);
      ?>
        <div class="info-container success fixed-box">
          <div class="holder">
            <div class="icon">
              <i class="fas fa-thumbs-up"></i>
            </div>
            <div class="msg">
              <h1>You are logged in successfully.</h1>
              <span>Redirecting...</span>
              <div class="redirecting">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
              </div>
            </div>
            <div class="options">
              <?php 
                // TODO redirect to portfolio page, when page UI is created
              ?>
              <a href="#">Cancel</a>
            </div>
          </div>
        </div>
      <?php
      redirect_within("./index.php", $random);
    }
    ?>
      <div class="admin-login">
        <div class="login">
          <div class="login-holder">
            <div class="title">
              <div class="attempts-info">
                <h1>Admin? Login in now</h1>
                <div class="info-icon">
                  <div class="attempts-tooltip">
                    <span>you only have 3 attempts to login.</span>
                  </div>
                  <i class="fas fa-exclamation-circle"></i>
                </div>
              </div>
              <span>A customized dashboard to manage <strong>Khaled Ali Hayek</strong> Portfolio</span>
              <div class="visitor">
                <h3>Login Credentials</h3>
                <div>
                  <span><strong>Email:</strong> visitor@gamil.com</span>
                </div>
                <div>
                  <span><strong>Password:</strong> visitor123@</span>
                </div>
              </div>
            </div>
            <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST" id="main-form">
              <div class="input">
                <input 
                  type="text" 
                  class="has-placeholder email" 
                  name="email" 
                  value="<?php 
                    $remembered_email = isset($_SESSION["MANAGEREMAIL"]) ? $_SESSION["MANAGEREMAIL"] : "";
                    echo $remembered_email;
                  ?>"
                  autocomplete="off" 
                  required>
                <span class="placeholder">Email</span>
              </div>
              <div class="input">
                <input 
                  type="password" 
                  class="has-placeholder password" 
                  name="password"
                  value="<?php 
                    $remembered_pass = isset($_SESSION["MANAGERPASSWORD"]) ? $_SESSION["MANAGERPASSWORD"] : "";
                    echo $remembered_pass;
                  ?>"
                  autocomplete="off" 
                  required>
                <span class="placeholder">Password</span>
                <i class="fas fa-eye show-hide"></i>
              </div>
              <div class="input save-info">
                <input 
                  type="checkbox" 
                  id="save" 
                  name="save"
                  <?php 
                    $checked = isset($_SESSION["MANAGEREMAIL"]) ? "checked" : "";
                    echo $checked;
                  ?>
                  value="1">
                <label for="save" data-default="Save login information.">
                <?php 
                  $label = isset($_SESSION["MANAGEREMAIL"]) ? "Saved" : "Save login information.";
                  echo $label;
                ?>
                </label>
              </div>
              <div class="input">
                <input type="hidden" value="<?php echo date("j-n-Y h:i:s") ?>" name="date">
                <input type="submit" value="Login" name="submit" class="submit">
              </div>
            </form>
          </div>
        </div>
        <div class="image">
          <img src="<?php echo $imgs . "login.jpg" ?>" alt="Login Picture">
        </div>
      </div>
    <?php
    include $template . "footer.php";
  }
  else{
    ?>
    <div class="info-container">
      <div class="holder">
        <div class="icon">
          <i class="fas fa-exclamation-triangle"></i>
        </div>
        <div class="msg">
          <h1>Restriction occured on your account</h1>
          <span>
            There is a limitation on your account. You have tried to log in more than three times and all your attempts have been unsuccessful. You can come back in <?php echo "<strong>" . $restriction_time . "</strong>" ?> to try again. Thank you
          </span>
        </div>
        <div class="options">
          <a href="#">Back to main page</a>
        </div>
      </div>
    </div>
    <?php
  }
  ob_end_flush();
?>
