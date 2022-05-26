<?php 
  ob_start();
  session_start();
  if(isset($_SESSION["MANAGERTOKENID"])){
    $page_title = "Manage Managers";
    $header_title = "Managers";
    $content_title = "Managers";
    include_once "init.php";
    include_once $template . "header.php";
    include_once $template . "pageheader.php";
    ?>
      <div class="settings">
        <?php $previous_page = "settings.php" ?>
        <?php include_once $template . "contentheader.php" ?>
        <div class="setting">
          <a href="manager.php?action=add" class="box">
            <div class="icon"><i class="fas fa-user-plus"></i></div>
            <div class="text">
              <h3>Add Manager</h3>
              <p>Fill form data such as fullname, email, password and etc... </p>
            </div>
          </a>
          <a href="manager.php?action=delete" class="box">
            <div class="icon"><i class="fas fa-user-slash"></i></div>
            <div class="text">
              <h3>Delete Manager</h3>
              <p>Select a manager from the list to delete him/her permenantly</p>
            </div>
          </a>
          <a href="manager.php?action=edit" class="box">
            <div class="icon"><i class="fas fa-user-edit"></i></div>
            <div class="text">
              <h3>Edit Manager</h3>
              <p>Fill form data such as fullname, email, password and etc... </p>
            </div>
          </a>
          <a href="manager.php?action=batch" class="box">
            <div class="icon"><i class="fas fa-mouse-pointer"></i></div>
            <div class="text">
              <h3>Batch Select</h3>
              <p>Batch select managers to delete them all.</p>
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