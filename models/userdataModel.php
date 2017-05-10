<?php 

class userdataModel extends Model {
	
	function __construct() {
            parent::__construct();
	}
	// uit de controller geroepen met $this->model->user(Session::get('id'));
	public function userInfo($sID) 
        {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->execute([':id' => $sID]);
            $result = $stmt->fetch();	
            return $result;	
	}	
}