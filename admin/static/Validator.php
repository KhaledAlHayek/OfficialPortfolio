<?php 
  class Validator{
    private $data;
    private static $fields = [];
    private $errors = [];

    public function __construct($post_data, $form_fields) {
      $this->data = $post_data;
      foreach($form_fields as $field):
        array_push(self::$fields, $field);
      endforeach;
    }

    public function validata_form(){
      foreach(self::$fields as $field):
        if(!array_key_exists($field, $this->data)){
          $this->errors["missing key"] = "something went wrong with the data passed";
        }
        if($field === "email" || $field == "oldemail"){
          $this->validate_email($field);
        }
        else if($field === "password" || $field == "oldpassword"){
          $this->validate_password($field);
        }
        else if($field === "username" || $field == "oldusername"){
          $this->validate_username($field);
        }
        else if($field === "fullname" || $field == "oldfullname"){
          $this->validate_name($field);
        }
      endforeach;
      return $this->errors;
    }

    /* 
      validate_username()
      @param(form name), recieve a string as parameter which refers to the form input name
    */
    private function validate_username($form_name){
      $username = trim(htmlspecialchars($this->data[$form_name]));
      if(empty($username)){
        $this->add_error($form_name, "<strong>Username</strong> should not be empty");
      }
      else{
        if(!preg_match("/\w+/i", $username)){
          $this->add_error($form_name, "<strong>Username</strong> is invalid! Please give it another try.");
        }
      }
    }

    /* 
      validate_email()
      @param(form name), recieve a string as parameter which refers to the form input name 
    */
    private function validate_email($form_name){
      $email = trim(htmlspecialchars($this->data[$form_name]));
      if(empty($email)){
        $this->add_error($form_name, "<strong>Email</strong> should not be empty");
      }
      else{
        $sanitized_mail = filter_var($email, FILTER_SANITIZE_EMAIL);
        if(!preg_match("/\w+@\w+.(com|net|org|edu)/i", $sanitized_mail)){
          $this->add_error($form_name, "<strong>Email</strong> is invalid! Please give it another try.");
        }
      }
    }

    /*
      @param(form name), recieve a string as parameter which refers to the form input name
      password should match the following criteria
        : (a-zA-Z_) chars
        : 3 or more numbers 
        : 2 or more(!@#$%^&*) symbol
    */
    private function validate_password($form_name){
      $password = trim(htmlspecialchars($this->data[$form_name]));
      if(empty($password)){
        $this->add_error($form_name, "<strong>Password</strong> should not be empty.");
      }
      else{
        if(!preg_match("/\w+\d+\W+/i", $password)){
          $this->add_error($form_name, "<strong>Password</strong> is not valid.");
        }
      }
    }

    /*
      ! param(option) string, define what to validate
      ! if not passed any option, the function will validate full name instead
    */
    private function validate_name($form_name){
      $fullname = trim(htmlspecialchars($this->data[$form_name]));
      if(empty($fullname)){
        $this->add_error($form_name, "<strong>Fullname</strong> should not be empty.");
      }
      else{
        if(!preg_match("/[a-zA-Z]{3,}\s[a-zA-Z]{3,}\s[a-zA-Z]{3,}/i", $fullname)){
          $this->add_error($form_name, "<strong>Fullname</strong> is invalid. Please give it another try.");
        }
      }
    }

    private function add_error($key, $msg){
      $this->errors[$key] = $msg;
    } 
  }
?>