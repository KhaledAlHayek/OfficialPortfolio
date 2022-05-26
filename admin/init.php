<?php 
  $directory = "";
  if(isset($sub_folder_directory)){
    if($sub_folder_directory){
      $directory = "../";
    }
    else{
      $directory = "";
    }
  }

  // Layout Route
  $css        = $directory . "layout/css/";
  $dist_css   = $directory . "layout/dist/css/";
  $dist_js    = $directory . "layout/dist/js/";
  $js         = $directory . "layout/js/";
  $fonts      = $directory . "layout/fonts/";
  $imgs       = $directory . "layout/images/";

  // Structure Route
  $template = $directory . "includes/templates/";
  $function = $directory . "includes/functions/";
  $language = $directory . "includes/language/";

  // Static Files
  $static = $directory . "static/";
  // Manager Class
  include_once $static . "Manager.php";

  // Include Main File
  include $function . "function.php"; // functions
  include $static . "db/connect.php"; // connect file

  $logged_manager = new Manager($connect);
  $logged_manager_token = isset($_SESSION["MANAGERTOKENID"]) ? $_SESSION["MANAGERTOKENID"] : "";
  if(!empty($logged_manager_token)){
    $logged_manager_data = $logged_manager->GetManagerData($logged_manager_token);
  }
  