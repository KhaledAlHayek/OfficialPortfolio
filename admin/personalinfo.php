<?php 
  ob_start();
  session_start();
  if(isset($_SESSION["MANAGERTOKENID"])){
    $page_title = "Personal Information";
    // $js_file = "";
    include "init.php";
    include $template . "header.php";
    include_once $template . "pageheader.php";
    ?>
      <div class="settings">
        <?php
          $previous_page = "settings.php";
          $content_title = "Personal and account information";
          include_once $template . "contentheader.php";
        ?>
        <div class="setting">
          <a href="account/name.php" class="box">
            <div class="icon"><i class="fas fa-id-card"></i></div>
            <div class="text">
              <h3>Name</h3>
              <p>Edit your name. Note that you cannot chagne it again for 30 days.</p>
            </div>
          </a>
          <a href="account/email.php" class="box">
            <div class="icon"><i class="fas fa-envelope"></i></div>
            <div class="text">
              <h3>Contact info</h3>
              <p>Manager your email address and see your permissions.</p>
            </div>
          </a>
          <a href="account/priviliges.php" class="box">
            <div class="icon"><i class="fas fa-globe-americas"></i></div>
            <div class="text">
              <h3>Request read write permissions</h3>
              <p>Send a request for permissions change.</p>
            </div>
          </a>
          <a href="account/deleteaccount.php" class="box">
            <div class="icon"><i class="fas fa-ban"></i></div>
            <div class="text">
              <h3>Account ownership and control</h3>
              <p>Permenantly delete your account.</p>
            </div>
          </a>
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