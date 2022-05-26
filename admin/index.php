<?php 
  ob_start();
  session_start();
  if(isset($_SESSION["MANAGERTOKENID"])){
    $page_title = "Admin - Khaled Hayek Portfolio Site";
    $js_file = "index-min.js";
    include_once "init.php";
    include_once $static . "Manager.php";
    $manager = new Manager($connect);
    $manager_token = $_SESSION["MANAGERTOKENID"];
    $manager_logged_in = $manager->GetManagerData($manager_token);
    include_once $template . "header.php";
    ?>
    <div class="header">
      <div class="logo">
        <div class="toggle-menu mouse-event">
          <i class="fas fa-bars"></i>
        </div>
        <div class="img">
          <div class="brand-name">
            <h1>KH</h1>
          </div>
        </div>
      </div>
      <div class="search">
        <input type="text" placeholder="Search...">
        <div class="search-icon">
          <i class="fas fa-search"></i>
        </div>
      </div>
      <div class="profile-menu">
        <div class="notifications mouse-event">
          <i class="far fa-bell"></i>
        </div>
        <div class="notifications mouse-event customize" data-show="customize-layout">
          <i class="fas fa-th-large"></i>
        </div>
        <div class="my-profile mouse-event customize" data-show="customize-profile">
          <span><?php echo $manager_logged_in["Fullname"] ?></span>
          <i class="fas fa-sort-down"></i>
        </div>
      </div>
      <div class="customize-layout current-menu">
        <h3 class="divider">Top Header</h3>
        <div class="customize-item">
          <span>Fixed</span>
          <div class="en-ds header-fixed">
            <span data-action="enable" data-target="header">Enable</span>
            <span class="active" data-action="disable" data-target="header">Disable</span>
          </div>
        </div>
        <div class="customize-item">
          <span>Light/Dark Theme</span>
          <div class="en-ds header-theme">
            <span data-action="enable" data-target="header">Enable</span>
            <span class="active" data-action="disable" data-target="header">Disable</span>
          </div>
        </div>
        <h3 class="divider">Sidebar</h3>
        <div class="customize-item">
          <span>Fixed</span>
          <div class="en-ds side-bar-layout">
            <span data-action="enable" data-target="side-bar">Enable</span>
            <span class="active" data-action="disable" data-target="side-bar">Disable</span>
          </div>
        </div>
        <div class="customize-item">
          <span>Light/Dark Theme</span>
          <div class="en-ds side-bar-theme">
            <span data-action="enable" data-target="side-bar">Enable</span>
            <span class="active" data-action="disable" data-target="side-bar">Disable</span>
          </div>
        </div>
        <h3 class="divider">Footer</h3>
        <div class="customize-item">
          <span>Fixed</span>
          <div class="en-ds footer-layout">
            <span data-action="enable" data-target="footer">Enable</span>
            <span class="active" data-action="disable" data-target="footer">Disable</span>
          </div>
        </div>
        <div class="customize-item">
          <span>Light/Dark Theme</span>
          <div class="en-ds footer-theme">
            <span data-action="enable" data-target="footer">Enable</span>
            <span class="active" data-action="disable" data-target="footer">Disable</span>
          </div>
        </div>
      </div>
      <div class="customize-profile current-menu">
        <ul>
          <li>
            <a href="settings.php" class="mouse-event no-border">
              <div class="icon">
                <i class="fas fa-cog"></i>
              </div>
              <div class="text">
                <span>Settings</span>
              </div>
            </a>
          </li>
          <li>
            <a href="account/security.php" class="mouse-event no-border">
              <div class="icon">
                <i class="fas fa-lock"></i>
              </div>
              <div class="text">
                <span>Change Password</span>
              </div>
            </a>
          </li>
          <li>
            <a href="logout.php" class="sign-out mouse-event no-border">
              <div class="icon">
                <i class="fas fa-sign-out-alt"></i>
              </div>
              <div class="text">
                <span>Sign Out</span>
              </div>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="content">
      <div class="side-bar">
        <div class="admin-profile">
          <div class="img"></div>
          <div class="name">
            <h2>Khaled Hayek</h2>
          </div>
        </div>
        <div class="admin-menu">
          <ul>
            <li>
              <a href="#" class="mouse-event no-border">
                <div class="menu-item">
                  <div class="icon">
                    <i class="fas fa-tachometer-alt"></i>
                  </div>
                  <div class="text">
                    <span>Dashboard</span>
                  </div>
                </div>
                <div class="menu-arrow">
                  <i class="fas fa-chevron-down"></i>
                </div>
              </a>
            </li>
            <li class="sub-menu">
              <ul class="sub-menu-ul">
                <li class="sub-menu-li">
                  <a href="#" class="sub-menu-item mouse-event no-border">
                    <i class="fas fa-home"></i>
                    <span>Menu Item</span>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
          <ul>
            <li>
              <a href="#" class="mouse-event no-border">
                <div class="menu-item">
                  <div class="icon">
                    <i class="fas fa-book-reader"></i>
                  </div>
                  <div class="text">
                    <span>Experience</span>
                  </div>
                </div>
                <div class="menu-arrow">
                  <i class="fas fa-chevron-down"></i>
                </div>
              </a>
            </li>
            <li class="sub-menu">
              <ul class="sub-menu-ul">
                <li class="sub-menu-li">
                  <a href="#" class="sub-menu-item mouse-event no-border">
                    <i class="fas fa-home"></i>
                    <span></span>
                  </a>
                </li>
              </ul>
            </li>
            <li>
              <a href="#" class="mouse-event no-border">
                <div class="menu-item">
                  <div class="icon">
                    <i class="fas fa-graduation-cap"></i>
                  </div>
                  <div class="text">
                    <span>Education</span>
                  </div>
                </div>
                <div class="menu-arrow">
                  <i class="fas fa-chevron-down"></i>
                </div>
              </a>
            </li>
            <li class="sub-menu">
              <ul class="sub-menu-ul">
                <li class="sub-menu-li">
                  <a href="#" class="sub-menu-item mouse-event no-border">
                    <i class="fas fa-home"></i>
                    <span></span>
                  </a>
                </li>
              </ul>
            </li>
            <li>
              <a href="#" class="mouse-event no-border">
                <div class="menu-item">
                  <div class="icon">
                    <i class="fas fa-file-code"></i>
                  </div>
                  <div class="text">
                    <span>Skills</span>
                  </div>
                </div>
                <div class="menu-arrow">
                  <i class="fas fa-chevron-down"></i>
                </div>
              </a>
            </li>
            <li class="sub-menu">
              <ul class="sub-menu-ul">
                <li class="sub-menu-li">
                  <a href="#" class="sub-menu-item mouse-event no-border">
                    <i class="fas fa-home"></i>
                    <span></span>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
          <ul>
            <li>
              <a href="#" class="mouse-event no-border">
                <div class="menu-item">
                  <div class="icon">
                    <i class="fas fa-calendar-week"></i>
                  </div>
                  <div class="text">
                    <span>Callendar</span>
                  </div>
                </div>
              </a>
            </li>
            <li>
              <a href="todo.php" class="mouse-event no-border">
                <div class="menu-item">
                  <div class="icon">
                    <i class="fas fa-th-list"></i>
                  </div>
                  <div class="text">
                    <span>ToDo List</span>
                  </div>
                </div>
              </a>
            </li>
            <li>
              <a href="#" class="mouse-event no-border">
                <div class="menu-item">
                  <div class="icon">
                    <i class="fas fa-question-circle"></i>
                  </div>
                  <div class="text">
                    <span>Help</span>
                  </div>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="dashboard">
        <div class="overall-notifications">
          <div class="msg-text">
            <span>Message Goes Here.</span>
          </div>
          <div class="msg-icon">
            <i class="fas fa-times"></i>
          </div>
        </div>
        <div class="dash-title">
          <h2>Khaled Hayek Portfolio Dashboard.</h2>
        </div>
        <div class="notice">
          <div class="important-notice">
            <h3><strong>Important</strong>. Please read carefully: </h3>
            <ul>
              <li><span>Some features and links in this dashboard are not finished yet.</span></li>
              <li><span>You may click on some links that will not redirect you to any place.</span></li>
              <li><span>You may view some fake content which are just for the purpose of some features coming to take place over it.</span></li>
              <li><span>The purpose is that i am seaeching for a job right now and as you know the status of our country and the difficult living situation</span></li>
              <li><span>Accoding to that, i have stopped working this dashboard until the change of my situation.</span></li>
              <li><span>Finally, as you know the importance of the portfolio in the CV, i have to stop working and share my portfolio with companies.</span></li>
              <li class="thanks"><span>Thank You</span></li>
            </ul>
          </div>
        </div>
        <div class="dash-info">
          <div class="info-box exp">
            <span class="top"></span>
            <span class="left"></span>
            <span class="right"></span>
            <span class="bottom"></span>
            <div class="head">
              <h2>Experience</h2>
            </div>
            <div class="body">
              <div class="info">
                <div class="title">
                  <span>Project Type: </span>
                </div>
                <div class="sub-title">
                  <span>Sub Title</span>
                </div>
              </div>
              <div class="info">
                <div class="title">
                  <span>Project Name: </span>
                </div>
                <div class="sub-title">
                  <span>Sub Title</span>
                </div>
              </div>
              <div class="info">
                <div class="title">
                  <span>Project Place: </span>
                </div>
                <div class="sub-title">
                  <span>Sub Title</span>
                </div>
              </div>
              <div class="info">
                <div class="title">
                  <span>Modified: </span>
                </div>
                <div class="sub-title">
                  <span>Sub Title</span>
                </div>
              </div>
              <div class="info">
                <div class="title">
                  <span>Status: </span>
                </div>
                <div class="sub-title">
                  <span class="styled pending">Sub Title</span>
                </div>
              </div>
            </div>
            <div class="body">
              <div class="info">
                <div class="title">
                  <span>Project Type: </span>
                </div>
                <div class="sub-title">
                  <span>Sub Title</span>
                </div>
              </div>
              <div class="info">
                <div class="title">
                  <span>Project Name: </span>
                </div>
                <div class="sub-title">
                  <span>Sub Title</span>
                </div>
              </div>
              <div class="info">
                <div class="title">
                  <span>Project Place: </span>
                </div>
                <div class="sub-title">
                  <span>Sub Title</span>
                </div>
              </div>
              <div class="info">
                <div class="title">
                  <span>Modified: </span>
                </div>
                <div class="sub-title">
                  <span>Sub Title</span>
                </div>
              </div>
              <div class="info">
                <div class="title">
                  <span>Status: </span>
                </div>
                <div class="sub-title">
                  <span class="styled pending">Sub Title</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="my-skills">
          <span class="top"></span>
          <span class="left"></span>
          <span class="right"></span>
          <span class="bottom"></span>
          <div class="head">
            <h2>My Skills</h2>
            <ul>
              <li class="active mouse-event" data-filter="all">All</li>
              <li class="mouse-event" data-filter="frontend">Frontend</li>
              <li class="mouse-event" data-filter="backend">Backend</li>
            </ul>
          </div>
          <div class="body">
            <div class="skill-box frontend">
              <div class="skill-image">
                <img src="../layout/images/skills/html-5.png" alt="Skill Picture">
              </div>
              <div class="skill-name">
                <span>HTML</span>
              </div>
            </div>
            <div class="skill-box frontend">
              <div class="skill-image">
                <img src="../layout/images/skills/css-3.png" alt="Skill Picture">
              </div>
              <div class="skill-name">
                <span>CSS</span>
              </div>
            </div>
            <div class="skill-box frontend">
              <div class="skill-image">
                <img src="../layout/images/skills/js.png" alt="Skill Picture">
              </div>
              <div class="skill-name">
                <span>Javascript</span>
              </div>
            </div>
            <div class="skill-box backend">
              <div class="skill-image">
                <img src="../layout/images/skills/php.png" alt="Skill Picture">
              </div>
              <div class="skill-name">
                <span>PHP</span>
              </div>
            </div>
            <div class="skill-box frontend">
              <div class="skill-image">
                <img src="../layout/images/skills/sass.png" alt="Skill Picture">
              </div>
              <div class="skill-name">
                <span>SASS</span>
              </div>
            </div>
            <div class="skill-box frontend">
              <div class="skill-image">
                <img src="../layout/images/skills/react.png" alt="Skill Picture">
              </div>
              <div class="skill-name">
                <span>React</span>
              </div>
            </div>
            <div class="skill-box frontend">
              <div class="skill-image">
                <img src="../layout/images/skills/ajax.png" alt="Skill Picture">
              </div>
              <div class="skill-name">
                <span>AJAX</span>
              </div>
            </div>
          </div>
        </div>
        <div class="project-details">
          <div class="details">
            <span class="top"></span>
            <span class="left"></span>
            <span class="right"></span>
            <span class="bottom"></span>
            <div class="head">
              <h2>Project Name Details</h2>
              <div class="icon mouse-event">
                <i class="fas fa-minus"></i>
              </div>
            </div>
            <div class="body">
              <div class="table-header">
                <div class="id">
                  <h3>#</h3>
                </div>
                <div class="description">
                  <h3>Details</h3>
                </div>
                <div class="action">
                  <h3>Action</h3>
                </div>
              </div>
              <div class="table-data">
                <div class="for-id">
                  <input type="checkbox" name="" id="label-1">
                </div>
                <div class="for-desc">
                  <label for="label-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet, sed.</label>
                </div>
                <div class="for-action">
                  <a href="#" class="edit">Edit</a>
                  <a href="#" class="delete">Delete</a>
                </div>
              </div>
              <div class="table-data">
                <div class="for-id">
                  <input type="checkbox" name="" id="label-2">
                </div>
                <div class="for-desc">
                  <label for="label-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet, sed.</label>
                </div>
                <div class="for-action">
                  <a href="#" class="edit">Edit</a>
                  <a href="#" class="delete">Delete</a>
                </div>
              </div>
              <div class="table-data">
                <div class="for-id">
                  <input type="checkbox" name="" id="label-3">
                </div>
                <div class="for-desc">
                  <label for="label-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet, sed.</label>
                </div>
                <div class="for-action">
                  <a href="#" class="edit">Edit</a>
                  <a href="#" class="delete">Delete</a>
                </div>
              </div>
            </div>
          </div>
        </div> 
        <div class="to-do-list">
          <div class="holder">
            <span class="top"></span>
            <span class="left"></span>
            <span class="right"></span>
            <span class="bottom"></span>
            <div class="to-do">
              <div class="edit">
                <i class="fas fa-edit"></i>
              </div>
              <div class="icon-move">
                <i class="fas fa-ellipsis-v"></i>
                <i class="fas fa-ellipsis-v"></i>
              </div>
              <div class="to-do-text">
                <!-- Dont Add More Elements ~~ Configured By JS -->
                <input type="checkbox">
                <input type="text" value="Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quibusdam, ex!">
                <label for="" class="display-input">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quibusdam, ex!
                <span class="completed-label">completed</span>
                </label>
              </div>
            </div>
            <div class="to-do">
              <div class="edit">
                <i class="fas fa-edit"></i>
              </div>
              <div class="icon-move">
                <i class="fas fa-ellipsis-v"></i>
                <i class="fas fa-ellipsis-v"></i>
              </div>
              <div class="to-do-text">
                <!-- Dont Add More Elements ~~ Configured By JS -->
                <input type="checkbox">
                <input type="text" value="Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quibusdam, ex!">
                <label for="" class="display-input">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quibusdam, ex!
                <span class="completed-label">completed</span>
                </label>
              </div>
            </div>
            <div class="to-do">
              <div class="edit">
                <i class="fas fa-edit"></i>
              </div>
              <div class="icon-move">
                <i class="fas fa-ellipsis-v"></i>
                <i class="fas fa-ellipsis-v"></i>
              </div>
              <div class="to-do-text">
                <!-- Dont Add More Elements ~~ Configured By JS -->
                <input type="checkbox">
                <input type="text" value="Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quibusdam, ex!">
                <label for="" class="display-input">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quibusdam, ex!
                <span class="completed-label">completed</span>
                </label>
              </div>
            </div>
            <div class="to-do">
              <div class="edit">
                <i class="fas fa-edit"></i>
              </div>
              <div class="icon-move">
                <i class="fas fa-ellipsis-v"></i>
                <i class="fas fa-ellipsis-v"></i>
              </div>
              <div class="to-do-text">
                <!-- Dont Add More Elements ~~ Configured By JS -->
                <input type="checkbox">
                <input type="text" value="Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quibusdam, ex!">
                <label for="" class="display-input">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quibusdam, ex!
                  <span class="completed-label">completed</span>
                </label>
              </div>
            </div>
          </div>
        </div>
        <div class="footer">
          <p>&copy; 2022. All Rights Reserved. <strong>Khaled Hayek</strong> Portfolio Dashboard.</p>
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