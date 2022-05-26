<?php 

  class Shortcuts{

    private $manager_id;
    private $connect;

    public function __construct($id, $connect){
      $this->manager_id = $id;
      $this->connect = $connect;
    }
    public function isShortcutExist($key, $value){
      $stmt = $this->connect->prepare("SELECT ID FROM shortcuts WHERE {$key} = ?");
      $stmt->execute([$value]);
      return $stmt->fetchColumn();
    }
    public function myShortcuts() {
      $stmt = $this->connect->prepare("SELECT * FROM shortcuts WHERE manager_id = ?");
      $stmt->execute([$this->manager_id]);
      return $stmt->fetchAll();
    }

    public function addShortcut($name, $link_to, $description){
      $stmt = $this->connect->prepare("INSERT INTO 
                                        shortcuts(Name, Linkto, Description, manager_id) 
                                      VALUES(:name, :link, :desc, :id)");
      $stmt->execute(array(
        "name" => $name,
        "link" => $link_to,
        "desc" => $description,
        "id"   => $this->manager_id
      ));
      return $stmt->rowCount() > 0;
    }
    public function removeShortcut($id){
      $stmt = $this->connect->prepare("DELETE FROM shortcuts WHERE ID = ?");
      $stmt->execute([$id]);
      return $stmt->rowCount() > 0;
    }
    public function editShortcut($id, $name, $link, $description){
      $stmt = $this->connect->prepare("UPDATE 
                                        shortcuts 
                                      SET 
                                        Name = ?, 
                                        Linkto = ?, 
                                        Description = ? 
                                      WHERE 
                                        ID = ? 
                                      AND
                                        manager_id = ?");
      $stmt->execute([$name, $link, $description, $id, $this->manager_id]);
      return $stmt->rowCount() > 0;
    }
    public function totalShortcuts(){
      $stmt = $this->connect->prepare("SELECT COUNT(ID) FROM shortcuts WHERE manager_id = ?");
      $stmt->execute([$this->manager_id]);
      return $stmt->fetchColumn();
    }
  }

?>