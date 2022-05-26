<?php 
  ob_start();
  session_start();
  if(isset($_SESSION["MANAGERTOKENID"])){
    $page_title = "Customize Your Shortcuts";
    $js_file = "shortcuts-min.js";
    $sub_folder_directory = true; // should come before init file
    include "../init.php";
    include_once $static . "Shortcuts.php";
    $manager_id = $logged_manager_data["ID"];
    $shortcut = new Shortcuts($manager_id, $connect);
    $total_shortcuts = $shortcut->totalShortcuts();
    include $template . "header.php";
    include_once $template . "pageheader.php";
    $possible_actions = ["new", "edit", "delete"];
    $shortcut_request = isset($_GET["shortcut"]) && in_array($_GET["shortcut"], $possible_actions) ? $_GET["shortcut"] : ""; 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      if(isset($_POST["add-sh"])){
        $name = $_POST["name"];
        $link = $_POST["link"];
        $desc = $_POST["desc"];
        $add_shortcut = $shortcut->addShortcut($name, $link, $desc);
        if($add_shortcut):
          setcookie("SHORTCUTADDED", "Successfully added " . $name . " to your shortcuts", strtotime("+ 3 seconds"));
          redirect_within($_SERVER["PHP_SELF"] . "?shortcut=new");
        endif;
      }
      if(isset($_POST["remove-sh"])){
        $name = $_POST["name"];
        $id = $shortcut->isShortcutExist("Name", $name); 
        if($id){
          $delete_shortcut = $shortcut->removeShortcut($id);
          if($delete_shortcut):
            setcookie("SHORTCUTDELETED", "Successfully deleted " . $name . " from your shortcuts", strtotime("+ 3 seconds"));
            redirect_within($_SERVER["PHP_SELF"] . "?shortcut=new");
          endif;
        }
        else{
          setcookie("SHORTCUTNOTEXIST", "Something went wrong. Please try again.", strtotime("+ 3 seconds"));
          redirect_within($_SERVER["PHP_SELF"] . "?shortcut=new");
        }
      }
    }
    if(!empty($shortcut_request)){
      if($shortcut_request == "new"){
        ?>
        <div class="settings">
          <?php
            $previous_page = "shortcuts.php";
            $content_title = "Add New Shortcut";
            include_once $template . "contentheader.php";
          ?>
          <?php 
            if(isset($_COOKIE["SHORTCUTDELETED"])){
              ?>
                <div class="message success">
                  <i class="fas fa-check"></i>
                  <span><?php echo $_COOKIE["SHORTCUTDELETED"] ?></span>
                </div>
              <?php
            }
            if(isset($_COOKIE["SHORTCUTNOTEXIST"])){
              ?>
                <div class="message">
                  <i class="fas fa-times"></i>
                  <span><?php echo $_COOKIE["SHORTCUTNOTEXIST"] ?></span>
                </div>
              <?php
            }
            if(isset($_COOKIE["SHORTCUTADDED"])){
              ?>
                <div class="message success">
                  <i class="fas fa-check"></i>
                  <span><?php echo $_COOKIE["SHORTCUTADDED"] ?></span>
                </div>
              <?php
            }
          ?>
          <div class="setting">
            <div class="sh-for-you">
              <h2 class="form-title">Shortcuts customized for you</h2>
              <div class="total-sh">
                <div class="my-sh">
                  <span><strong class="total"></strong> total shortcuts found</span>
                  <span class="divider"></span>
                  <span>you have <strong><?php echo $shortcut->totalShortcuts() ?></strong> shortcuts</span>
                </div>
                <div class="indicates">
                  <span>Shortcut already added</span>
                  <span></span>
                </div>
              </div>
              <div class="sh">
              </div>
            </div>
          </div>
        </div>
      <?php
      }
    }
    else{
      ?>
        <div class="settings">
          <?php
            $previous_page = "../settings.php";
            $content_title = "Customize Your Shortcuts";
            include_once $template . "contentheader.php";
          ?>
          <div class="setting">
            <div class="change-name">
              <div class="notice">
                <div class="icon"><i class="fas fa-bell"></i></div>
                <div class="text">
                  <h3>Easily navigate between pages</h3>
                  <h4>Shortcuts help you reach the page you want with one click, without having to browse more than one page in order to reach your goal.</h4>
                </div>
              </div>
              <h2 class="form-title">My Shortcuts</h2>
              <?php 
                if($total_shortcuts > 0){
                  $shortcuts = $shortcut->myShortcuts();
                  ?>
                    <div class="my-shortcuts-sh">
                      <?php 
                        foreach($shortcuts as $shortcut):
                          ?>
                          <a href="?shortcut=new" class="the-sh">
                            <i class="fas fa-star"></i>
                            <div class="name">
                              <span><?php echo $shortcut["Name"] ?></span>
                            </div>
                            <span class="manage"><i class="fas fa-cog"></i></span>
                          </a>
                          <?php
                        endforeach;
                      ?>
                    </div>
                  <?php
                }
                else{
                  ?>
                  <div class="no-shortcut-found">
                    <i class="fas fa-exclamation-circle"></i>
                    <h2>No shortcut found.</h2>
                    <a href="<?php echo $_SERVER["PHP_SELF"] . "?shortcut=new" ?>"><i class="fas fa-plus"></i> New Shortcut</a>
                  </div>
                  <?php
                }
              ?>
            </div>
          </div>
        </div>
      <?php
    }
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
<script>
  let shortcuts = [];
  const data = localStorage.getItem("shortcuts");
  if(data){
    shortcuts = JSON.parse(data);
  }

  // remove success/error message after 3 seconds
  const messageBox = document.querySelectorAll(".message");
  messageBox.forEach(box => {
    setTimeout(() => {
      box.style.display = "none";
    }, 3000);
  })

  // add shortcuts to page
  const shortcutsBox = document.querySelector(".setting .sh-for-you .sh");
  const totalShortcuts = document.querySelector(".setting .sh-for-you .total-sh .my-sh .total");

  window.onload = () => {
    const total = shortcuts.length;
    totalShortcuts.innerHTML = total;
    let myShortcuts = [];
    <?php 
      $my_shortcuts = $shortcut->myShortcuts();
      foreach($my_shortcuts as $shortcut):
        $name = $shortcut["Name"];
        ?>
        myShortcuts.push("<?php echo $name ?>");
        <?php
      endforeach;
    ?>
    let uniqueShortcuts = [...new Set(myShortcuts)];
    shortcuts.map(shortcut => {
      const name = shortcut.pageName;
      const desc = shortcut.description;
      const link = shortcut.pageLink;
      let cssClass = "";
      uniqueShortcuts.forEach(shortcut => {
        if(shortcut == name){
            cssClass = "already-added";
        }
      })
      let html = "";
      let hideAddForm = false;
      if(cssClass !== ""){
        hideAddForm = true
      }
      if(hideAddForm){
        html = `
          <div class="the-shortcut ${cssClass}">
            <div class="sh-info">
              <i class="fas fa-clone"></i>
              <h3 class="sh-name">${name}</h3>
              <span class="sh-desc">${desc}</span>
            </div>
            <div class="add">
              <form action="shortcuts.php?shortcut=new" method="POST">
                <input type="hidden" value="${name}" name="name" />
                <button name="remove-sh" class="remove-sh">Remove</button>
              </form>
            </div>
          </div>
        `
      }
      else{
        html = `
          <div class="the-shortcut ${cssClass}">
            <div class="sh-info">
              <i class="fas fa-clone"></i>
              <h3 class="sh-name">${name}</h3>
              <span class="sh-desc">${desc}</span>
            </div>
            <div class="add">
              
              <form action="shortcuts.php?shortcut=new" method="POST">
                <input type="hidden" value="${name}" name="name" />
                <input type="hidden" value="${link}" name="link" />
                <input type="hidden" value="${desc}" name="desc" />
                <button name="add-sh"><i class="fas fa-plus"></i></button>
              </form>
            </div>
          </div>
        `
      }
      shortcutsBox.innerHTML += html;
    });
  };
</script>