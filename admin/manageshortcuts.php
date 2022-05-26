<?php 
  ob_start();
  session_start();
  if(isset($_SESSION["MANAGERTOKENID"])){
    $page_title = "Manage Shortcuts";
    $js_file = "managealiases-min.js";
    $shortcut_file_here = "";
    include "init.php";
    include $template . "header.php";
    ?>
    <div class="settings">
      <?php
        $previous_page = "settings.php";
        $content_title = "Add New Shortcut";
        include_once $template . "contentheader.php";
      ?>
      <div class="setting">
        <div class="aliases">
          <div class="add-alias">
            <div class="head">
              <h2>New Shortcut</h2>
              <i class="fas fa-chevron-down"></i>
            </div>
            <div class="alias-action">
              <div class="msg">
                <i class=""></i>
                <span></span>
              </div>
              <form action="" method="POST" id="add-shortcut">
                <div class="form-inputs">
                  <div class="the-input">
                    <label for="">Page name</label>
                    <input type="text" name="name" autocomplete="off">
                  </div>
                  <div class="the-input">
                    <label for="">Link to the page</label>
                    <input type="text" name="link" autocomplete="off">
                  </div>
                  <div class="the-input">
                    <label for="">Short description</label>
                    <input type="text" name="desc" autocomplete="off">
                  </div>
                </div>
                <div class="submit-form">
                  <input type="submit" value="Publish">
                </div>
              </form>
            </div>
          </div>
          <div class="edit-alias">
            <div class="head">
              <h2>Edit Shortcut</h2>
              <i class="fas fa-chevron-down"></i>
            </div>
            <div class="alias-action">
              <div class="msg">
                <i class=""></i>
                <span></span>
              </div>
              <div class="select-shortcut">
                <span>Select shortcut from the list below.</span>
                <select name="select-sh" id="">
                  <option value="0" disabled selected>Select shortcut to edit.</option>
                </select>
              </div>
              <form action="" method="POST" id="edit-shortcut">
                <div class="form-inputs">
                  <div class="the-input">
                    <label for="">Page name</label>
                    <input type="text" class="edit-name" name="name">
                  </div>
                  <div class="the-input">
                    <label for="">Link to the page</label>
                    <input type="text" class="edit-link" name="link">
                  </div>
                  <div class="the-input">
                    <label for="">Short description</label>
                    <input type="text" class="edit-desc" name="desc">
                  </div>
                </div>
                <div class="submit-form">
                  <input type="hidden" name="id" class="sh-id">
                  <input type="submit" value="Save Changes">
                </div>
              </form>
            </div>
          </div>
          <div class="remove-alias">
            <div class="head">
              <h2>Remove Shortcut</h2>
              <i class="fas fa-chevron-down"></i>
            </div>
            <div class="alias-action">
              <div class="msg">
                <i class=""></i>
                <span></span>
              </div>
              <div class="select-shortcut">
                <span>Select shortcut from the list below.</span>
                <select name="select-sh" id="">
                  <option value="0" disabled selected>Select shortcut to remove.</option>
                </select>
              </div>
              <form action="" method="POST" id="delete-shortcut">
                <div class="submit-form">
                  <input type="hidden" name="id" class="sh-id">
                  <input type="submit" value="Delete Shortcut">
                </div>
              </form>
            </div>
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