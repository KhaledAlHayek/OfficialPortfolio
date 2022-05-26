<?php 
  ob_start();
  session_start();
  if(isset($_SESSION["MANAGERTOKENID"])){
    $page_title = "";
    // $js_file = "";
    include "init.php";
    include $template . "header.php";
    include_once $static . "Experience.php";
    include_once $static . "ExperienceRequest.php";
    $id = $logged_manager_data["ID"];
    $req = new ExperienceRequest($connect, $id);
    $data = ["type", "name", "place", "modified", "status"];
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