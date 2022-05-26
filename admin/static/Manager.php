<?php 
  class Manager {
    private $connect;
    
    public function __construct($connection){
      $this->connect = $connection;
    }

    /* 
      this function check if the manager is exist in our DB
      ? @param($token_id)
      returns:
        1 => if manager exist in the site
        0 => not found any manager with that token ID.
    */
    public function is_manager_exist($token_id){
      $stmt = $this->connect->prepare("SELECT * FROM manager WHERE TokenID = ?");
      $stmt->execute(array($token_id));
      return $stmt->rowCount() > 0;
    }

    /* 
      this function returns the token_id of the manager
      ? @param($id)
      returns:
        token_id => if found
        0 => not found any manager with that token.
    */
    public function manager_token_id($id){
      $stmt = $this->connect->prepare("SELECT TokenID FROM manager WHERE ID = ?");
      $stmt->execute(array($id));
      if($stmt->rowCount() == 0){
        return 0;
      }
      return $stmt->fetchColumn();
    }

    /* 
      this function add new manager to the site
      ? @param($fullname, $email, $password, $privileges)
      it generate new token for the manager to be added.
      after generating new token, it checks for any matches in db
      if found any match => generate_token() function rerun
      returns:
        1 => if manager successfully added to the site
        0 => failure
    */
    public function AddManager($fullname, $email, $password, $privileges){
      $stmt = $this->connect->prepare("INSERT 
                                        INTO 
                                          manager(Fullname, Email, Password, ApprovalID, AppliedDate, Privileges, TokenID)
                                        VALUES(:full, :email, :pass, 1, now(), :privileges, :tokenid)");
      $token_id = $this->generate_token();
      if($this->generate_new_token_if_exist($token_id)):
        $token_id = $this->generate_token();
      endif;
      $stmt->execute(array(
        "full"       => $fullname,
        "email"      => $email,
        "pass"       => $password,
        "privileges" => $privileges,
        "tokenid"    => $token_id
      ));
      return $stmt->rowCount() > 0;
    }

    /* 
      this function edit manager information
      ? @param($token_id, $fullname, $email, $password, $approved, $privileges)
      returns:
        1 => if manager information updated
        0 => otherwise
    */
    public function EditManager($token_id, $fullname, $email, $password, $approved, $privileges){
      $stmt = $this->connect->prepare("UPDATE 
                                          manager 
                                        SET 
                                          Fullname = ?, 
                                          Email = ?, 
                                          Password = ?, 
                                          ApprovalID = ?, 
                                          Privileges = ? 
                                        WHERE 
                                          TokenID = ?");
      $stmt->execute(array($fullname, $email, $password, $approved, $privileges, $token_id));
      return $stmt->rowCount() > 0;
    }

    /* 
      this function delete manager information from db
      ? @param($token_id): Defaults => $token_id = NULL
      returns:
        if $token_id = NULL: delete all managers data
          1 => if deleted all manager succeeded
          0 => failure.
        otherwise: delete single manager data according to $token_id.
          1 => if deleted single manager succeeded
          0 => failure
    */
    public function DeleteManager($token_id = NULL){
      if($token_id != NULL):
        $stmt = $this->connect->prepare("DELETE FROM manager WHERE TokenID = ?");
        $stmt->execute(array($token_id));
        return $stmt->rowCount() > 0;
      endif;
      $stmt = $this->connect->prepare("DELETE FROM manager");
      $stmt->execute();
      return $stmt->rowCount() > 0;
    }

    /*
      v1.0
      *
      this function retrieve manager data from database
      ? @param($token_id, $sort): Defaults => $token_id = NULL, $sort = "ASC"
      returns:
        if $token_id = NULL: returns all managers data
        otherwise: return specific manager data.
      *
      v2.0
      the function can retrieve ? number of rows || data
      @param( `v1.0 params`, $limits = 10)
      by default the function gets 10 rows from db
    */
    public function GetManagerData($token_id = NULL, $sort = "ASC", $limit = 10, $only_approved = false, $only_disapproved = false){
      $get_all_managers_data = $token_id != NULL ? false : true;
      if($get_all_managers_data){
        if($only_approved && !$only_disapproved):
          $stmt = $this->connect->prepare("SELECT * FROM manager WHERE ApprovalID = 1 ORDER BY ID {$sort} LIMIT {$limit}");
        endif;
        if($only_disapproved && !$only_approved):
          $stmt = $this->connect->prepare("SELECT * FROM manager WHERE ApprovalID = 0 ORDER BY ID {$sort} LIMIT {$limit}");
        endif;
        if(!$only_approved && !$only_disapproved):
          $stmt = $this->connect->prepare("SELECT * FROM manager ORDER BY ID {$sort} LIMIT {$limit}");
        endif;
        $stmt->execute();
        $all_data = $stmt->fetchAll();
        return $all_data;
      }
      else{
        $stmt = $this->connect->prepare("SELECT * FROM manager WHERE TokenID = ?");
        $stmt->execute(array($token_id));
        $manager_data = $stmt->fetch();
        return $manager_data;
      }
    }
    
    /* 
      this function retrieve a total of managers exist in the site.
      ? @param() no param found.
      returns: number
        total managers exist in the db
    */
    public function total_managers(){
      $stmt = $this->connect->prepare("SELECT COUNT(ID) FROM manager");
      $stmt->execute();
      return $stmt->fetchColumn();
    }

    /*
    this function check for manager data in the db
    ? @param($data_key, $data_value)
    return token_id for that manager if exist
    * expected output if ("Email", "email@example.com") passed to this function
      grap all the data where $data_key = $data_value
      if found
        returns: manager tokenID
      otherwise, 
        returns: 0
    */
    public function login($data_key, $data_value){
      $stmt = $this->connect->prepare("SELECT * FROM manager WHERE {$data_key} = ? AND ApprovalID = 1");
      $stmt->execute(array($data_value));
      $data = $stmt->fetch();
      if($stmt->rowCount() == 0){
        return 0;
      }
      return $data["TokenID"];
    }

    /*
    this function updates manager specific data values
    ? @param([$column_name, $value, $token_id])
    returns:
      true: if manager data updated;
      false: if no changes applied
    */
    public function update_key_value($key, $value, $token_id){
      $stmt = $this->connect->prepare("UPDATE manager SET {$key} = ? WHERE TokenID = ? ");
      $stmt->execute([$value, $token_id]);
      return $stmt->rowCount() > 0;
    } 

    /* 
      this function generate a token for managers
      ? @param() no param found
      returns:
        token id for manager. A total of 25 char combined of letters[lower + upper], digits and symbols
    */
    private function generate_token(){
      $token_length = 25;
      $token = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@$%^*()_~";
      $token_id = "";
      for($i = 0; $i < $token_length; $i++):
        $token_id .= $token[rand(0, strlen($token) - 1)];
      endfor;
      return $token_id;
    }

    /* 
      this function generate a new token for managers if there old ones match the others token
      ? @param($token) the token generated from generate_token(), check in the db for any matches
      returns:
        if found any match: TRUE
        if not found any match: FALSE
    */
    private function generate_new_token_if_exist($old_token){
      $stmt = $this->connect->prepare("SELECT TokenID FROM manager");
      $stmt->execute();
      $tokens = $stmt->fetchAll();
      foreach($tokens as $token):
        if($old_token === $token):
          return $old_token === $token;
        endif;
      endforeach;
      return false;
    }

  }