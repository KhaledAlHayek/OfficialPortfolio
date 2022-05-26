<?php
  ob_start();
  session_start();
  if(isset($_SESSION["MANAGERTOKENID"])){
    $page_title = "Manager";
    $header_title = "Managers";
    $content_title =  "";
    include_once "init.php";
    // templates
    include_once $template . "header.php";
    include_once $template . "pageheader.php";
    // include_once $template . "footer.php";
    // classes
    include_once $static . "Validator.php";
    // get request
    $action = isset($_GET["action"]) ? $_GET["action"] : "none";
    ?>
    <div class="settings">
      <?php 
        if($action == "add"){
          $js_file = "addmanagers-min.js";
          // render template for get request 'add'
          $previous_page = "managers.php";
          $content_title .= "Add New Manager";
          include_once $template . "contentheader.php";
          // recieve and handle form data from the add form
          $err = [];
          if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST["save"])){
              $privilige = isset($_POST["privilige"]) ? $_POST["privilige"] : "select"; 
              if($privilige === "select"){
                $err[] = "Please select manager priviliges.";
              }
              $fields = ["fullname", "email", "password"];
              $Validator = new Validator($_POST, $fields);
              $errors = $Validator->validata_form();
              if(count($errors) === 0 && $privilige != "select"){
                $manager = new Manager($connect);
                $add_new_manager = $manager->AddManager($_POST["fullname"], $_POST["email"], $_POST["password"], $privilige);
                if($add_new_manager):
                  ?>
                    <div class="added-the-manager">
                      <div class="icon">
                        <i class="fas fa-thumbs-up"></i>
                      </div>
                      <h3>
                        Successfully added the manager, <strong><?php echo $_POST["fullname"] ?></strong>
                        <?php $_POST = []; ?>
                      </h3>
                      <div class="close">
                        <i class="fas fa-times-circle"></i>
                      </div>
                    </div>
                  <?php
                endif;
              }
            }
          }
          ?>
            <div class="add-manager">
              <form action="<?php echo $_SERVER["PHP_SELF"] . "?action=add" ?>" method="post">
                <div class="notes">
                  <div class="icon">
                    <img src="layout/images/Icon_14.svg" alt="Flag Icon">
                  </div>
                  <div class="text">
                    <h3>all fields are required.</h3>
                    <h4><strong>Notice: </strong>when clicking save, the manager is automatically approved and can log in once he/she have his/her data.</h4>
                  </div>
                </div>
                <h3>Please Fill Out The Manager Information:</h3>
                <div class="input">
                  <?php 
                    if(isset($errors)){
                      if(array_key_exists("fullname", $errors)){
                        echo "<div class='error'><p>" . $errors["fullname"] . "</p></div>";
                      }
                    }
                  ?>
                  <div class="the-input">
                    <input 
                      type="text" 
                      placeholder="Manager fullname" 
                      name="fullname" 
                      autocomplete="off"
                      value="<?php $fullname = isset($_POST["fullname"]) ? $_POST["fullname"] : ""; echo $fullname ?>" 
                      required 
                      autofocus>
                    <div class="input-icon">
                      <i class="fas fa-id-card"></i>
                    </div>
                  </div>
                </div>
                <div class="input">
                  <?php 
                    if(isset($errors)){
                      if(array_key_exists("email", $errors)){
                        echo "<div class='error'><p>" . $errors["email"] . "</p></div>";
                      }
                    }
                  ?>
                  <div class="the-input">
                    <input 
                      type="email" 
                      placeholder="Manager Email" 
                      name="email" 
                      autocomplete="off"
                      value="<?php $email = isset($_POST["email"]) ? $_POST["email"] : ""; echo $email ?>" 
                      required>
                    <div class="input-icon">
                      <i class="fas fa-envelope"></i>
                    </div>
                  </div>
                </div>
                <div class="input">
                  <?php 
                    if(isset($errors)){
                      if(array_key_exists("password", $errors)){
                        echo "<div class='error'><p>" . $errors["password"] . "</p></div>";
                      }
                    }
                  ?>
                  <div class="the-input">
                    <input 
                      type="password" 
                      placeholder="Manager Password" 
                      name="password" 
                      autocomplete="off"
                      value="<?php $password = isset($_POST["password"]) ? $_POST["password"] : ""; echo $password ?>" 
                      required>
                    <div class="input-icon">
                      <i class="fas fa-key"></i>
                    </div>
                  </div>
                </div>
                <div class="input">
                  <?php 
                    if(!empty($err)):
                      foreach($err as $error):
                        ?>
                          <div class="error">
                            <p><?php echo $error ?></p>
                          </div>
                        <?php
                      endforeach;
                    endif;
                  ?>
                  <div class="the-input">
                    <select name="privilige" class="select">
                      <option value="select" disabled selected>Select Manager Permissions</option>
                      <option <?php $selected = isset($_POST["privilige"]) && $_POST["privilige"] == 0 ? "selected" : ""; echo $selected; ?> value="0">Read Only</option>
                      <option <?php $selected = isset($_POST["privilige"]) && $_POST["privilige"] == 1 ? "selected" : ""; echo $selected; ?> value="1">Read, Write</option>
                      <option <?php $selected = isset($_POST["privilige"]) && $_POST["privilige"] == 2 ? "selected" : ""; echo $selected; ?> value="2">Read, but needs approval for write permissions.</option>
                    </select>
                    <span>Notice: you can edit this later</span>
                  </div>
                </div>
                <div class="input">
                  <div class="btns">
                    <input type="submit" name="save" value="Save">
                    <a href="managers.php">Cancel</a>
                  </div>
                </div>
              </form>
            </div>
          <?php
          include $template . "footer.php";
        }
        else if($action == "delete"){
          // render template for get request 'delete'
          $js_file = "deletemanagers-min.js";
          $manager = new Manager($connect);
          $previous_page = "managers.php";
          $content_title .= "Delete Manager";
          include_once $template . "contentheader.php";
          $sort_by = isset($_GET["sort"]) ? $_GET["sort"] : "ASC";
          $sort_methods = ["ASC", "DESC", "asc", "desc"];
          if(!in_array($sort_by, $sort_methods)):
            $sort_by = "ASC";
          endif;
          // handle single manager deletion
          if($_SERVER["REQUEST_METHOD"] == "POST"){
            // handle delete single manager request
            if(isset($_POST["delete_single_manager"])):
              $manager_token_id = isset($_POST["manager"]) ? $_POST["manager"] : "";

              if(empty($manager_token_id)):
                setcookie("NOTSELECTINGMANAGER", "Please select at least one manager", strtotime("+ 5 seconds"));
                redirect_within($_SERVER["PHP_SELF"] . "?action=delete");
              endif;
              // undo delete, save the data
              $manager_found = $manager->is_manager_exist($manager_token_id);
              if($manager_found > 0):
                $data = $manager->GetManagerData($manager_token_id);
                $delete_manager = $manager->DeleteManager($manager_token_id);
                if($delete_manager):
                  setcookie("DELETEDMANAGER", "Manager has been deleted successfully.", strtotime("+ 5 seconds"));
                  redirect_within($_SERVER["PHP_SELF"] . "?action=delete");
                endif;
              else:
                setcookie("TOKENISINVALID", "Cannot found any manager. Please try again", strtotime("+ 5 seconds"));
                redirect_within($_SERVER["PHP_SELF"] . "?action=delete");
              endif;
            endif;
            // handle delete all managers request
            if(isset($_POST["deleteall"])):
              $delete_all = $manager->DeleteManager();
              if($delete_all):
                setcookie("DELETEDALLMANAGERS", "Successfully deleted all the managers.", strtotime("+ 5 seconds"));
                redirect_within($_SERVER["PHP_SELF"] . "?action=delete");
              endif;
            endif;
          }
          ?>
            <?php 
              // error deleting the manager
              if(isset($_COOKIE["NOTSELECTINGMANAGER"])):
                ?>
                  <div class="message">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span><?php echo $_COOKIE["NOTSELECTINGMANAGER"] ?></span>
                  </div>
                <?php
              endif;
              // manager has been deleted
              if(isset($_COOKIE["DELETEDMANAGER"])):
                ?>
                  <div class="message">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span><?php echo $_COOKIE["DELETEDMANAGER"] ?></span>
                  </div>
                <?php
              endif;
              // all managers have been removed
              if(isset($_COOKIE["DELETEDALLMANAGERS"])):
                ?>
                  <div class="message">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span><?php echo $_COOKIE["DELETEDALLMANAGERS"] ?></span>
                  </div>
                <?php
              endif;
              // token submitted is not assigned for any manager
              if(isset($_COOKIE["TOKENISINVALID"])):
                ?>
                  <div class="message">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span><?php echo $_COOKIE["TOKENISINVALID"] ?></span>
                  </div>
                <?php
              endif;
            ?>
            <div class="delete-manager">
              <div class="assets">
                <div class="select-all">
                  <form action="" method="">
                    <label for="selectall">Select all</label>
                    <input type="checkbox" id="selectall" class="select-all-managers" name="">
                  </form>
                </div>
                <div class="search">
                  <form action="" method="">
                    <input type="text" placeholder="Search managers...">
                  </form>
                </div>
                <div class="sort">
                  <span>Sort: </span>
                  <a href="<?php echo $_SERVER["PHP_SELF"] . "?action=delete&sort=ASC" ?>" class="method asc">
                    <i class="fas fa-sort-alpha-up"></i>
                    <div class="sort-tooltip">
                      <span>ASC</span>
                    </div>
                  </a>
                  <a href="<?php echo $_SERVER["PHP_SELF"] . "?action=delete&sort=DESC" ?>" class="method desc">
                    <i class="fas fa-sort-alpha-down"></i>
                    <div class="sort-tooltip">
                      <span>DESC</span>
                    </div>
                  </a>
                </div>
              </div>
              <div class="total-mangers">
                <div class="total">
                  <?php 
                    $manager = new Manager($connect);
                    $total_managers = $manager->total_managers();
                  ?>
                  <span><?php echo $total_managers ?></span>
                  <span>Total manager found</span>
                </div>
                <?php 
                  // show the trash only when select all checkbox's is checked 
                ?>
                <div class="delete-all">
                  <i class="fas fa-trash-alt"></i>
                  <div class="proceed">
                    <div class="are-you-sure">
                      <i class="fas fa-user-slash"></i>
                      <span>Are you sure you want to delete all the managers.</span>
                      <span>This step cannot be undone.</span>
                    </div>
                    <form action="<?php echo $_SERVER["PHP_SELF"] . "?action=delete" ?>" method="POST">
                      <input type="submit" value="Delete all" name="deleteall">
                    </form>
                  </div>
                </div>
              </div>
              <div class="managers">
                <div class="table">
                  <div class="head">
                    <h2>#</h2>
                    <h2>Fullname</h2>
                    <h2>Email</h2>
                    <h2>Action</h2>
                  </div>
                  <div class="body">
                    <?php 
                      $managers = $manager->GetManagerData(NULL, $sort_by);
                      if(!empty($managers)):
                        foreach($managers as $manager):
                          ?>
                            <div class="data">
                              <form action="<?php echo $_SERVER["PHP_SELF"] . "?action=delete" ?>" method="POST">
                                <div class="other-data">
                                  <div class="data-title">
                                    <h2><?php echo $manager["Fullname"] ?></h2>
                                    <i class="fas fa-info-circle"></i>
                                  </div>
                                  <div class="others">
                                    <span>other information</span>
                                    <div class="other password">
                                      <i class="fas fa-lock-open password"></i>
                                      <span class="manager-password"><?php echo $manager["Password"] ?></span>
                                      <div class="copy">
                                        <div class="copy-text">
                                          <i class="fas fa-copy"></i>
                                          <span class="copy-msg">Click to copy.</span>
                                        </div>
                                      </div>
                                    </div>
                                    <?php 
                                      if($manager["ApprovalID"] == 1):
                                        ?>  
                                          <div class="other">
                                            <i class="fas fa-check-circle approved"></i>
                                            <span>Approved</span>
                                          </div>
                                        <?php 
                                      else:
                                        ?>
                                          <div class="other">
                                            <i class="fas fa-times-circle not-approved"></i>
                                            <span>Not Approved</span>
                                          </div>
                                        <?php
                                      endif;
                                    ?>
                                    <div class="other">
                                      <i class="fas fa-calendar applied-at"></i>
                                      <span><?php echo $manager["AppliedDate"] ?></span>
                                    </div>
                                    <?php 
                                      if($manager["Privileges"] == 0):
                                        ?>
                                          <div class="other">
                                            <i class="fas fa-flag permission"></i>
                                            <span>Have Access But Read Only</span>
                                          </div>
                                        <?php
                                      else:
                                        if($manager["Privileges"] == 1):
                                          ?>
                                            <div class="other">
                                              <i class="fas fa-flag permission"></i>
                                              <span>Have Full Access. Read, Write</span>
                                            </div>
                                          <?php
                                        else:
                                          ?>
                                            <div class="other">
                                              <i class="fas fa-flag permission"></i>
                                              <span>Have Access But He Need Approval for editing, deleting and etc..</span>
                                            </div>
                                          <?php
                                        endif;
                                      endif;
                                    ?>
                                  </div>
                                </div>
                                <span class="target-manager"><input type="checkbox" class="manager-checkbox" name="manager" value="<?php echo $manager["TokenID"] ?>"></span>
                                <span class="manager-fullname">
                                  <div class="label">Fullname: </div>
                                  <?php echo $manager["Fullname"] ?>
                                </span>
                                <span title="<?php echo $manager["Email"] ?>">
                                  <div class="label">Email: </div>
                                  <?php echo $manager["Email"] ?>
                                </span>
                                <span class="action"><button name="delete_single_manager"><i class="fas fa-trash"></i></button></span>
                              </form>
                            </div>
                          <?php
                        endforeach;
                      else:
                        ?>
                          <div class="no-manager-found">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>No manager found. Add new one.</span>
                            <a href="<?php echo $_SERVER["PHP_SELF"] . "?action=add" ?>"><i class="fas fa-plus"></i> Add Manager</a>
                          </div>
                        <?php
                      endif;
                    ?>
                  </div>
                </div>
              </div>
            </div>
          <?php
          include $template . "footer.php";
        }
        else if($action == "edit"){
          // render edit manager template
          $js_file = "editmanagers-min.js";
          $manager = new Manager($connect);
          $previous_page = "managers.php";
          $content_title .= "Edit Manager";
          include_once $template . "contentheader.php";
          $edit_template = isset($_GET["template"]) ? trim(htmlspecialchars($_GET["template"])) : "none";
          $token_id = isset($_GET["token_id"]) ? $_GET["token_id"] : "";
          if($edit_template == "none" || empty($edit_template) || !in_array($edit_template, ["edit_user"])){
            $edit_template = "edit_user"  ;
          }
          if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST["edit-manager"])){
              $validator = new Validator($_POST, ["approval", "limits"]);
              $validation = $validator->validata_form();
              $token = $_POST["token"];
              $fullname = empty($_POST["fullname"]) ? $_POST["oldfullname"] : $_POST["fullname"];
              $email = empty($_POST["email"]) ? $_POST["oldemail"] : $_POST["email"];
              $password = empty($_POST["password"]) ? $_POST["oldpassword"] : $_POST["password"];
              $approval = $_POST["approval"];
              $limits = $_POST["limits"];
              // TODO : backend validation
              $backend_validation = [];
              if(empty($validation)){
                if($manager->is_manager_exist($token)):
                  $edit_manager = $manager->EditManager($token, $fullname, $email, $password, $approval, $limits);
                  if($edit_manager):
                    setcookie("MANAGERMODIFIED", "Successfully changed manager information", strtotime("+5 seconds"));
                    redirect_within($_SERVER["PHP_SELF"] . "?action=edit");
                  endif;
                else:
                  redirect_within($_SERVER["PHP_SELF"] . "?action=edit");
                endif;
              }
            }
          }
          if($edit_template == "edit_user" && !empty($token_id)){
            if($manager->is_manager_exist($token_id)){
              $data = $manager->GetManagerData($token_id);
              ?>
                <div class="edit-custom-user <?php $class = $edit_template == "edit_user" ? "show-for-edit" : ""; echo $class; ?>">
                  <?php 
                    $redirect_to = explode("?", $_SERVER["HTTP_REFERER"]);
                    $page_str = end($redirect_to);
                    $page_to_redirect_to = explode("=", $page_str);
                    $page_name = end($page_to_redirect_to);
                  ?>
                  <div class="container">
                    <div class="head">
                      <h2>Edit <strong><?php echo $data["Fullname"] ?></strong> Information.</h2>
                      <a href="<?php echo $_SERVER["PHP_SELF"] . "?action=edit" ?>" class="close">
                        <i class="fas fa-times"></i>
                      </a>
                    </div>
                    <div class="body">
                      <form action="<?php echo $_SERVER["PHP_SELF"] . "?action=edit" ?>" method="POST">
                        <?php 
                          // Fullname input
                        ?>
                        <div class="edit-input fullname-field">
                          <div class="input-label">
                            <label for="">Fullname</label>
                            <div class="input-error">
                              <div class="the-error">
                                <span>Full name is invalid</span>
                              </div>
                              <i class="fas fa-exclamation-circle"></i>
                            </div>
                          </div>
                          <div class="input">
                            <span class="old-data"><?php echo $data["Fullname"] ?></span>
                            <input 
                              type="text" 
                              name="fullname" 
                              class="edit-fullname" 
                              placeholder="Enter new manager fullname" 
                              autocomplete="off">
                            <div class="animate-on-focus"></div>
                            <input type="hidden" value="<?php echo $data["Fullname"] ?>" name="oldfullname">
                          </div>
                        </div>
                        <?php 
                          // Email input
                        ?>
                        <div class="edit-input email-field">
                          <div class="input-label">
                            <label for="">Email</label>
                            <div class="input-error">
                              <div class="the-error">
                                <span>Email is invalid</span>
                              </div>
                              <i class="fas fa-exclamation-circle"></i>
                            </div>
                          </div>
                          <div class="input">
                            <span class="old-data"><?php echo $data["Email"] ?></span>
                            <input 
                              type="text" 
                              name="email" 
                              class="edit-email" 
                              placeholder="Enter new manager email" 
                              autocomplete="off">
                            <div class="animate-on-focus"></div>
                            <input type="hidden" value="<?php echo $data["Email"] ?>" name="oldemail">
                          </div>
                        </div>
                        <?php 
                          // Password input
                        ?>
                        <div class="edit-input password-field">
                          <div class="input-label">
                            <label for="">Password</label>
                            <div class="input-error">
                              <div class="the-error">
                                <span>Password is invalid</span>
                              </div>
                              <i class="fas fa-exclamation-circle"></i>
                            </div>
                          </div>
                          <div class="input">
                            <span class="old-data"><?php echo $data["Password"] ?></span>
                            <input 
                              type="text"
                              name="password"
                              class="edit-password"
                              placeholder="Enter new manager password"
                              autocomplete="off">
                            <div class="animate-on-focus"></div>
                            <input type="hidden" value="<?php echo $data["Password"] ?>" name="oldpassword">
                            <div class="show-hide"><i class="fas fa-eye"></i></div>
                          </div>
                        </div>
                        <?php 
                          // change approval status
                        ?>
                        <div class="edit-input approval-field">
                          <div class="input-label">
                            <label for="">Change Approval Status</label>
                          </div>
                          <div class="input">
                            <div class="radio-btn">
                              <label for="approved">Approved</label>
                              <input 
                                type="radio" 
                                id="approved" 
                                class="check" 
                                name="approval"
                                <?php $approved = $data["ApprovalID"] == 1 ? "checked" : ""; echo $approved; ?>
                                value="1">
                            </div>
                            <div class="radio-btn">
                              <label for="not-approved">Not Approved</label>
                              <input 
                                type="radio" 
                                id="not-approved" 
                                class="times" 
                                name="approval"
                                <?php $not_approved = $data["ApprovalID"] == 0 ? "checked" : ""; echo $not_approved; ?> 
                                value="0">
                            </div>
                          </div>
                        </div>
                        <?php 
                          // change admin priviliges
                        ?>
                        <div class="edit-input approval-field">
                          <div class="input-label">
                            <label for="">Set limits for this manager</label>
                          </div>
                          <div class="input">
                            <select name="limits" id="">
                              <option value="0" <?php $val = $data["Privileges"] == 0 ? "selected" : ""; echo $val ?>>Read Only</option>
                              <option value="1" <?php $val = $data["Privileges"] == 1 ? "selected" : ""; echo $val ?>>Read Write</option>
                              <option value="2" <?php $val = $data["Privileges"] == 2 ? "selected" : ""; echo $val ?>>Read, but need approval for write permissions</option>
                            </select>
                          </div>
                        </div>
                        <div class="submit">
                          <input type="hidden" name="token" value="<?php echo $data["TokenID"] ?>">
                          <input type="submit" class="submit-form" value="Save Changes" name="edit-manager">
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              <?php
            }
            else{
              // not found any manager with that token ID
              setcookie("COULDNOTFOUNDMANAGER", "Something went wrong. Please try again later.", strtotime("+ 5 seconds"));
              redirect_within($_SERVER["PHP_SELF"] . "?action=edit");
            }
          }
          ?>
          <?php 
            // successfully modified manager
            if(isset($_COOKIE["MANAGERMODIFIED"])):
              ?>
                <div class="message success">
                  <i class="fas fa-exclamation-triangle"></i>
                  <span><?php echo $_COOKIE["MANAGERMODIFIED"] ?></span>
                </div>
              <?php
            endif;
            // could not modify manager, token ID not found
            if(isset($_COOKIE["COULDNOTFOUNDMANAGER"])):
              ?>
                <div class="message success">
                  <i class="fas fa-exclamation-triangle"></i>
                  <span><?php echo $_COOKIE["COULDNOTFOUNDMANAGER"] ?></span>
                </div>
              <?php
            endif;
          ?>
          <div class="edit-manager">
            <div class="search-for-edit">
              <div class="search-input">
                <input type="text" placeholder="Search Managers...">
                <div class="close-search">
                  <i class="fas fa-times"></i>
                </div>
              </div>
              <div class="search-icon">
                <div class="search-tooltip">
                  <span>Search Managers</span>
                </div>
                <i class="fas fa-search"></i>
              </div>
            </div>
            <div class="total">
              <?php
                $total = $manager->total_managers();
                if($total == 0):
                  ?>
                    <div class="not-found">
                      <span>No Manager Found</span>
                      <a href="manager.php?action=add"><i class="fas fa-plus"></i> New Manager</a>
                    </div>
                  <?php
                else:
                  ?>
                  <div class="total-found">
                    <div class="number"><?php echo $total ?> <span>Managers</span></div>
                    <?php 
                      $managers = $manager->GetManagerData();
                      foreach($managers as $manager):
                        ?>
                          <div class="the-manager">
                            <div class="show-email">
                              <i class="fas fa-envelope"></i>
                              <span><?php echo $manager["Email"] ?></span>
                            </div>
                            <div class="fullname">
                              <i class="fas fa-user"></i>
                              <span><?php echo $manager["Fullname"] ?></span>
                              <a href="manager.php?action=edit&template=edit_user&token_id=<?php echo $manager["TokenID"] ?>" class="edit-the-manager"><i class="fas fa-edit"></i> Edit</a>
                            </div>
                            <div class="clear-float"></div>
                          </div>
                        <?php
                      endforeach;
                    ?>
                  </div>
                  <?php
                endif;
              ?>
            </div>
          </div>
          <?php
          include_once $template . "footer.php";
        }
        else if($action == "batch"){
          // render perform batch action manager template
          $js_file = "performbatch-min.js";
          $manager = new Manager($connect);
          $previous_page = "managers.php";
          $content_title .= "Perform Batch Action";
          include_once $template . "contentheader.php";
          $total = $manager->total_managers();
          $limits = isset($_GET["limits"]) ? intval($_GET["limits"]) : 10;
          $sort = isset($_GET["sort"]) && in_array($_GET["sort"], ["ASC", "DESC", "asc", "desc"]) ? $_GET["sort"] : "ASC";
          $page = isset($_GET["page"]) && $_GET["page"] == "search" ? $_GET["page"] : "";
          $confirm_delete = isset($_GET["confirm"]) && in_array($_GET["confirm"], ["DELETE", "delete"]) ? $_GET["confirm"] : "";
          // confirm manager removal
          if(!empty($confirm_delete)){
            $js_file = "confirmdelete-min.js";
            $token = isset($_GET["delete"]) && !empty($_GET["delete"]) ? $_GET["delete"] : "";
            ?>
              <div class="confirm-delete">
                <a href="<?php echo $_SERVER["PHP_SELF"] . "?action=batch" ?>" class="close-confirmal">
                  <i class="fas fa-times"></i>
                </a>
                <div class="confirm">
                  <?php
                    if($manager->is_manager_exist($token) > 0):
                      $data = $manager->GetManagerData($token);
                      ?>
                      <div class="the-form">
                        <div class="deleting-icon">
                          <i class="fas fa-trash-alt"></i>
                        </div>
                        <h3>Confirm deleting manager.</h3>
                        <span>are you sure you want to permenantly delete <strong><?php echo $data["Fullname"] ?></strong></span>
                        <form action="<?php echo $_SERVER["PHP_SELF"] . "?action=batch" ?>" method="POST">
                          <input type="hidden" value="<?php echo $data["TokenID"] ?>" name="token">
                          <input type="submit" name="deleting-manager" value="Confirm Delete">
                        </form>
                      </div>
                      <?php
                    else:
                      ?>
                      <div class="not-found-any">
                        <h2 class="no-manager-found">404</h2>
                        <span>Could not found any manager. Please try again.</span>
                      </div>
                      <?php
                    endif;
                  ?>
                </div>
              </div>
            <?php
            include $template . "footer.php";
          }
          // search managers
          if(!empty($page) && $page == "search"){
            $js_file = "searchmanagers-min.js";
            ?>
              <div class="advanced-search">
                <div class="container">
                  <div class="upper-search">
                    <i class="fas fa-search search-icon"></i>
                    <i class="fas fa-times clear-search"></i>
                    <form action="" method="POST">
                      <input type="text" placeholder="Search..." name="filter" class="filter">
                    </form>
                    <div class="relevant-search">
                      <?php 
                        $managers = $manager->GetManagerData();
                        if(!empty($managers)):
                          foreach($managers as $manager):
                            ?>
                              <div class="manager-action">
                                <div class="manager-holder">
                                  <div class="name">
                                    <i class="fas fa-user"></i>
                                    <span class="manager-fullname"><?php echo $manager["Fullname"] ?></span>
                                  </div>
                                  <div class="the-action">
                                    <a href="<?php echo $_SERVER["PHP_SELF"] . "?action=batch&confirm=delete&delete=" . $manager["TokenID"] . "" ?>" class="del">
                                      <i class="fas fa-user-times"></i>
                                    </a>
                                    <a href="<?php echo $_SERVER["PHP_SELF"] . "?action=edit&template=edit_user&token_id=" . $manager["TokenID"] . "" ?>" class="edit">
                                      <i class="fas fa-user-edit"></i>
                                    </a>
                                  </div>
                                </div>
                              </div>
                            <?php
                          endforeach;
                        else:
                          // TODO show no managers to search for.
                        endif; 
                      ?>
                    </div>
                  </div>
                </div>
              </div>
            <?php
            include $template . "footer.php";
          }
          if($_SERVER["REQUEST_METHOD"] == "POST"){
            $tokens = isset($_POST["tokens"]) ? $_POST["tokens"] : [];
            // deleting single manager while viewing info
            if(isset($_POST["deleting-manager"])){
              $manager = new Manager($connect);
              $token = $_POST["token"];
              $is_found = $manager->is_manager_exist($token);
              if($is_found > 0){
                if($manager->DeleteManager($token) > 0):
                  setcookie("DELETEDMANAGERINFO", "Successfully deleted manager information", strtotime("+ 5 seconds"));
                  redirect_within($_SERVER["PHP_SELF"] . "?action=batch");
                endif;
              }
              else{
                setcookie("NOTDELETEDMANAGERINFO", "Could not found any manager. Please try again.", strtotime("+ 5 seconds"));
                redirect_within($_SERVER["PHP_SELF"] . "?action=batch");
              }
            }
            if(isset($_POST["delete"])){
              if(!empty($tokens)){
                foreach($tokens as $token):
                  $delete_manager = $manager->DeleteManager($token);
                  if($delete_manager):
                    $msg = count($tokens) < 2 ? "manager" : "managers";
                    setcookie("DELETINGPERFORMED", "Successfully deleted " . count($tokens) . " " . $msg . "", strtotime("+ 5 seconds"));
                    redirect_within($_SERVER["PHP_SELF"] . "?action=batch&sort=" . $sort . "");
                  endif;
                endforeach;
              }
              else{
                setcookie("CANNOTPERFORMDELETE", "Please select one or more manager.", strtotime("+ 5 seconds"));
                redirect_within($_SERVER["PHP_SELF"] . "?action=batch&sort=" . $sort . "");
              }
            }
            if(isset($_POST["edit"])){
              if(!empty($tokens) && count($tokens) == 1){
                redirect_within("manager.php?action=edit&template=edit_user&token_id=" . $tokens[0] . "");
              }
              else{
                setcookie("CANNOTPERFORMEDIT", "Please select at least one manager.", strtotime("+ 5 seconds"));
                redirect_within($_SERVER["PHP_SELF"] . "?action=batch&sort=" . $sort . "");
              }
            }
            if(isset($_POST["search"])){
              redirect_within($_SERVER["PHP_SELF"] . "?action=batch&page=search");
            }
            if(isset($_POST["info"])){
              $js_file = "managersinfo-min.js";
              // pass tokens for another page and seperate them with `|`
              if(!empty($tokens)):
                if(count($tokens) != 0):
                  $manager_data = [];
                  $counter = 0;
                  $total_tokens_passed = count($tokens);
                  // grap manager data for each token ID
                  foreach($tokens as $token):
                    if($manager->is_manager_exist($token) > 0):
                      $data = $manager->GetManagerData($token);
                      array_push($manager_data, $data);
                      $counter++;
                    endif;
                  endforeach;
                  if($counter != $total_tokens_passed):
                    setcookie("TOKENSPASSEDARENOTVALID", "Something went wrong. Please try again later", strtotime("+ 5 seconds"));
                    redirect_within($_SERVER["PHP_SELF"] . "?action=batch");
                  else:
                    ?>
                      <div class="view-managers-info">
                        <div class="container info-box">
                          <div class="arrow-prev arrow">
                            <i class="fas fa-chevron-left"></i>
                          </div>
                          <?php 
                            foreach($manager_data as $data):
                              ?>
                                <div class="info-holder">
                                  <div class="manager-card">
                                    <div class="head">
                                      <div class="head-holder">
                                        <div class="card-name">
                                          <?php echo $data["Fullname"] ?>
                                        </div>
                                        <div class="copy-token">
                                          <i class="fas fa-copy"></i>
                                          <div class="what-to-copy" data-copy="<?php echo $data["TokenID"] ?>">
                                            <span>copy <strong><?php echo $data["Fullname"] ?></strong> specific token ID</span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="body">
                                      <div class="data pass" data-copydata="<?php echo $data["Password"] ?>">
                                        <div class="copy-tooltip">Click To Copy</div>
                                        <i class="fas fa-key"></i>
                                        <div class="value">
                                          <div class="key">Password</div>
                                          <span title="<?php echo $data["Password"] ?>"><?php echo $data["Password"] ?></span>
                                        </div>
                                      </div>
                                      <div class="data email" data-copydata="<?php echo $data["Email"] ?>">
                                        <div class="copy-tooltip">Click To Copy</div>
                                        <i class="fas fa-envelope"></i>
                                        <div class="value">
                                          <div class="key">Email</div>
                                          <span title="<?php echo $data["Email"] ?>"><?php echo $data["Email"] ?></span>
                                        </div>
                                      </div>
                                      <?php 
                                        if($data["ApprovalID"] == 1):
                                          ?>
                                            <div class="data approved">
                                              <i class="fas fa-thumbs-up"></i>
                                              <div class="value">
                                                <div class="key">Approval</div>
                                                <span>Approved</span>
                                              </div>
                                            </div>
                                          <?php
                                        else:
                                          ?>
                                            <div class="data not-approved">
                                              <i class="fas fa-thumbs-down"></i>
                                              <div class="value">
                                                <div class="key">Approval</div>
                                                <span>Not Approved</span>
                                              </div>
                                            </div>
                                          <?php
                                        endif;
                                        if($data["Privileges"] == 0):
                                          ?>
                                            <div class="data read">
                                              <i class="fab fa-readme"></i>
                                              <div class="value">
                                                <div class="key">Permissions</div>
                                                <span>Read Only</span>
                                              </div>
                                            </div>
                                          <?php
                                        else:
                                          if($data["Privileges"] == 1):
                                            ?>
                                              <div class="data read-write">
                                                <i class="fas fa-pen"></i>
                                                <div class="value">
                                                  <div class="key">Permissions</div>
                                                  <span>Read Write</span>
                                                </div>
                                              </div>
                                            <?php
                                          else:
                                            ?>
                                              <div class="data need-approval">
                                                <i class="fas fa-globe-africa"></i>
                                                <div class="value">
                                                  <div class="key">Permissions</div>
                                                  <span title="Read, but needs approval for write permissions">Read, but needs approval for write permissions.</span>
                                                </div>
                                              </div>
                                            <?php
                                          endif;
                                        endif;
                                      ?>
                                      <div class="data callendar" data-copydata="<?php echo $data["AppliedDate"] ?>">
                                        <div class="copy-tooltip">Click To Copy</div>
                                        <i class="fas fa-calendar"></i>
                                        <div class="value">
                                          <div class="key">Applied At</div>
                                          <span title="<?php echo $data["AppliedDate"] ?>"><?php echo $data["AppliedDate"] ?></span>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="foot">
                                      <div class="manage-current">
                                        <a href=""><i class="fas fa-edit"></i></a>
                                        <a href="<?php echo $_SERVER["PHP_SELF"] . "?action=batch&confirm=delete&delete=" . $data["TokenID"] . "" ?>"><i class="fas fa-trash-alt"></i></a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              <?php
                            endforeach;
                          ?>
                          <div class="arrow-next arrow">
                            <i class="fas fa-chevron-right"></i>
                          </div>
                        </div>
                      </div>
                    <?php
                  endif;
                endif;
              else:
                setcookie("CANNOTVIEWINFO", "Select one or more manager to view more information", strtotime("+ 5 seconds"));
                redirect_within($_SERVER["PHP_SELF"] . "?action=batch");
              endif;
              include_once $template . "footer.php";
            }
          }
          // cannot perform delete because no manager is selected
          if(isset($_COOKIE["CANNOTPERFORMDELETE"])):
            ?>
              <div class="message">
                <i class="fas fa-exclamation-triangle"></i>
                <span><?php echo $_COOKIE["CANNOTPERFORMDELETE"] ?></span>
              </div>
            <?php
          endif;
          // cannot get managers info because one or more tokens are invalid.
          if(isset($_COOKIE["TOKENSPASSEDARENOTVALID"])):
            ?>
              <div class="message">
                <i class="fas fa-exclamation-triangle"></i>
                <span><?php echo $_COOKIE["TOKENSPASSEDARENOTVALID"] ?></span>
              </div>
            <?php
          endif;
          // deleted managers succeeded
          if(isset($_COOKIE["DELETINGPERFORMED"])):
            ?>
              <div class="message">
                <i class="fas fa-exclamation-triangle"></i>
                <span><?php echo $_COOKIE["DELETINGPERFORMED"] ?></span>
              </div>
            <?php
          endif;
          // deleted manager succeeded while viewing manager info
          if(isset($_COOKIE["DELETEDMANAGERINFO"])):
            ?>
              <div class="message">
                <i class="fas fa-exclamation-triangle"></i>
                <span><?php echo $_COOKIE["DELETEDMANAGERINFO"] ?></span>
              </div>
            <?php
          endif;
          // could not perform delete manager while viewing manager info
          if(isset($_COOKIE["NOTDELETEDMANAGERINFO"])):
            ?>
              <div class="message">
                <i class="fas fa-exclamation-triangle"></i>
                <span><?php echo $_COOKIE["NOTDELETEDMANAGERINFO"] ?></span>
              </div>
            <?php
          endif;
          // more than one manager selected for edit action
          if(isset($_COOKIE["CANNOTPERFORMEDIT"])):
            ?>
              <div class="message">
                <i class="fas fa-exclamation-triangle"></i>
                <span><?php echo $_COOKIE["CANNOTPERFORMEDIT"] ?></span>
              </div>
            <?php
          endif;
          // select a user to view more information about
          if(isset($_COOKIE["CANNOTVIEWINFO"])):
            ?>
              <div class="message">
                <i class="fas fa-exclamation-triangle"></i>
                <span><?php echo $_COOKIE["CANNOTVIEWINFO"] ?></span>
              </div>
            <?php
          endif;
          ?>
          <div class="batch-assets">
            <form action="" method="POST">
              <div class="the-actions">
                <div class="the-total">
                  <span><strong><?php echo $total ?></strong> manager found</span>
                </div>
                <button name="delete" class="perform-action">
                  <i class="fas fa-trash-alt"></i>
                  <div class="action-tooltip">
                    Delete
                  </div>
                </button>
                <a href="manager.php?action=add" class="perform-action">
                  <i class="fas fa-plus"></i>
                  <div class="action-tooltip">
                    New
                  </div>
                </a>
                <button name="edit" class="perform-action">
                  <i class="fas fa-edit"></i>
                  <div class="action-tooltip">
                    Edit
                  </div>
                </button>
                <button name="search" class="perform-action">
                  <i class="fas fa-search"></i>
                  <div class="action-tooltip">
                    Search
                  </div>
                </button>
                <button name="info" class="perform-action">
                  <i class="fas fa-info"></i>
                  <div class="action-tooltip view-more">
                    Select a user to view more information
                  </div>
                </button>
                <a 
                  href="<?php echo $_SERVER["PHP_SELF"] . "?action=batch&sort=DESC" ?>" 
                  class="perform-action <?php $active = isset($_GET["sort"]) && $_GET["sort"] == "DESC" ? "active" : ""; echo $active ?>">
                  <i class="fas fa-sort-alpha-down"></i>
                  <div class="action-tooltip">
                    DESC
                  </div>
                </a>
                <a 
                  href="<?php echo $_SERVER["PHP_SELF"] . "?action=batch&sort=ASC" ?>" 
                  class="perform-action <?php $active = isset($_GET["sort"]) && $_GET["sort"] == "ASC" ? "active" : ""; echo $active ?>">
                  <i class="fas fa-sort-alpha-up"></i>
                  <div class="action-tooltip">
                    ASC
                  </div>
                </a>
                <a 
                  href="?action=batch&only_approved=true" 
                  class="perform-action <?php $active = isset($_GET["only_approved"]) && $_GET["only_approved"] == "true" ? "active" : ""; echo $active ?>">
                  <i class="fas fa-check"></i>
                  <div class="action-tooltip view-more">
                    Show Only Approved Managers
                  </div>
                </a>
                <a 
                  href="?action=batch&only_disapproved=true" 
                  class="perform-action <?php $active = isset($_GET["only_disapproved"]) && $_GET["only_disapproved"] == "true" ? "active" : ""; echo $active ?>">
                  <i class="fas fa-user-clock"></i>
                  <div class="action-tooltip view-more">
                    Show Only Pending Managers
                  </div>
                </a>
              </div>
              <div class="managers-list">
                <span><strong><?php echo $total; ?></strong> managers found</span>
                <div class="line"></div>
                  <?php 
                    $only_approved = isset($_GET["only_approved"]) && $_GET["only_approved"] == "true" ? true : false;
                    $only_disapproved = isset($_GET["only_disapproved"]) && $_GET["only_disapproved"] == "true" ? true : false;
                    $managers = $manager->GetManagerData(null, $sort, $limits, $only_approved, $only_disapproved);
                    if(!empty($managers)){
                      foreach($managers as $manager):
                        ?>
                        <div class="manager-box">
                          <div class="row-data">
                            <label for="<?php echo $manager["Fullname"] . $manager["ID"] ?>">
                              <?php echo $manager["Fullname"] ?>
                            </label>
                          </div>
                          <div class="row-data">
                            <input 
                              type="checkbox" 
                              class="manager-checkbox"
                              value="<?php echo $manager["TokenID"] ?>" 
                              name="tokens[]"
                              id="<?php echo $manager["Fullname"] . $manager["ID"] ?>">
                          </div>
                        </div>
                        <?php
                      endforeach;
                    }
                    else{
                      ?>
                      <div class="no-result-found">
                        <span>No result found</span>
                      </div>
                      <?php
                    }
                  ?>
              </div>
              <div class="view-more <?php $fixed = $limits > 60 ? "fixed" : ""; echo $fixed ?>">
                <a 
                  href="
                    <?php 
                      
                      $location = $_SERVER["PHP_SELF"] . "?action=batch&only_approved=" . $only_approved . "&limits=";
                      $limit = $limits > 10 ? $limits - 10 : 10;
                      if($limit < 10):
                        $limit = $location . 10;
                        echo $limit;
                      else:
                        echo $location . $limit;
                      endif;
                    ?>
                  "
                  class="decrement link">
                  <span><i class="fas fa-minus"></i></span>
                </a>
                <div class="limit-to">
                  <input 
                    type="number" 
                    value="<?php
                        $value = $limits > $total ? $total : $limits;
                        echo $value;
                      ?>" 
                    min="10" 
                    max="50" 
                    step="10" 
                    readonly>
                </div>
                <a 
                  href="
                    <?php

                      $location = $_SERVER["PHP_SELF"] . "?action=batch&only_disapproved=" . $only_disapproved . "&limits=";
                      $limit = $limits > $total ? $location . $limits + 10 : $location . $total;
                      echo $limit;
                    ?>
                  " 
                  class="increment link">
                  <span><i class="fas fa-plus"></i></span>
                </a>
              </div>
            </form>
          </div>
          <?php
          include $template . "footer.php";
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
?>