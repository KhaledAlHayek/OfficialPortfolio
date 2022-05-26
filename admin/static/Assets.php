<?php

  class Authentication{
    private $manager_id;
    
    public function __construct($id) {
      $this->manager_id = $id;
    }

    public function isKhaled() {
      return $this->manager_id == 1; 
    }
  }