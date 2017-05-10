<?php 
class userModel extends Model {
	
    function __construct() {
        parent::__construct();
    }
	public function verified($username = false) {
		
		$stmt =  $this->db->prepare("SELECT verified_user FROM users WHERE username = :username");
		$stmt->execute([':username' => $username]);
		
		return $stmt->fetch(PDO::FETCH_ASSOC);
		
	}
	public function checkUserExists($username = false) {

		// SELECT USERS WAAR USERNAME = $USERNAME
		$stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
		$stmt->execute([':username' => $username]);
		
		if($stmt->rowCount() > 0) {
			
			return true;
			
		} else {
			
			return false;
			
		}
		
	}
    public function myPosts($id)
    {
        $images = null;
		
        $stmt = $this->db->prepare("SELECT * FROM user_images WHERE user_id = :id ORDER BY upload_date DESC");
        $stmt->execute([':id' => $id]);
		
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
		
        foreach($result as $row) {
            $images .= '
			
            <li>
                <a href="'.SITE_URL.'assets/images/'.$row['image_url'].'">
					<div class="imageBox">
						<img src="'.SITE_URL.'assets/images/'.$row['image_url'].'" alt="">
					</div>
                </a>
            </li>';
        }	
		
        return $images;
    }
    public function myPostsCount($id)
    {
        $stmt = $this->db->prepare("SELECT COUNT(user_id) FROM user_images WHERE user_id = :id");
        $stmt->execute([':id' => $id]);
        $rowCount = (int) $stmt->fetchColumn();
        
        if($rowCount == 1) {
            return $rowCount." bericht";	
        }
        else
        {
            return $rowCount." berichten";
        }
        
    }
    
    public function myFollowingCount($id = false)
    {
        $stmt = $this->db->prepare("SELECT COUNT(following_id) FROM user_following WHERE user_id = :id");
        $stmt->execute([':id' => $id]);
        $rowCount = (int) $stmt->fetchColumn();
   
        return $rowCount." volgend";		
    }
    
    public function myFollowersCount($id = false)
    {
        $stmt = $this->db->prepare("SELECT COUNT(user_id) FROM user_following WHERE following_id = :id");
        $stmt->execute([':id' => $id]);
        $rowCount = (int) $stmt->fetchColumn();
        
        if($rowCount == 1) {
            return $rowCount." volger";	
        }
        else
        {
            return $rowCount." volgers";
        }
    }
    public function otherProfileUserinfo($username = false) {
        
        $stm =  $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $stm->execute([':username' => $username]);
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        
        return $result;
    }
    public function otherPosts($username)
    {
        $stm =  $this->db->prepare("SELECT id FROM users WHERE username = :username");
        $stm->execute([':username' => $username]);
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        
        $images = null;
        $stmt = $this->db->prepare("SELECT * FROM user_images WHERE user_id = :id ORDER BY upload_date DESC");
        $stmt->execute([':id' => $result['id']]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
         foreach($result as $row) {
            $images .= '
            <li>
                <a href="'.SITE_URL.'assets/images/'.$row['image_url'].'">
					<div class="imageBox">
						<img src="'.SITE_URL.'assets/images/'.$row['image_url'].'" alt="">
					</div>
                </a>
            </li>';
        }	
         return $images;
       
    }
    public function otherPostsCount($username)
    {
        $stm =  $this->db->prepare("SELECT id FROM users WHERE username = :username");
        $stm->execute([':username' => $username]);
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        
        $stmt = $this->db->prepare("SELECT COUNT(user_id) FROM user_images WHERE user_id = :id");
        $stmt->execute([':id' => $result['id']]);
        $rowCount = (int) $stmt->fetchColumn();
        
        if($rowCount == 1) {
            return $rowCount." bericht";	
        }
        else
        {
            return $rowCount." berichten";
        }
       
    }
    public function otherFollowingCount($username)
    {
        $stm =  $this->db->prepare("SELECT id FROM users WHERE username = :username");
        $stm->execute([':username' => $username]);
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        
        $stmt = $this->db->prepare("SELECT COUNT(following_id) FROM user_following WHERE user_id = :id");
        $stmt->execute([':id' => $result['id']]);
        $rowCount = (int) $stmt->fetchColumn();
   
        return $rowCount." volgend";		
       
    }
    public function otherFollowersCount($username)
    {
        $stm =  $this->db->prepare("SELECT id FROM users WHERE username = :username");
        $stm->execute([':username' => $username]);
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        
        $stmt = $this->db->prepare("SELECT COUNT(user_id) FROM user_following WHERE following_id = :id");
        $stmt->execute([':id' => $result['id']]);
        $rowCount = (int) $stmt->fetchColumn();
        
        if($rowCount == 1) {
            return $rowCount." volger";	
        }
        else
        {
            return $rowCount." volgers";
        }
       
    }
    public function followCheck($username, $sID)
    {
        $stm =  $this->db->prepare("SELECT id FROM users WHERE username = :username");
        $stm->execute([':username' => $username]);
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        
        $stmt = $this->db->prepare("SELECT COUNT(following_id) FROM user_following WHERE user_id = :sid AND  following_id = :id");
        $stmt->execute([':sid' => $sID, ':id' => $result['id']]);
        $rowCount = (int) $stmt->fetchColumn();
        
        if($rowCount == 1)
        {
            return $follow = true;
        }
        else
        {   
            return $follow = false;
        }
    }
}// class









if(isset($_POST['submit'])) {
$projectId = $_POST['project'];

}