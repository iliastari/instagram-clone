<?php 
class feedModel extends Model {
	
	function __construct() {
            parent::__construct();
	}
        public function followUser($sID)
        {
            AjaxOnly();
            //$userId = $_POST['uid']; // Sessie gebruiker
            $userTwoId = $_POST['utid']; // wie gebruiker wilt volgen
            
            $stmt = $this->db->prepare("SELECT COUNT(following_id) FROM user_following WHERE user_id = :sid AND  following_id = :id");
            $stmt->execute([':sid' => $sID, ':id' => $userTwoId]);
            $rowCount = (int) $stmt->fetchColumn();
            
            if($rowCount == 0) 
            {
                $stm = $this->db->prepare("INSERT INTO user_following (user_id, following_id) VALUES (:sid, :id)");
                $stm->execute([':sid' => $sID, ':id' => $userTwoId]);
                
                $ssstmt = $this->db->prepare("INSERT INTO user_notif (user_id, user_two_id,date,activity) VALUES (:userId, :userTwoId,  UNIX_TIMESTAMP(), :activity)");
                  $ssstmt->execute([
                      ':userId' => $sID , 
                      ':userTwoId' => $userTwoId, 
                      ':activity' => "1"
                  ]);
                echo "success";
            }
        }
        public function unfollowUser($sID)
        {
            $userTwoId = $_POST['utid']; // wie gebruiker wilt volgen
            
            $stmt = $this->db->prepare("SELECT COUNT(following_id) FROM user_following WHERE user_id = :sid AND  following_id = :id");
            $stmt->execute([':sid' => $sID, ':id' => $userTwoId]);
            $rowCount = (int) $stmt->fetchColumn();
            
            if($rowCount == 1) 
            {
                $stm = $this->db->prepare("DELETE FROM user_following WHERE user_id = :sid AND following_id = :id");
                $stm->execute([':sid' => $sID, ':id' => $userTwoId]);
                
                $ssstmt = $this->db->prepare("DELETE FROM user_notif WHERE user_id = :userId AND user_two_id = :userTwoId AND activity = :activity");
                $ssstmt->execute([
                      ':userId' => $sID , 
                      ':userTwoId' => $userTwoId, 
                      ':activity' => "1"
                 ]);
                echo "success";
            }
        }
        public function search()
        {
            AjaxOnly();
            
            $output = null;
            
            $search = $_POST['searchVal'];
            $searchq = preg_replace("#[^0-9a-z]#i","",$search);
            
            $stm = $this->db->prepare("SELECT id, username, profile_image FROM users WHERE username LIKE :un OR firstname LIKE :fn OR surname LIKE :sn");
            $stm->execute([':un' => '%'.$search.'%', ':fn' => '%'.$search.'%', ':sn' => '%'.$search.'%']);
            
            if($stm->rowCount() == 0) 
            {
                $output = '<p class="searchUserResults" style="color:#a4a4a4">Er zijn geen resultaten gevonden</p>';
            } 
            else 
            {
                foreach($stm->fetchAll(PDO::FETCH_ASSOC) as $row) 
                {
                    $name = $row['username'];
                    $image = $row['profile_image'];
                    
                    $output .= '<a href="'.SITE_URL.'user/'.$name.'" class="userProfileLink"> <p class="searchUserResults"><img class="searchImage" src="'.SITE_URL.'assets/images/profile/'.$image.'" alt="'.$name.'"> '.$name.'</p> </a>';
                }
            }
            echo $output;
        }
        public function removeComment() 
        {
            echo "Remove comment";
        }
        public function addComment($sID) 
        {
            AjaxOnly();
            $imageId = $_POST['image_id'];
            $comment = $_POST['comment'];
            
            if(trim($comment) == " " || empty($comment))
            {
                return;
                
            } else {
                $stm = $this->db->prepare("INSERT INTO image_comments (image_id, image_comment, date, user_id) VALUES (:imageId, :comment, UNIX_TIMESTAMP(), :sID)");
                $stm->execute([
                    ':imageId' => $imageId, 
                    ':comment' => $comment, 
                    ':sID' => $sID
                ]);
            }
        }
        
