<?php
  include_once "request/request.php";

  class Request{
    private $manager_id;
    private $connect;

    public function __construct($connect, $id){
      $this->connect = $connect;
      $this->manager_id = $id;
    }

    public function totalRequestsByManager($request_type) {
      $possible_types = [ADDACTION, EDITACTION, DELETEACTION];
      if(!in_array($request_type, $possible_types)){
        $msg = "[" . ADDACTION . " " . EDITACTION . " " . DELETEACTION . "]";
        throw new Error("Error: please specify the type of request that you want to grab. make sure its in the following list{$msg}");
      } 
      $stmt = $this->connect->prepare("SELECT COUNT(ID) FROM requests WHERE manager_id = ? AND RequestAction = ?");
      $stmt->execute([$this->manager_id, $request_type]);
      return $stmt->fetchColumn();
    }
  }