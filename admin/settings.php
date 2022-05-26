<?php 
  ob_start();
  session_start();
  if(isset($_SESSION["MANAGERTOKENID"])){
    $page_title = "Admin Settings";
    $header_title = "Settings";
    $content_title = "Settings";
    $js_file = "settings-min.js";
    include_once "init.php";
    include_once $template . "header.php";
    include_once $template . "pageheader.php";
    ?>
    <div class="settings">
      <?php $previous_page = "index.php" ?>
      <?php include_once $template . "contentheader.php"; ?>
      <div class="setting">
        <a href="managers.php" class="box">
          <div class="icon"><i class="fas fa-cog"></i></div>
          <div class="text">
            <h3>Managers</h3>
            <p>Add, edit, and remove managers with specfiying priviliges for each of them.</p>
          </div>
        </a>
        <a href="portfolio.php" class="box">
          <div class="icon"><i class="fas fa-info-circle"></i></div>
          <div class="text">
            <h3>Portfolio</h3>
            <p>Manage <strong>Khaled Ali Hayek</strong> portfolio information, such as Khaled's experience, skills and education.</p>
          </div>
        </a>
        <a href="personalinfo.php" class="box">
          <div class="icon"><i class="fas fa-user-circle"></i></div>
          <div class="text">
            <h3>Personal and account information</h3>
            <p>Contains information about your name and contact info.</p>
          </div>
        </a>
        <a href="account/security.php" class="box">
          <div class="icon"><i class="fas fa-shield-alt"></i></div>
          <div class="text">
            <h3>Password and security</h3>
            <p>Update your info to keep your account secure.</p>
          </div>
        </a>
        <a href="shortcuts/shortcuts.php" class="box">
          <div class="icon"><i class="fas fa-thumbtack"></i></div>
          <div class="text">
            <h3>Shortcuts</h3>
            <p>Easily navigate to pages in the site by adding shortcuts for them.</p>
          </div>
        </a>
        <a href="manageshortcuts.php" class="box">
          <div class="icon"><i class="fas fa-share"></i></div>
          <div class="text">
            <h3>Page Allias</h3>
            <p>Create a shortcut for a page so that managers can add use this allias for easy navigation between pages.</p>
          </div>
        </a>
        <a href="inputprivacy.php" class="box">
          <div class="icon"><i class="fas fa-hand-point-right"></i></div>
          <div class="text">
            <h3>Filling input privacy</h3>
            <p>Read our privacy for how you should write when you are asked for a specific field, such as Fullname, Password and etc...</p>
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
