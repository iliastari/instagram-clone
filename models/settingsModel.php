<?php 

class settingsModel extends Model {
	
	function __construct() {
            parent::__construct();
	}
	
	public function settingsEdit($sID = false) 
    {
		if(isset($_POST['submit'])) {
	
	$stmt = $this->db->prepare("SELECT * FROM users WHERE id = :sid");
	$stmt->execute([':sid' => $sID]);
	
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$type = strtolower(pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION));
	$fullname = hash('adler32', time() . mt_rand()).".".$type; //adler voor quick hash

	$bio = $_POST['bio'];
	
	if($bio !== $row['profile_bio']) {
		
		$stmt = $this->db->prepare("UPDATE users SET profile_bio = :bio WHERE id = :sid");
		$stmt->execute([':bio' => $bio, ':sid' => $sID]);
		redirect("user/".Session::get('username'));
		
	}
	if(!empty($_FILES['img']['name'])) {
	if(in_array($type, array("jpg","jpeg","gif","png"))) {
		// 5MB
		if($_FILES['img']['size'] < 5000000) {

			if(is_uploaded_file($_FILES['img']['tmp_name'])) {
				
				move_uploaded_file($_FILES['img']['tmp_name'], "assets/images/profile/" . $fullname);
				$stmt = $this->db->prepare("UPDATE users SET profile_image = :image WHERE id = :sid");
				$stmt->execute([':image' => $fullname, ':sid' => $sID]);
				redirect("user/".Session::get('username'));
				$row['profile_image'] = $fullname;
				
			} else {
				
				return "Sorry, uw foto is niet gewijzigd";
				
			}
	    } else {
			
		 return "File is te groot maximaal 5mb";
		 
	    } 
	} else {
		
		return "Alleen JPG, JPEG, GIF OF PNG mogen geupload worden";
		
	}
}

	if(empty($_FILES['img']['name']) && $bio == $row['profile_bio']) {
		return "U heeft niks veranderd";
	}
}
	}	
}