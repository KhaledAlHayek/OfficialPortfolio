<?php 
  include_once "request/request.php";

  class ExperienceRequest extends Experience{
    public function experienceRequest($action, $data, $details = NULL) {
      if(!is_array($data)):
        $type = gettype($data);
        throw new Error("Error. Make sure the data passed is of type array. {$type} passed to the function instead.");
      endif;
      switch($action):
        case ADDACTION:
          if(!$details):
            throw new Error("Error: experience details not found. Make sure to pass the details related to the experience.");
          endif;
          return $this->addExperienceRequest($data, $details);
        case EDITACTION:
          return $this->editExperienceRequest($data, $details);
        case DELETEACTION:
          return $this->deleteExperienceRequest();
        default:
          throw new Error("Error. Cannot proceed your request. Make sure the action passed to the function is in the following list [" . ADDACTION . " . " . EDITACTION . " . " . DELETEACTION . "]");
        return;
      endswitch;
    }

    /* 
      this function is to add new experience request[add exp]
      ? @param($data) => array of data to execute
      returns:
        true => added the experience with the request
        0 otherwise => failure
    */
    private function addExperienceRequest($data, $details) {
      $add_experience = parent::addExperience($data);
      if($add_experience):
        $exp_id = $this->getID("experience", "ID", "ProjectName", $data[1]);
        $add_details = parent::experienceDetails($exp_id, $details);
        if($add_details):
          $stmt = $this->connect->prepare("INSERT INTO 
                                          requests(RequestName, exp_id, manager_id, RequestAction) 
                                        VALUES(:name, :expid, :managerid, :action)");
          $stmt->execute([
            "name"      => EXPERIENCE,
            "expid"     => $exp_id,
            "managerid" => $this->manager_id,
            "action"    => ADDACTION
          ]);
          return $exp_id;
        endif;
      endif;
      return 0;
    }
    private function editExperienceRequest($data, $new_details) {
      $edit_result = parent::editExperience($data, $new_details);
      if($edit_result):
        $stmt = $this->connect->prepare("INSERT INTO 
                                          requests(RequestName, exp_id, manager_id, RequestAction) 
                                        VALUES(:name, :expid, :managerid, :action)");
        $stmt->execute([
          "name"      => EXPERIENCE,
          "expid"     => $data[count($data) - 1],
          "managerid" => $this->manager_id,
          "action"    => EDITACTION
        ]);
        return $stmt->rowCount() > 0;
      endif;
    }
    private function deleteExperienceRequest() {

    }
    private function getID($table, $column, $key, $value){
      $stmt = $this->connect->prepare("SELECT {$column} FROM {$table} WHERE {$key} = ?");
      $stmt->execute([$value]);
      return $stmt->fetchColumn();
    }

    public function totalRequests($id) {
      $stmt = $this->connect->prepare("SELECT COUNT(ID) FROM requests WHERE exp_id IS NOT NULL AND manager_id = ? AND RequestAction = ?");
      $stmt->execute([$id, "add"]);
      return $stmt->fetchColumn();
    }
  }
?>