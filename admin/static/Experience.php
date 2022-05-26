<?php 
  class Experience{
    protected $connect;
    protected $manager_id;

    public function __construct($connect, $manager_id) {
      $this->connect = $connect;
      $this->manager_id = $manager_id;
    }

    public function performExpAction($type, $data, $details){
      $possible_actions = ["add", "edit", "delete"];
      if(!in_array($type, $possible_actions)){
        $msg = "";
        foreach($possible_actions as $action):
          $msg .= $action . ", ";
        endforeach;
        throw new Error("Error: Action is unknown. Cannot proceed, please make sure the action passed is in the following list. [" . $msg . "]");
      }
      if(!is_array($data)){
        $type = gettype($data);
        throw new Error("Error: Cannot procceed. data passed should be of type array. " . $type . " passed instead.");
      }
      if($type == "add"){
        if($this->addExperience($data)):
          $id = $this->experienceID($data[1]);
          $add_details = $this->experienceDetails($id, $details);
          if($add_details):
            $this->changeExperienceAppearence($id);
            return $id;
          endif;
        endif;
      }
      else if($type == "edit"){
        return $this->editExperience($data, $details);
      }
      else{
        return $this->deleteExperience($data);
      }
    }
    
    /*
      this function graps all experience data from db
      ? @param($sort, $limit) => optional
        if not passed any
          $sort = ASC
          $limit = 10
      returns: 
        experience data
      throws error if:
        $sort param is not in this list ["asc", "desc", "ASC", "DESC"] 
        $limit is equal 0
    */
    public function experienceData($sort = "ASC", $limit = 10){
      $sort_methods = ["asc", "desc", "ASC", "DESC"];
      if(!in_array($sort, $sort_methods)){
        $msg = "";
        foreach($sort_methods as $method):
          $msg .= $method . ",";
        endforeach; 
        throw new Error("Error: cannot retrieve data for the sort method passed. Make sure sort method is in the following list. [" . $msg . "]");
      }
      if($limit == 0){
        throw new Error("Error: cannot proceed. Cannot retrieve " . $limit . " experience. Make sure the number is greater than or equal to 1.");
      }
      $stmt = $this->connect->prepare("SELECT * FROM experience WHERE appearence = 1 ORDER BY ID {$sort} LIMIT {$limit}"); 
      $stmt->execute();
      return $stmt->fetchAll();
    }

    /*
      this function graps single experience data from db
      ? @param() => no param needed
      returns: 
        single experience data
    */
    public function singleExpData($id){
      $data = [];
      $stmt = $this->connect->prepare("SELECT * FROM experience WHERE ID = ?"); 
      $stmt->execute([$id]);
      $exp_data = $stmt->fetch();
      $exp_details = $this->getExperienceDetails($id);
      array_push($data, $exp_data);
      array_push($data, $exp_details);
      return $data;
    }
    
    public function appearenceStatus($id){
      $stmt = $this->connect->prepare("SELECT appearence FROM experience WHERE ID = ?");
      $stmt->execute([$id]);
      return $stmt->fetchColumn();
    }

    private function changeExperienceAppearence($id) {
      $stmt = $this->connect->prepare("UPDATE experience SET appearence = 1 WHERE ID = ?");
      $stmt->execute([$id]);
      return $stmt->rowCount() > 0;
    }
    /*
      this function graps the total experiences
      ? @param() => no param needed
      returns: 
        total
    */
    public function totalExperiences(){
      $stmt = $this->connect->prepare("SELECT COUNT(ID) FROM experience"); 
      $stmt->execute();
      return $stmt->fetchColumn();
    }

    protected function getExperienceDetails($id){
      $stmt = $this->connect->prepare("SELECT Details FROM 
                                        projectdetails 
                                      INNER JOIN 
                                        experience 
                                      ON 
                                        experience.ID = projectdetails.exp_id 
                                      WHERE 
                                        projectdetails.exp_id = ?");
      $stmt->execute([$id]);
      return $stmt->fetch();
    }
    /*
      this function add new experience to the site
      ? @param($data) => array of data to execute
      array should be sorted as db columns sorted.
      returns:
        0 => if the manager does not have permissions to add experience
        true => added the experience
        false, otherwise.
    */
    protected function addExperience($data){
      if($this->checkBeforeProcessing() != 1){
        return 0;
      }
      $stmt = $this->connect->prepare("INSERT INTO 
                                        experience(ProjectType, ProjectName, ProjectPlace, Modified, Projectstatus, appearence)
                                      VALUES(:type, :name, :place, :mod, :status, 0)");
      $stmt->execute([
        "type"   => $data[0],
        "name"   => $data[1],
        "place"  => $data[2],
        "mod"    => $data[3],
        "status" => $data[4]
      ]);
      return $stmt->rowCount() > 0;
    }

    private function experienceID($name) {
      $stmt = $this->connect->prepare("SELECT ID FROM experience WHERE ProjectName = ?");
      $stmt->execute([$name]);
      return $stmt->rowCount() > 0 ? $stmt->fetchColumn() : "";
    }

    /*
      this function is to edit an existing experience
      ? @param($data, $new_details) => array of data, details for this project
      array should be sorted as db columns sorted. id in the last index of the array
      returns:
        0 => if the manager does not have permissions to add experience
        true => modified
        false, otherwise.
    */
    protected function editExperience($data, $new_details){
      if($this->checkBeforeProcessing() != 1){
        return 0;
      }
      $stmt = $this->connect->prepare("UPDATE 
                                        experience 
                                      SET 
                                        ProjectType = ?, 
                                        ProjectName = ?, 
                                        ProjectPlace = ?, 
                                        Modified = ?, 
                                        Projectstatus = ?,
                                        appearence = 0
                                      WHERE 
                                        ID = ?");
      $stmt->execute($data);
      $id = $data[count($data) - 1];
      $edit_details = $this->editExperienceDetails($id, $new_details);
      return $edit_details;
    }

    private function editExperienceDetails($id, $new_details){
      if($this->checkBeforeProcessing() != 1){
        return 0;
      }
      $stmt = $this->connect->prepare("UPDATE 
                                        projectdetails 
                                      SET 
                                        Details = ? 
                                      WHERE 
                                        exp_id = ?");
      $stmt->execute([$new_details, $id]);
      return $stmt->rowCount() > 0;
    }

    /*
      this function is to remove experience from the site
      ? @param($data) => array containing the id of the experience
      returns:
        0 => if the manager does not have permissions to add experience
        true => deleted
        false, otherwise.
    */
    protected function deleteExperience($data){
      if($this->checkBeforeProcessing() != 1){
        return 0;
      }
      $stmt = $this->connect->prepare("DELETE FROM experience WHERE ID = ?");
      $stmt->execute($data);
      return $stmt->rowCount() > 0;
    }

    protected function experienceDetails($exp_id, $details){
      $stmt = $this->connect->prepare("INSERT INTO 
                                        projectdetails(exp_id, Details) 
                                      VALUES(:id, :details)");
      $stmt->execute([
        "id"      => $exp_id,
        "details" => $details
      ]);
      return $stmt->rowCount() > 0;
    }
    /* 
      this function check if the manager who want to add the experience is approved.
      ? @param() => no param needed.
      returns if the manager is approved:
        id of the manager
        otherwise null
    */
    private function isManagerVerified(){
      $stmt = $this->connect->prepare("SELECT ID FROM manager WHERE ID = ? AND ApprovalID = 1");
      $stmt->execute([$this->manager_id]);
      return $stmt->fetchColumn();
    }

    /* 
      this function returns the permissions for the current manager who want to make changes
      ? @param() => no param needed.
      returns:
        manager permission value
        otherwise null
      possible returns values
      [
        "0": read only permission, no permissions for write option
        "1": read write permission
        "2": read, but need approval for write permissions
      ]
    */
    private function managerPermissions(){
      $stmt = $this->connect->prepare("SELECT Privileges FROM manager WHERE ID = ? AND ApprovalID = 1");
      $stmt->execute([$this->manager_id]);
      return $stmt->fetchColumn();
    }

    /*
      this function check for manager status, if he has the ability to write
      ? @param() => no param needed
      returns: 
        either,
          0 => if manager is not approved
        nor,
          0 => if manager doest have read write permissions
        1 => if manager is approved and have full permissions
    */
    private function checkBeforeProcessing(){
      if(empty($this->isManagerVerified())){
        return 0;
      }
      if($this->managerPermissions() != 1){
        return 0;
      }
      return 1;
    }
  }
?>