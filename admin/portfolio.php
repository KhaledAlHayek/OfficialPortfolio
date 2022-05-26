<?php 
  ob_start();
  session_start();
  if(isset($_SESSION["MANAGERTOKENID"])){
    $page_title = "Manage Managers";
    $header_title = "Managers";
    $content_title = "Portfolio";
    include_once "init.php";
    include_once $template . "header.php";
    include_once $template . "pageheader.php";
    ?>
      <div class="settings">
        <?php $previous_page = "settings.php" ?>
        <?php include_once $template . "contentheader.php" ?>
        <div class="setting">
          <a href="./experience/experience.php" class="box">
            <div class="icon"><i class="fas fa-map"></i></div>
            <div class="text">
              <h3>Experience</h3>
              <p>Manage <strong>Khaled Ali Hayek</strong> portfolio experience</p>
            </div>
          </a>
        </div>
      </div>
    <?php
    include_once $template . "footer.php";
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
?>