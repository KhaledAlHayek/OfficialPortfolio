<?php 

  /*
    v1
    function set_page_title() 
    @param: no param
    set the title dynamically of the page, by depending on [$page_title] variable
    before including ["init.php"] file, you should declare [$page_title] variable
  */
  function set_page_title() {
    global $page_title;
    if(isset($page_title)){
      echo $page_title;
    }
    else{
      echo "Khaled Hayek Portfolio";
    }
  }

  /* 
    v1 
    function to redirect the user to a specfic page
    @param($url = NULL, $seconds = 0)
    if $url not passed, the function will redirect to the same page
  */
  function redirect_within($url = NULL, $seconds = 0){
    $url = $url === NULL ? $_SERVER["PHP_SELF"] : $url;
    header("refresh:" . $seconds . ";url=" . $url . "");
    exit();
  }