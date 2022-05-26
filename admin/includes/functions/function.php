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

  /* 
    v1 
    function back() redirect the user to the previous page
    @param(): no pararm
    return true if $_SERVER["HTTP_REFERER"] found, otherwise false.
    if false it depends on the global variable $previous_page to redirect the user.
  */
  function back(){
    global $previous_page;
    $url = isset($_SERVER["HTTP_REFERER"]) && !empty($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : "";
    if(!empty($url)):
      // header("location: " . $url . "");
      return true;
    endif;
    // header("location: " . $previous_page . "");
    return false;
  }