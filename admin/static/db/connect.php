<?php 
  include $static . "db/config.php";
  
  try{
    $connect = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME . "", DBUSER, DBPASS);
  }
  catch(PDOException $error){
    echo $error->getMessage();
  }