<?php 
  ob_start();
  session_start();
  if(isset($_SESSION["MANAGERTOKENID"])){
    $page_title = "Inputs Privacy";
    // $js_file = "";
    include "init.php";
    include $template . "header.php";
    include_once $template . "pageheader.php";
    ?>
      <div class="settings">
        <?php
          $previous_page = "settings.php";
          $content_title = "Input Privacy System";
          include_once $template . "contentheader.php";
        ?>
        <div class="setting">
          <?php 
            if(isset($_COOKIE["EMAILUPDATED"])){
              ?>
                <div class="added-the-manager">
                  <div class="icon">
                    <i class="fas fa-thumbs-up"></i>
                  </div>
                  <h3><?php echo $_COOKIE["EMAILUPDATED"] ?></h3>
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
                <h3>Please read carefully</h3>
                <h4>So that you do not make mistakes when you fill in the required data fields in the site from adding or modifying the data.</h4>
              </div>
            </div>
            <h2 class="form-title">Input Privacy</h2>
            <div class="privacy">
              <div class="privacy-text">
                <h2><i class="fas fa-check"></i>mandatory and optional fields</h2>
                <span>The fields on the site are <span class="highlight default">mandatory</span>, if there is an optional field, you will find a <span class="decor underline">sign</span> next to it</span>
                <span>You will find <span class="highlight primary">optional</span> next to the optional field.</span>
              </div>
              <div class="privacy-text" id="fullnamePrivacy">
                <h2><i class="fas fa-check"></i>how should your write fullname</h2>
                <span>The triple name of a person consists of <span class="highlight primary">three words</span>separated between each of them by a <span class="highlight default">white space</span>.</span>
                <span>It is <span class="highlight secondary">not correct</span> for a triple name to contain <span class="decor expired">numbers</span> or other <span class="decor expired">signs</span></span>
                <span><span class="highlight default">example</span> of writing a valid full name. <span class="highlight secondary">First</span> + <span class="highlight secondary">middle</span> + <span class="highlight secondary">last</span> </span>
              </div>
              <div class="privacy-text" id="emailPrivacy">
                <h2><i class="fas fa-check"></i>how should your write email</h2>
                <span>
                  The person's e-mail must contain <span class="highlight secondary">letters and numbers</span>. You can use any other signs such as <span class="highlight default">_</span>
                </span>
                <span>
                  The allowed domains within the site are <span class="highlight primary">Gmail</span>, <span class="highlight primary">hotmail</span> and <span class="highlight primary">outlook</span>. You can use <span class="highlight default">.com</span><span class="highlight default">.org</span><span class="highlight default">.edu</span><span class="highlight default">.net</span>
                </span>
                <span>
                  <span class="highlight default">example</span> of writing a valid email.
                  <span class="highlight secondary">example_123@example.com</span>
                </span>
              </div>
              <div class="privacy-text" id="passwordPrivacy">
                <h2><i class="fas fa-check"></i>how should your write password</h2>
                <span>
                  The person's password must be <span class="highlight primary">complex</span> and more than <span class="highlight primary">10 characters</span> long.
                </span>
                <span>
                  It must contain at least <span class="highlight default">two or more letters</span> and <span class="highlight default">two or more signs</span>
                </span>
                <span>
                The allowed tags are <span class="highlight secondary">!@#$%^&*()</span>
                </span>
                <span>
                  Use a <span class="decor underline">combination</span> of numbers, <span class="decor underline">letters</span> and <span class="decor underline">signs</span> to make it <span class="highlight primary">difficult</span> for someone to guess and <span class="highlight default">hack you</span>
                </span>
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