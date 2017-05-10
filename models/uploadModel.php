<?php 
class uploadModel extends Model {
	
    function __construct() {
        parent::__construct();
    }

    public function upload($sID)
    {
        if(isset($_POST['submit'])) {
        $description = (trim(nl2br($_POST['desc'])));

        $type =  strtolower(pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION));
        $imageHash = hash('adler32', time() . mt_rand()).".".$type; //adler32 voor quick hash

        if(in_array($type, array("jpg","jpeg","gif","png"))) 
        {
            if($_FILES['img']['size'] < 5000000) 
            {
                if(is_uploaded_file($_FILES['img']['tmp_name']))
                {
                    move_uploaded_file($_FILES['img']['tmp_name'],"assets/images/". $imageHash);
                    $stm = $this->db->prepare("INSERT INTO user_images (user_id, image_url, upload_date, image_description) VALUES (:id, :imageUrl, UNIX_TIMESTAMP(), :imageDesc)");
                    $stm->execute([
                        ':id' => $sID,
                        ':imageUrl' => $imageHash,
                        ':imageDesc' => $description
                    ]);
                    header('location: '.SITE_URL.'feed');

                } 
                else 
                {	
                    return "Sorry, uw foto is niet gewijzigd";       
                }
            } 
            else 
            {	
                return "File is te groot maximaal 5mb"; 
            } 
        }
        else 
        {
            return "Alleen JPG, JPEG, GIF OF PNG mogen geupload worden";
        }
    } 
    }
}// class