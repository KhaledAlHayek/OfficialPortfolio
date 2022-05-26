<?php 
  ob_start();
  session_start();
  if(isset($_SESSION["MANAGERTOKENID"])){
    $page_title = "Change Your Email Address";
    // $js_file = "";
    $sub_folder_directory = true; // should come before init file
    include "../init.php";
    include $template . "header.php";
    $confirm_deletion = isset($_GET["delete_account"]) ? $_GET["delete_account"] : "";
    ?>
      <div class="settings">
        <?php
          $previous_page = "../personalinfo.php";
          $content_title = "Permenantly delete your account";
          include_once $template . "contentheader.php";
        ?>
        <div class="setting">
          <div class="cannot-request delete-account-permenant">
            <?php 
              if(!empty($confirm_deletion) && $confirm_deletion == "confirm"):
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                  $delete_manager = $logged_manager->DeleteManager($logged_manager_token);
                  if($delete_manager):
                    unset($_SESSION["MANAGERTOKENID"]);
                    unset($_SESSION["MANAGEREMAIL"]);
                    unset($_SESSION["MANAGERPASSWORD"]);
                    redirect_within("../adminlogin.php");
                  endif;
                }
                ?>
                <div class="confirm-permenant-delete">
                  <form action="<?php echo $_SERVER["PHP_SELF"] . "?delete_account=confirm" ?>" method="POST">
                    <input type="submit" value="Delete my account">
                  </form>
                </div>
                <?php
              endif;
            ?>
            <div class="unable-text danger">
              <i class="fas fa-times-circle"></i>
              <h2>Are you sure you want to delete your account.</h2>
              <span>
              You are one step away from permanently deleting your account. When you press the button, you will see a message confirming that you want to delete the account. When you press OK, your account will be permenantly deleted nad you will have access again to your acoount. After that, you will be taken to the main page
              </span>
              <a href="<?php echo $_SERVER["PHP_SELF"] . "?delete_account=confirm"?>">Continue to account deletion</a>
            </div>
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
?>