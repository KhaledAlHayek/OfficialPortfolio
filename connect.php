<?php   
  define("DBHOST", "localhost");
  define("DBNAME", "portfolio");
  define("DBUSER", "root");
  define("DBPASS", "");

  try{
    $connect = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME . "", DBUSER, DBPASS);
  }
  catch(PDOException $error){
    echo $error->getMessage();
  }