        public function likePost($sID) 
        {
            AjaxOnly();
            
            $userId = $_POST['u']; // Sessie gebruiker
            $imageId = $_POST['i']; // id van foto die word geliked
            
            $stm = $this->db->prepare("SELECT * FROM image_likes WHERE user_id = :userId AND image_id = :imageId");
            $stm->execute([':userId' => $userId, ':imageId' => $imageId]);
            
            if($stm->rowCount() == 0) 
            {
                $stmt = $this->db->prepare("SELECT * FROM user_images WHERE image_id = :image");
                $stmt->execute([':image' => $imageId]);
                $test = $stmt->fetch();

                $sstmt = $this->db->prepare("INSERT INTO image_likes (user_id, image_id) VALUES (:userId, :imageId)");
                $sstmt->execute([':userId' => $userId , ':imageId' => $imageId]);
                
                
                
               if($userId !== $test['user_id']) 
                {
                     $ssstmt = $this->db->prepare("INSERT INTO user_notif (user_id, user_two_id,date,activity,data) VALUES (:userId, :userTwoId,  UNIX_TIMESTAMP(), :activity, :data)");
                     $ssstmt->execute([
                         ':userId' => $userId , 
                         ':userTwoId' => $test['user_id'], 
                         ':activity' => "0", 
                         ':data' => $imageId
                     ]);
                }
                echo "success";
            }
        }
        
        public function unlikePost($sID) 
        {
           AjaxOnly();

            $userId = $_POST['u']; // Sessie gebruiker
            $imageId = $_POST['i']; // id van foto die word geliked
            
            $stm = $this->db->prepare("SELECT * FROM image_likes WHERE user_id = :userId AND image_id = :imageId");
            $stm->execute([':userId' => $userId, ':imageId' => $imageId]);
            
            if($stm->rowCount() == 1) 
            {
                $stmt = $this->db->prepare("DELETE FROM image_likes WHERE user_id = :userId AND image_id = :imageId");
                $stmt->execute([':userId' => $userId , ':imageId' => $imageId]);

                $sstmt = $this->db->prepare("DELETE FROM user_notif WHERE user_id = :userId AND data = :imageId");
                $sstmt->execute([':userId' => $userId , ':imageId' => $imageId]);
               
                echo "success";
            }
            
        }
        
