<?php 

  include "connect.php";

  // Layout Route
  $css        = "layout/css/";
  $dist_css   = "layout/dist/css/";
  $dist_js    = "layout/dist/js/";
  $js         = "layout/js/";
  $fonts      = "layout/fonts/";
  $imgs       = "layout/images/";

  // Structure Route
  $template = "includes/templates/";
  $function = "includes/functions/";
  $language = "includes/language/";

  // Include Main File
  include $function . "functions.php";
  if(isset($_SESSION["ARABICLANGUAGE"])){
    include_once $language . "ar.php";
  }
  else{
    include_once $language . "en.php";
  }