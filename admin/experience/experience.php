<?php 
  ob_start();
  session_start();
  if(isset($_SESSION["MANAGERTOKENID"])){
    $page_title = "Experience";
    $allowed_attempts = 2;
    // $js_file = "";
    $sub_folder_directory = true; // should come before init file
    include "../init.php";
    $manager_logged_id   = $logged_manager_data["ID"];
    $manager_permissions = $logged_manager_data["Privileges"];
    $manager_approval    = $logged_manager_data["ApprovalID"];
    include $template . "header.php";
    include_once $template . "pageheader.php";
    include_once $static . "Experience.php";
    include_once $static . "ExperienceRequest.php";
    $exp_request = new ExperienceRequest($connect, $manager_logged_id);
    $total_requests = $exp_request->totalRequests($manager_logged_id);
    if($total_requests >= $allowed_attempts){
      $_SESSION["DISABLEALLEXPFUNCTIONALITY"] = "Cannot add more";
    }
    else{
      unset($_SESSION["DISABLEALLEXPFUNCTIONALITY"]);
    }
    $possible_actions = ["new", "edit", "delete"];
    ?>
      <div class="settings">
        <?php
          if($manager_approval != 1 || $manager_permissions != 1){
            ?>
              <div class="setting">
                <div class="permission-not-applicable">
                  <div class="request-text">
                    <i class="fas fa-exclamation-triangle"></i>
                    <h2>Your request to reach this page is denied.</h2>
                    <span>You cannot view this page because your permissions are not applicable to reach this page.</span>
                    <a href="#">Request Changes</a>
                  </div>
              </div>
            <?php
          }
          else{
            $previous_page = "../portfolio.php";
            $content_title = "Experience";
            include_once $template . "contentheader.php";
            ?>
              <div class="setting">
                <div class="experience">
                  <div class="notice">
                    <div class="icon"><i class="fas fa-bell"></i></div>
                    <div class="text">
                      <h3>Manage <strong>Khaled Ali Hayek</strong> Experience</h3>
                      <h4>Manage information about Khaled's experience. Upon completion of the work, the entered information will be sent to Khaled for approval. You will be notified about the request you have made. <a href="">Learn more</a></h4>
                    </div>
                  </div>
                  <h2 class="form-title">Manage Experience</h2>
                  <div class="manage-exp <?php $class = isset($_SESSION["DISABLEALLEXPFUNCTIONALITY"]) ? "cannot-add-new-exp" : ""; echo $class ?>">
                    <?php 
                      if(!isset($_SESSION["DISABLEALLEXPFUNCTIONALITY"])){
                        ?>
                          <a href="./action.php?a=new" class="exp-box add-link">
                            <i class="fas fa-plus add"></i>
                            <h2>New Experience</h2>
                            <span>Add new experience related to khaled's portfolio.</span>
                          </a>
                        <?php
                      }
                    ?>
                    <a href="./action.php?a=edit" class="exp-box edit-link">
                      <i class="fas fa-edit edit"></i>
                      <h2>Edit Experience</h2>
                      <span>Edit experience related to khaled's portfolio.</span>
                    </a>
                    <a href="./action.php?a=delete" class="exp-box delete-link">
                      <i class="fas fa-times delete"></i>
                      <h2>Delete Experience</h2>
                      <span>Delete experience related to khaled's portfolio.</span>
                    </a>
                  </div>
              </div>
            <?php 
          }
        ?>
      </div>
    <?php
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