        public function posts($sID, $sName, $offset, $limit)
        {
            AjaxOnly();
            
            /** Kijken wie de gebruiker volgt **/
            $first = $this->db->prepare("SELECT following_id FROM user_following WHERE user_id = :id");
            $first->bindParam(':id', $sID);
            $first->execute();
            
            /** Kijken of de gebruiker iemand volgt **/
            if($first->rowCount() == 0) 
            {
                  /** Kijken wie de gebruiker zelf fotos heeft **/
                $second = $this->db->prepare("SELECT * FROM user_images WHERE user_id = :id ORDER BY upload_date DESC LIMIT {$limit} OFFSET {$offset}");
                $second->execute([':id' => $sID]);
				
				$rowcheck = $this->db->prepare("SELECT * FROM user_images WHERE user_id = :id ORDER BY upload_date");
                $rowcheck->execute([':id' => $sID]);
                
				 foreach($second->fetchAll(PDO::FETCH_ASSOC) as $row) {
                    
                       $four = $this->db->prepare("SELECT * FROM users WHERE id = :rid");
                       $four->bindParam(':rid', $row['user_id']);
                       $four->execute();
                       
                       foreach($four->fetchAll(PDO::FETCH_ASSOC) as $userrow) 
                       {
                         echo  '    <div class="photo-box">
                                    <div class="top_name">

                                    <div class="profile_photo"> <img src="'.SITE_URL.'assets/images/profile/'.$userrow['profile_image'].'" alt="test" class="profile_photo_feed"><img src="'.SITE_URL.'assets/images/profile/'.$userrow['profile_image'].'" alt="test" class="profile_photo_feed_big"></div>

                                    <div class="user_box">
                                    <div class="user_name_feed"><a class="n-link" href="'.SITE_URL.'user/'.$userrow['username'].'">'.$userrow['username'].'</a></div>
			';
				
                            if($userrow['verified_user'] == 1) { 

                                    echo '<span class="user_verified_feed"><span>Geverifieerd account</span></span>'; 

                            }
				echo '
				</div>
				<div class="feed_time">'.hg($row['upload_date']).'</div>
				</div>
				<div class="image-wrap">
				
				<img class="small-img" src="'.SITE_URL.'assets/images/'.$row['image_url'].'" alt="test">
				
				<div class="likes">
				';
                                $fifth = $this->db->prepare("SELECT * FROM image_likes WHERE image_id = :imgid");
                                $fifth->execute([':imgid' => $row['image_id']]);
                                
				if($fifth->rowCount() == 1) {
					echo '<span class="_likesimage" id="'.$row['image_id'].'">'.$fifth->rowCount().' like</span>';
				} else {
					echo '<span class="_likesimage" id="'.$row['image_id'].'">'.$fifth->rowCount().' likes</span>';
                }
				echo '
				</div>
				</div>
				
				<div class="description">
				<div class="desc_box">
				<div class="user_name_feedbox"><a class="n-link" href="'.SITE_URL.'user/'.$userrow['username'].'">'.$userrow['username'].'</a></div>
				'.find_atuser(find_hashtag($row['image_description'])).'
				</div>
				
				<div class="comments_box">
				
				
				<div class="comments">';
				
                                $comments = $this->db->prepare("SELECT * FROM image_comments WHERE image_id = :imgid");
                                $comments->execute([':imgid' => $row['image_id']]);
                                
                                foreach($comments->fetchAll(PDO::FETCH_ASSOC) as $com) 
                                {
                                    $usercomName =  $this->db->prepare("SELECT * FROM users WHERE id = :comID");
                                    $usercomName->execute([':comID' => $com['user_id']]);
                                    
                                    $name = $usercomName->fetch(PDO::FETCH_ASSOC);
                                    
                                   echo '<p><a href="'.SITE_URL.'/user/'.$name['username'].'" class="name">'.$name['username'].'</a> <span>'.find_atuser(find_hashtag($com['image_comment'])).'</span></p>';
				
                                }
                              
                              
				echo'
				</div>
				<hr></hr>
				';
                                
                                $six = $this->db->prepare("SELECT * FROM image_likes WHERE user_id = :id AND image_id = :imgid");
                                $six->execute([':id' => $sID, ':imgid' => $row['image_id']]);

				if($six->rowCount() > 0) {
					// Heeft al geliked
                                        echo '	
                                                <button class="like_heart clicked" data-type="unlike" data-imageid="'.$row['image_id'].'" data-userid="'.$sID.'"> </button>
                                                <button class="like_heart hidden" data-type="like" data-imageid="'.$row['image_id'].'" data-userid="'.$sID.'"> </button>
                                        ';
				} else {
					// Heeft nog niet geliked
                                        echo '	
                                                <button class="like_heart" data-type="like" data-imageid="'.$row['image_id'].'" data-userid="'.$sID.'"></button>
                                                <button class="like_heart hidden" data-type="unlike" data-imageid="'.$row['image_id'].'" data-userid="'.$sID.'"></button>
                                            ';
				}
				echo '
				<input type="text" name="comment" class="comments_input" image_id="'.$row['image_id'].'" user="'.$sName.'" placeholder="Plaats een reactie...">
				</div>
				
				</div>
				</div>
				';
                       }
                }
				
                 if($rowcheck->rowCount() == 0) 
                 {
                    echo "<div style='font-size:20px;text-align:center;color:#a4a4a4;'>Deel jouw ervaringen met andere studenten :)<br>Volg snel vrienden!</div>";
                    exit;
                 }
                
            } 
                else 
            {
                $array = array();
                foreach($first->fetchAll(PDO::FETCH_ASSOC) as $frow)
                {
                    $array = array_merge($array, array_map('trim', explode("," , $frow['following_id'])));
                }

                $ids = implode(',',$array);
                $third = $this->db->prepare("SELECT * FROM user_images WHERE user_id = :id OR user_id IN(:ids) ORDER BY upload_date DESC LIMIT {$limit} OFFSET {$offset}");
                $third->execute([':id' => $sID, ':ids' => $ids]);
				
				
          
                foreach($third->fetchAll(PDO::FETCH_ASSOC) as $row) {
                    
                       $four = $this->db->prepare("SELECT * FROM users WHERE id = :rid");
                       $four->bindParam(':rid', $row['user_id']);
                       $four->execute();
                       
                       foreach($four->fetchAll(PDO::FETCH_ASSOC) as $userrow) 
                       {
                         echo  '    <div class="photo-box">
                                    <div class="top_name">

                                    <div class="profile_photo"> <img src="'.SITE_URL.'assets/images/profile/'.$userrow['profile_image'].'" alt="test" class="profile_photo_feed"><img src="'.SITE_URL.'assets/images/profile/'.$userrow['profile_image'].'" alt="test" class="profile_photo_feed_big"></div>

                                    <div class="user_box">
                                    <div class="user_name_feed"><a class="n-link" href="'.SITE_URL.'user/'.$userrow['username'].'">'.$userrow['username'].'</a></div>
			';
				
                            if($userrow['verified_user'] == 1) { 

                                    echo '<span class="user_verified_feed"><span>Geverifieerd account</span></span>'; 

                            }
				echo '
				</div>
				<div class="feed_time">'.hg($row['upload_date']).'</div>
				</div>
				<div class="image-wrap">
				
				<img class="small-img" src="'.SITE_URL.'assets/images/'.$row['image_url'].'" alt="test">
				
				<div class="likes">
				';
                                $fifth = $this->db->prepare("SELECT * FROM image_likes WHERE image_id = :imgid");
                                $fifth->execute([':imgid' => $row['image_id']]);
                                
				if($fifth->rowCount() == 1) {
					echo '<span class="_likesimage" id="'.$row['image_id'].'">'.$fifth->rowCount().' like</span>';
				} else {
					echo '<span class="_likesimage" id="'.$row['image_id'].'">'.$fifth->rowCount().' likes</span>';
                }
				echo '
				</div>
				</div>
				
				<div class="description">
				<div class="desc_box">
				<div class="user_name_feedbox"><a class="n-link" href="'.SITE_URL.'user/'.$userrow['username'].'">'.$userrow['username'].'</a></div>
				'.find_atuser(find_hashtag($row['image_description'])).'
				</div>
				
				<div class="comments_box">
				
				
				<div class="comments">';
				
                                $comments = $this->db->prepare("SELECT * FROM image_comments WHERE image_id = :imgid");
                                $comments->execute([':imgid' => $row['image_id']]);
                                
                                foreach($comments->fetchAll(PDO::FETCH_ASSOC) as $com) 
                                {
                                    $usercomName =  $this->db->prepare("SELECT * FROM users WHERE id = :comID");
                                    $usercomName->execute([':comID' => $com['user_id']]);
                                    
                                    $name = $usercomName->fetch(PDO::FETCH_ASSOC);
                                    
                                   echo '<p><a href="'.SITE_URL.'/user/'.$name['username'].'" class="name">'.$name['username'].'</a> <span>'.find_atuser(find_hashtag($com['image_comment'])).'</span></p>';
				
                                }
                              
                              
				echo'
				</div>
				<hr></hr>
				';
                                
                                $six = $this->db->prepare("SELECT * FROM image_likes WHERE user_id = :id AND image_id = :imgid");
                                $six->execute([':id' => $sID, ':imgid' => $row['image_id']]);

				if($six->rowCount() > 0) {
					// Heeft al geliked
                                        echo '	
                                                <button class="like_heart clicked" data-type="unlike" data-imageid="'.$row['image_id'].'" data-userid="'.$sID.'"> </button>
                                                <button class="like_heart hidden" data-type="like" data-imageid="'.$row['image_id'].'" data-userid="'.$sID.'"> </button>
                                        ';
				} else {
					// Heeft nog niet geliked
                                        echo '	
                                                <button class="like_heart" data-type="like" data-imageid="'.$row['image_id'].'" data-userid="'.$sID.'"></button>
                                                <button class="like_heart hidden" data-type="unlike" data-imageid="'.$row['image_id'].'" data-userid="'.$sID.'"></button>
                                            ';
				}
				echo '
				<input type="text" name="comment" class="comments_input" image_id="'.$row['image_id'].'" user="'.$sName.'" placeholder="Plaats een reactie...">
				</div>
				
				</div>
				</div>
				';
                       }
                }
                
               
            } // if rowcount else
            
        } // function posts
        
} // class