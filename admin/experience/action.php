<?php 
  ob_start();
  session_start();
  if(isset($_SESSION["MANAGERTOKENID"])){
    $allowed_attempts = 3;
    $page_title = "Experience";
    $js_file = "experience-min.js";
    $sub_folder_directory = true; // should come before init file
    include "../init.php";
    $manager_logged_id   = $logged_manager_data["ID"];
    $manager_permissions = $logged_manager_data["Privileges"];
    $manager_approval    = $logged_manager_data["ApprovalID"];
    include $template . "header.php";
    include_once $template . "pageheader.php";
    include_once $static . "Experience.php";
    include_once $static . "ExperienceRequest.php";
    include_once $static . "Request.php";
    include_once $static . "Assets.php";
    $possible_actions = ["new", "edit", "delete"];
    $action = isset($_GET["a"]) && in_array($_GET["a"], $possible_actions) ? $_GET["a"] : "";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    }
    ?>
      <div class="settings">
        <?php
          if($manager_approval != 1 || $manager_permissions != 1){
            ?>
              <div class="setting">
                <div class="permission-not-applicable">
                  <div class="request-text">
                    <i class="fas fa-exclamation-triangle"></i>
                    <h2>Your request to reach this page is denied.</h2>
                    <span>You cannot view this page because your permissions are not applicable to reach this page.</span>
                    <a href="#">Request Changes</a>
                  </div>
              </div>
            <?php
          }
          else{
            $previous_page = "./experience.php";
            $content_title = "Experience";
            include_once $template . "contentheader.php";
            if(!empty($action)){
              if($action == "new"){
                if(!isset($_SESSION["DISABLEALLEXPFUNCTIONALITY"])){
                  if($_SERVER["REQUEST_METHOD"] == "POST"){
                    $errors = [];
                    $possible_values = [0, 1];
                    $type = $_POST["type"];
                    $name = $_POST["name"];
                    $place = $_POST["place"];
                    $modified = isset($_POST["modified"]) ? strval($_POST["modified"]) : "";
                    $status = isset($_POST["status"]) ? strval($_POST["status"]) : "";
                    if(!in_array($modified, $possible_values)){
                      $errors[] = "Please specify the modification status.";
                    }
                    if(!in_array($status, $possible_values)){
                      $errors[] = "Please specify the project status.";
                    }
                    $pattern = "/[a-zA-Z](\W+)?(\s)?/i";
                    if(!preg_match($pattern, $type) || !preg_match($pattern, $name) || !preg_match($pattern, $place)){
                      $errors[] = "Data is incorrect. Some data is invalid and does not match what we expect.";
                    }
                    if(empty($errors)){
                      $implode = implode("|", $_POST);
                      redirect_within("details.php?d={$implode}");
                    }
                  }
                  ?>
                    <div class="setting">
                      <div class="experience">
                        <div class="notice">
                          <div class="icon"><i class="fas fa-bell"></i></div>
                          <div class="text">
                            <h3>Manage <strong>Khaled Ali Hayek</strong> Experience</h3>
                            <h4>Manage information about Khaled's experience. Upon completion of the work, the entered information will be sent to Khaled for approval. You will be notified about the request you have made. <a href="">Learn more</a></h4>
                          </div>
                        </div>
                        <?php 
                          if(!empty($errors)):
                            foreach($errors as $err):
                              ?>
                              <div><?php echo $err ?></div>
                              <?php
                            endforeach;
                          endif;
                        ?>
                        <h2 class="form-title">Add New Experience</h2>
                        <div class="add-experience exp">
                          <form action="<?php echo $_SERVER["PHP_SELF"] . "?a=new" ?>" method="POST">
                            <div class="exp-input">
                              <input 
                                type="text" 
                                name="type" 
                                class="type"
                                value="<?php 
                                  $val = isset($_POST["type"]) ? $_POST["type"] : "";
                                  echo $val;
                                ?>"
                                autocomplete="off">
                              <span>Project Type</span>
                            </div>
                            <div class="type-error error"></div>
                            <div class="exp-input">
                              <input 
                                type="text" 
                                name="name" 
                                class="name" 
                                value="<?php 
                                  $val = isset($_POST["name"]) ? $_POST["name"] : "";
                                  echo $val;
                                ?>"
                                autocomplete="off">
                              <span>Project Name</span>
                            </div>
                            <div class="exp-name-error error"></div>
                            <div class="exp-input">
                              <input 
                                type="text" 
                                name="place" 
                                class="place"
                                value="<?php 
                                  $val = isset($_POST["place"]) ? $_POST["place"] : "";
                                  echo $val;
                                ?>" 
                                autocomplete="off">
                              <span>Project Place</span>
                            </div>
                            <div class="place-error error"></div>
                            <div class="radio-input">
                              <h3>Is this project going under modifiying?</h3>
                              <div class="radio">
                                <label for="yes">Yes</label>
                                <input type="radio" id="yes" name="modified" value="1">
                              </div>
                              <div class="radio">
                                <label for="no">No</label>
                                <input type="radio" id="no" name="modified" value="0">
                              </div>
                            </div>
                            <div class="radio-input">
                              <h3>Is this project finsihed?</h3>
                              <div class="radio">
                                <label for="status-yes">Yes</label>
                                <input type="radio" id="status-yes" name="status" value="1">
                              </div>
                              <div class="radio">
                                <label for="status-no">No</label>
                                <input type="radio" id="status-no" name="status" value="0">
                              </div>
                            </div>
                            <div class="submit">
                              <input type="submit" value="Next" class="submit-btn">
                              <a href="./experience.php">Cancel</a>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  <?php
                }
                else{
                  ?>
                    <div class="settings">
                      <?php 
                        $previous_page = "../portfolio.php";
                        $content_title = "Cannot Add More";
                        include_once $template . "contentheader.php";
                      ?>
                      <div class="setting">
                        <div class="experience">
                          <div class="notice">
                            <div class="icon"><i class="fas fa-bell"></i></div>
                            <div class="text">
                              <h3>Total attempts exceeded</h3>
                              <h4>You cannot add more than 2 experiences. Once one of your experience request approved you can add more.</h4>
                            </div>
                          </div>
                          <div class="total-exceeded">
                            <i class="fas fa-info-circle"></i>
                            <h2>Come back later after one of your requests is approved or rejected.</h2>
                            <a href="experience.php">Go Back</a>
                          </div>
                      </div>
                    </div>
                  <?php 
                }
              }
              else if($action == "edit"){
                $init_request = new Request($connect, $manager_logged_id);
                $total_edit_request = $init_request->totalRequestsByManager("edit");
                if($total_edit_request < $allowed_attempts){
                  $experience = new Experience($connect, $manager_logged_id);
                  $data = $experience->experienceData();
                  if($_SERVER["REQUEST_METHOD"] == "POST"){
                    $errors = [];
                    $type = $_POST["type"];
                    $name = $_POST["name"];
                    $place = $_POST["place"];
                    $modified = $_POST["modified"];
                    $status = $_POST["status"];
                    $new_data = array_slice($_POST, 0, 5);
                    $new_details = array_slice($_POST, 5);
                    foreach($new_details as $index=>$detail){
                      if(empty($new_details[$index])){
                        $errors[$index] = "Project detail is empty. Please fill out this field.";
                      }
                    }
                    if(empty($type)){
                      $errors["type"] = "Type is empty. Please fill out this field.";
                    }
                    if(empty($name)){
                      $errors["name"] = "Name is empty. Please fill out this field.";
                    }
                    if(empty($place)){
                      $errors["place"] = "Place is empty. Please fill out this field.";
                    }
                    if($modified == 1 && $status == 1){
                      $errors["cannotproceed"] = "The project cannot be finished and go to modification at the same time";
                    }
                    if(empty($errors)){
                      $experience_id = isset($_GET["index"]) ? intval($_GET["index"]) : "";
                      if($experience_id != ""){
                        $id = $data[$experience_id]["ID"];
                        $exp_new_details = join("%", $new_details);
                        $request = new ExperienceRequest($connect, $manager_logged_id);
                        array_push($new_data, $id);
                        $new_data_array = [];
                        foreach($new_data as $index=>$data):
                          array_push($new_data_array, $new_data[$index]);
                        endforeach;
                        $auth = new Authentication($manager_logged_id);
                        if($auth->isKhaled()){
                          $edit = $experience->performExpAction("edit", $new_data_array, $exp_new_details);
                          redirect_within($_SERVER["PHP_SELF"] . "?a=edit");
                        }
                        else{
                          $request = $request->experienceRequest("edit", $new_data_array, $exp_new_details);
                          if($request){
                            setcookie("EDITREQUESTSENT", "Request Sent", strtotime("+ 1 minute"));
                            redirect_within($_SERVER["PHP_SELF"] . "?a=edit");
                          }
                        }
                      }
                    }
                  }
                  if(!empty($data)){
                    ?>
                      <div class="setting">
                        <div class="experience">
                          <div class="notice">
                            <div class="icon"><i class="fas fa-bell"></i></div>
                            <div class="text">
                              <h3>Manage <strong>Khaled Ali Hayek</strong> Experience</h3>
                              <h4>Manage information about Khaled's experience. Upon completion of the work, the entered information will be sent to Khaled for approval. You will be notified about the request you have made. <a href="">Learn more</a></h4>
                            </div>
                          </div>
                          <?php 
                            if(isset($_COOKIE["EDITREQUESTSENT"])){
                              ?>
                                <div class="edit-request-sent">
                                  <i class="fas fa-check-circle"></i>
                                  <h2>Request Sent</h2>
                                  <span>Your request to edit the experience has been successfully sent to <strong>Khaled Ali Hayek</strong>. Check your inbox for request status.</span>
                                </div>
                              <?php
                            }
                          ?>
                          <h2 class="form-title">Edit Experience</h2>
                          <div class="experience-list">
                            <?php 
                              foreach($data as $index=>$exp):
                                ?>
                                  <div class="the-experience <?php
                                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                                      $class = !empty($errors) ? "control-panels" : ""; 
                                      echo $class; 
                                    }
                                    ?>">
                                    <div class="panel-head">
                                      <div class="select-exp">
                                        <input type="checkbox" class="checkbox-exp" <?php $checked = !empty($errors) ? "checked" : ""; echo $checked; ?>>
                                      </div>
                                      <div class="exp-info">
                                        <h2><?php echo $exp["ProjectType"] ?></h2>
                                        <div class="divider"></div>
                                        <span><?php echo $exp["ProjectName"] ?></span>
                                      </div>
                                    </div>
                                    <div class="panel-body">
                                      <form action="<?php echo $_SERVER["PHP_SELF"] . "?a=edit&index={$index}" ?>" method="POST">
                                        <?php 
                                          if(!empty($errors) && !empty($errors["cannotproceed"])){
                                            ?>
                                              <div class="errors">
                                                <?php echo $errors["cannotproceed"] ?>
                                              </div>
                                            <?php
                                          }
                                        ?>
                                        <div class="project-info edit-the-exp">
                                          <h2>Experience Information</h2>
                                          <div class="the-input">
                                            <label for="" class="edit-label">Project Type <i class="fas fa-exclamation-circle"></i></label>
                                            <div class="input-info">
                                              <?php 
                                                if(!empty($errors)){
                                                  if(!empty($errors["type"])){
                                                    ?>
                                                      <div class="input-error">
                                                        <div class="error-msg">
                                                          <?php echo $errors["type"] ?>
                                                        </div>
                                                        <i class="fas fa-exclamation-circle"></i>
                                                      </div>
                                                    <?php
                                                  }
                                                }
                                              ?>
                                              <input 
                                                type="text" 
                                                value="<?php
                                                  $value = isset($_POST["type"]) ? $_POST["type"] : $exp["ProjectType"];
                                                  echo $value; 
                                                ?>" 
                                                name="type"
                                                autocomplete="off"
                                                required
                                                class="main-input">
                                              <span><?php echo $exp["ProjectType"] ?></span>
                                            </div>
                                          </div>
                                          <div class="the-input">
                                            <label for="" class="edit-label">Project Name  <i class="fas fa-exclamation-circle"></i></label>
                                            <div class="input-info">
                                              <?php 
                                                if(!empty($errors)){
                                                  if(!empty($errors["name"])){
                                                    ?>
                                                      <div class="input-error">
                                                        <div class="error-msg">
                                                          <?php echo $errors["name"] ?>
                                                        </div>
                                                        <i class="fas fa-exclamation-circle"></i>
                                                      </div>
                                                    <?php
                                                  }
                                                }
                                              ?>
                                              <input 
                                                type="text" 
                                                value="<?php 
                                                  $value = isset($_POST["name"]) ? $_POST["name"] : $exp["ProjectName"];
                                                  echo $value;
                                                  ?>" 
                                                name="name"
                                                autocomplete="off"
                                                required 
                                                class="main-input">
                                              <span><?php echo $exp["ProjectName"] ?></span>
                                            </div>
                                          </div>
                                          <div class="the-input">
                                            <label for="" class="edit-label">Project Place  <i class="fas fa-exclamation-circle"></i></label>
                                            <div class="input-info">
                                              <?php 
                                                if(!empty($errors)){
                                                  if(!empty($errors["place"])){
                                                    ?>
                                                      <div class="input-error">
                                                        <div class="error-msg">
                                                          <?php echo $errors["place"] ?>
                                                        </div>
                                                        <i class="fas fa-exclamation-circle"></i>
                                                      </div>
                                                    <?php
                                                  }
                                                }
                                              ?>
                                              <input 
                                                type="text" 
                                                value="<?php 
                                                  $value = isset($_POST["place"]) ? $_POST["place"] : $exp["ProjectPlace"];
                                                  echo $value;
                                                  ?>" 
                                                name="place"
                                                autocomplete="off"
                                                required 
                                                class="main-input">
                                              <span><?php echo $exp["ProjectPlace"] ?></span>
                                            </div>
                                          </div>
                                          <div class="radio-input">
                                            <label for="">Is this project will go under maintainence?</label>
                                            <div class="input-info">
                                              <div class="radio-status">
                                                <label for="mod-yes">Yes</label>
                                                <input 
                                                  type="radio" 
                                                  id="mod-yes" 
                                                  name="modified"
                                                  <?php $checked = $exp["Modified"] == 0 ? "checked" : ""; echo $checked ?>
                                                  value="1">
                                              </div>
                                              <div class="radio-status">
                                                <label for="mod-no">No</label>
                                                <input 
                                                  type="radio" 
                                                  id="mod-no" 
                                                  name="modified"
                                                  <?php $checked = $exp["Modified"] == 1 ? "checked" : ""; echo $checked ?>
                                                  value="0">
                                              </div>
                                            </div>
                                          </div>
                                          <div class="radio-input">
                                            <label for="">Is this project Finished?</label>
                                            <div class="input-info">
                                              <div class="radio-status">
                                                <label for="yes">Yes</label>
                                                <input 
                                                  type="radio" 
                                                  id="yes" 
                                                  name="status"
                                                  <?php $checked = $exp["Projectstatus"] == 1 ? "checked" : ""; echo $checked ?> 
                                                  value="1">
                                              </div>
                                              <div class="radio-status">
                                                <label for="no">No</label>
                                                <input 
                                                  type="radio" 
                                                  id="no" 
                                                  name="status"
                                                  <?php $checked = $exp["Projectstatus"] == 0 ? "checked" : ""; echo $checked ?> 
                                                  value="0">
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="project-details edit-the-exp">
                                          <h2>Experience Details</h2>
                                          <?php 
                                            $details = $experience->singleExpData($exp["ID"]);
                                            $experience_details = $details[1][0];
                                            $experience_details = substr($experience_details, 0, strlen($experience_details) - 1);
                                            $current_exp_details = explode("%", $experience_details);
                                            if($_SERVER["REQUEST_METHOD"] == "POST"){
                                              $total_new = count($new_details) - count($current_exp_details);
                                              $new_added_details = array_slice($new_details, $total_new + 1);
                                            }
                                          ?>
                                          <div class="add-new-experience-detail" data-total="<?php 
                                            if($_SERVER["REQUEST_METHOD"] == "POST"){
                                              echo count($new_details);
                                            }
                                            else{
                                              echo count($current_exp_details);
                                            }
                                          ?>">
                                            <i class="fas fa-plus"></i>
                                            <span>Detail</span>
                                          </div>
                                          <div class="details">
                                            <?php 
                                              $counter = 1;
                                              foreach($current_exp_details as $index=>$detail):
                                                ?>
                                                  <div class="the-input">
                                                    <div class="input-info">
                                                      <?php 
                                                        if(!empty($errors) && !empty($errors["detail-" . $counter++])){
                                                          ?>
                                                            <div class="input-error">
                                                              <div class="error-msg">
                                                                <?php echo $errors["detail-1"] ?>
                                                              </div>
                                                              <i class="fas fa-exclamation-circle"></i>
                                                            </div>
                                                          <?php
                                                        }
                                                      ?>
                                                      <input 
                                                        type="text" 
                                                        value="<?php
                                                          $value = isset($_POST["detail-" . $index + 1]) ? $_POST["detail-" . $index + 1] : $detail;
                                                          echo $value; 
                                                          ?>" 
                                                        class="main-input"
                                                        autocomplete="off"
                                                        required
                                                        name="detail-<?php echo $index + 1 ?>">
                                                      <span><?php echo "Detail No. " . $index + 1 ?></span>
                                                    </div>
                                                  </div>
                                                <?php
                                              endforeach;
                                              if($_SERVER["REQUEST_METHOD"] == "POST"):
                                                foreach($new_added_details as $index=>$detail):
                                                  if(!empty($new_added_details[$index])):
                                                    ?>
                                                      <div class="the-input">
                                                        <div class="input-info">
                                                          <?php 
                                                            $detail_number = substr($index, strlen($index) - 1);
                                                            if(!empty($errors) && !empty($errors["detail-" . $detail_number])){
                                                              ?>
                                                                <div class="input-error">
                                                                  <div class="error-msg">
                                                                    <?php echo $errors["detail-" . $detail_number] ?>
                                                                  </div>
                                                                  <i class="fas fa-exclamation-circle"></i>
                                                                </div>
                                                              <?php
                                                            }
                                                          ?>
                                                          <input 
                                                            type="text" 
                                                            value="<?php
                                                              $value = isset($_POST[$index]) ? $new_added_details[$index] : $detail;
                                                              echo $value; 
                                                              ?>" 
                                                            class="main-input"
                                                            autocomplete="off"
                                                            required
                                                            name="detail-<?php echo $detail_number ?>">
                                                          <span>Detail No. <?php echo $detail_number ?></span>
                                                        </div>
                                                      </div>
                                                    <?php
                                                  endif;
                                                endforeach;
                                              endif;
                                            ?>
                                          </div>
                                        </div>
                                        <div class="submit-info">
                                          <div class="the-input">
                                            <div class="input-info">
                                              <input type="submit" value="Submit Request">
                                            </div>
                                          </div>
                                          <div class="the-input">
                                            <div class="input-info">
                                              <a href="experience.php">Cancel</a>
                                            </div>
                                          </div>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                <?php
                              endforeach;
                            ?>
                          </div>
                        </div>
                      </div>
                    <?php
                  }
                  else{
                    ?>
                    <div class="no-experience-to-show">
                      <i class="fas fa-file-alt"></i>
                      <h2>No Experience Found</h2>
                      <span>There is no experience to show at the moment.</span>
                      <span>This is becuase some experience are waiting for approval from khaled. Only approved experiences will be showed here.</span>
                      <a href="?a=new"><i class="fas fa-plus"></i> New Experience </a>
                    </div>
                    <?php
                  }
                }
                else{
                  ?>
                    <div class="settings">
                      <?php 
                        $previous_page = "../portfolio.php";
                        $content_title = "Cannot Add More";
                        include_once $template . "contentheader.php";
                      ?>
                      <div class="setting">
                        <div class="experience">
                          <?php 
                            if(isset($_COOKIE["EDITREQUESTSENT"])){
                              ?>
                                <div class="edit-request-sent">
                                  <i class="fas fa-check-circle"></i>
                                  <h2>Request Sent</h2>
                                  <span>Your request to edit the experience has been successfully sent to <strong>Khaled Ali Hayek</strong>. Check your inbox for request status.</span>
                                </div>
                              <?php
                            }
                          ?>
                          <div class="notice">
                            <div class="icon"><i class="fas fa-bell"></i></div>
                            <div class="text">
                              <h3>Total attempts exceeded</h3>
                              <h4>You have already submitted a project modification request more than three times. We limit your ability to use certain things on the Site. Wait until one of your requests is rejected or accepted so you can use one of these features again.</h4>
                            </div>
                          </div>
                          <div class="total-exceeded error-icon">
                            <i class="fas fa-times-circle"></i>
                            <h2>Come back later after one of your requests is approved or rejected.</h2>
                            <a href="experience.php">Go Back</a>
                          </div>
                      </div>
                    </div>
                  <?php 
                }
              }
              else{
                $auth = new Authentication($manager_logged_id);
                if($auth->isKhaled()){
                  ?>
                    <div class="setting">
                      <div class="experience">
                        <div class="notice">
                          <div class="icon"><i class="fas fa-bell"></i></div>
                          <div class="text">
                            <h3>Manage <strong>Khaled Ali Hayek</strong> Experience</h3>
                            <h4>Manage information about Khaled's experience. Upon completion of the work, the entered information will be sent to Khaled for approval. You will be notified about the request you have made. <a href="">Learn more</a></h4>
                          </div>
                        </div>
                        <?php 
                          // TODO show this only for khaled ali hayek 
                        ?>
                        <div class="notice">
                          <div class="icon notice-icon"><i class="fas fa-lock"></i></div>
                          <div class="text">
                            <h4>This is only visible to you.</h4>
                          </div>
                        </div>
                        <h2 class="form-title">Delete Experience</h2>
                        <div class="delete-my-exp">
                          <div class="filter-my-exp">
                            <div class="filter">
                              <div class="filter-options">
                                <h4>Filter list by</h4>
                                <div class="filter-item">
                                  <div class="search-list-for-term">
                                    <input type="text" placeholder="Project Type" autocomplete="off">
                                  </div>
                                  <span>Project Type</span>
                                  <div class="icon">
                                    <i class="fas fa-chevron-right"></i>
                                  </div>
                                </div>
                                <div class="filter-item">
                                  <div class="search-list-for-term">
                                    <input type="text" placeholder="Project Name" autocomplete="off">
                                  </div>
                                  <span>Project Name</span>
                                  <div class="icon">
                                    <i class="fas fa-chevron-right"></i>
                                  </div>
                                </div>
                                <div class="filter-item">
                                  <div class="search-list-for-term">
                                    <input type="text" placeholder="Project Place" autocomplete="off">
                                  </div>
                                  <span>Project Place</span>
                                  <div class="icon">
                                    <i class="fas fa-chevron-right"></i>
                                  </div>
                                </div>
                              </div>
                              <i class="fas fa-filter"></i>
                            </div>
                            <div class="sort-list-by">
                              <div class="sort-list">
                                Sort list by
                                <div class="sort-methods">
                                  <a href="" class="sort-item">
                                    <i class="fas fa-sort-alpha-down"></i>
                                    <div class="text">
                                      <span>First Added</span>
                                    </div>
                                  </a>
                                  <a href="" class="sort-item">
                                    <i class="fas fa-sort-alpha-down-alt"></i>
                                    <div class="text">
                                      <span>Latest Added</span>
                                    </div>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="my-exp-list">
                            
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php
                }
                else{
                  echo "cannot view this page";
                }
              }
            } 
          }
        ?>
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