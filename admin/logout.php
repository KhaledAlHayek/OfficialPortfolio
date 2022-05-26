<?php 

  session_start();
  include_once "init.php";
  unset($_SESSION["MANAGERTOKENID"]);
  redirect_within("./adminlogin.php");