<?php 
  ob_start();
  session_start();
  if(isset($_SESSION["MANAGERTOKENID"])){
    $page_title = "Experience";
    $js_file = "experiencedetails-min.js";
    $sub_folder_directory = true; // should come before init file
    include "../init.php";
    $manager_logged_id   = $logged_manager_data["ID"];
    $manager_permissions = $logged_manager_data["Privileges"];
    $manager_approval    = $logged_manager_data["ApprovalID"];
    include $template . "header.php";
    include_once $template . "pageheader.php";
    include_once $static . "Experience.php";
    include_once $static . "ExperienceRequest.php";
    include_once $static . "Assets.php";

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
            $exp_data = isset($_GET["d"]) ? $_GET["d"] : "";
            $data = explode("|", $exp_data);
            if(!empty($exp_data)){
              if($_SERVER["REQUEST_METHOD"] == "POST"){
                $details = $_POST;
                $_SESSION["DETAILNUMBER1"] = $_POST["detail-1"];
                $_SESSION["DETAILNUMBER2"] = $_POST["detail-2"];
                $_SESSION["DETAILNUMBER3"] = $_POST["detail-3"];
                $total_details = count($_POST);
                $counter = 0;
                $all_details = "";
                foreach($details as $detail):
                  if(empty($detail)){    
                    setcookie("NOTVALIDDETAILS", "Some details are empty. Please fill all the fields", strtotime("+ 5 seconds"));
                    redirect_within($_SERVER["PHP_SELF"] . "?d=" . implode("|", $exp_data) . "");
                  }
                  if(!empty($detail)){
                    $all_details .= $detail . "%";
                    $counter++;
                    if($total_details == $counter):
                      $auth = new Authentication($manager_logged_id);
                      if($auth->isKhaled()):
                        echo "add the experience without any request.";
                        $experience = new Experience($connect, $manager_logged_id);
                        $add_experience = $experience->performExpAction("add", $data, $all_details);
                        setcookie("PREVIEWEXPERIENCE", $add_experience, strtotime("+ 1 hour"));
                        unset($_SESSION["DETAILNUMBER1"]);
                        unset($_SESSION["DETAILNUMBER2"]);
                        unset($_SESSION["DETAILNUMBER3"]);
                        redirect_within("preview.php");
                      else:
                        $request = new ExperienceRequest($connect, $manager_logged_id);
                        $add_experience_request = $request->experienceRequest("add", $data, $all_details);
                        if(!empty($add_experience_request)):
                          setcookie("PREVIEWEXPERIENCE", $add_experience_request, strtotime("+ 1 hour"));
                          unset($_SESSION["DETAILNUMBER1"]);
                          unset($_SESSION["DETAILNUMBER2"]);
                          unset($_SESSION["DETAILNUMBER3"]);
                          redirect_within("preview.php");
                        endif;
                      endif;
                    endif;
                  }
                endforeach;
              }
              ?>
                <div class="setting">
                  <div class="experience">
                    <div class="notice">
                      <div class="icon"><i class="fas fa-bell"></i></div>
                      <div class="text">
                        <h3>All details fields are required. You must add at least 3 details for a single project.</h3>
                        <h4>Manage information about Khaled's experience. Upon completion of the work, the entered information will be sent to Khaled for approval. You will be notified about the request you have made. <a href="">Learn more</a></h4>
                      </div>
                    </div>
                    <h2 class="form-title">Complete Adding <?php echo "<strong>" . $exp_data[1] . "</strong>" ?> Project Details</h2>
                    <div class="details-experience exp">
                      <?php 
                        if(isset($_COOKIE["NOTVALIDDETAILS"])){
                          ?>
                            <div class="not-valid">
                              <span><?php echo $_COOKIE["NOTVALIDDETAILS"] ?></span>
                            </div>
                          <?php
                        }
                      ?>
                      <div class="add-new-details">
                        <i class="fas fa-plus"></i> <span>New Detail</span>
                      </div>
                      <form action="<?php echo $_SERVER["PHP_SELF"] . "?d=" . implode("|", $data) . "" ?>" method="POST">
                        <div class="inputs">
                          <div class="details-input">
                            <div class="the-input" data-key="1">
                              <input 
                                type="text" 
                                name="detail-1" 
                                autocomplete="off"
                                value="<?php $val = isset($_SESSION["DETAILNUMBER1"]) ? $_SESSION["DETAILNUMBER1"] : ""; echo $val; ?>" 
                                required>
                              <span>Project Detail-1</span>
                            </div>
                          </div>
                          <div class="details-input">
                            <div class="the-input" data-key="2">
                              <input 
                                type="text" 
                                name="detail-2" 
                                autocomplete="off"
                                value="<?php $val = isset($_SESSION["DETAILNUMBER2"]) ? $_SESSION["DETAILNUMBER2"] : ""; echo $val; ?>" 
                                required>
                              <span>Project Detail-2</span>
                            </div>
                          </div>
                          <div class="details-input">
                            <div class="the-input" data-key="3">
                              <input 
                                type="text" 
                                name="detail-3" 
                                autocomplete="off"
                                value="<?php $val = isset($_SESSION["DETAILNUMBER3"]) ? $_SESSION["DETAILNUMBER3"] : ""; echo $val; ?>" 
                                required>
                              <span>Project Detail-3</span>
                            </div>
                          </div>
                        </div>
                        <div class="submit">
                          <input type="submit" value="Submit request and preview" class="submit-btn">
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
                <div class="setting">
                  <div class="experience">
                    <div class="notice">
                      <div class="icon"><i class="fas fa-bell"></i></div>
                      <div class="text">
                        <h3>Request is not valid.</h3>
                        <h4>If you encounter this error, this means that something went wrong with the request you have made to reach this page. May be the header information changed.</h4>
                      </div>
                    </div>
                    <h2 class="form-title">Something went wrong</h2>
                    <div class="get-request-invalid">
                      <i class="fas fa-exclamation-triangle"></i>
                      <h2>We cannot show you more details in this page.</h2>
                      <a href="./experience.php">Go Back</a>
                    </div>
                  </div>
                </div>
              <?php
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