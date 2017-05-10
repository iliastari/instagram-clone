<section class="profile-wrap">
<div class="user_profile_information">	
      <div class="container">	
	  <div class="profile_page_1">
						<div id="user_info_box">
								
								<div class="user_profile_image_pos">
								<img src="<?php echo SITE_URL . "assets/images/profile/".$this->userProfileInfo['profile_image']; ?>" class="user_profile_image">
								</div>
								
                                                            <div class="user_stats_box">
								<div class="user_box_profile">
								<div class="user_profile_name">
                                                                    <?php
                                                                    echo $this->userProfileInfo['username'];
																	
																	if($this->userProfileInfo['verified_user'] == 1) {
																		echo '<span class="user_verified_profile"><span>Geverifieerd account</span></span>'; 
																	} 
                                                                    ?>
																	
								</div>
								<div class="user_follow_box">
                                                                    
                                                                <?php 
                                                                if($this->followCheck == false)
                                                                {
                                                                    echo '<input type="submit" data-type="follow" data-utid="'.$this->userProfileInfo['id'].'" class="user_follow_btn" value="Volgen">';
                                                                    echo '<input type="submit" data-type="unfollow" data-utid="'.$this->userProfileInfo['id'].'" class="user_follow_btn hidden" value="Volgend">';

                                                                } 
                                                                else 
                                                                {
                                                                    echo '<input type="submit" data-type="unfollow" data-utid="'.$this->userProfileInfo['id'].'" class="user_follow_btn unfollow" value="Volgend">';
                                                                    echo '<input type="submit" data-type="follow" data-utid="'.$this->userProfileInfo['id'].'" class="user_follow_btn hidden" value="Volgen">';
                                                                }
                                                                ?>
                                                                </div>
								</div>
								<div class="user_profile_stats">
                                                                    
                                                                    <span class="user_follow_stat">
                                                                        <?php
                                                                           echo $this->posts;
                                                                        ?>
                                                                    </span>
                                                                    <span class="user_stats"> 
                                                                        <span id="volgers">
                                                                        <?php
                                                                             echo $this->followers;
                                                                         ?>
                                                                        </span>
                                                                    </span>
                                                                    <span class="user_stats"> 
                                                                        <?php
                                                                           echo $this->following;
                                                                        ?>
                                                                    </span>
                                                                    
								</div>	
                                                                <div class="user_profile_description">
                                                                    <b>
                                                                    <?php
                                                                        echo $this->userProfileInfo['username'];
                                                                    ?>
                                                                    </b> 
                                                                    <?php 
                                                                        echo find_hashtag($this->userProfileInfo['profile_bio']); 
                                                                    ?>
                                                                </div>
                                                            </div>
                                                </div>
</div>

</div>
</div>

	<div class="imagesUser">
            <ul id="userImages">
            <?php 
                echo $this->myPosts; 
            ?>
            </ul>
	<div id="imgUserInfo" class="noclick">
	<span class="userProfile">
            <img src="<?php echo SITE_URL.'assets/images/profile/'.$this->userProfileInfo['profile_image']; ?>" alt="" class="userProfileImg">
        </span>
	<span class="userName">
            <?php 
                echo $this->userProfileInfo['username']; 
            ?>
	
        </span>
	<div id="userComments" class="noclick">
	<input type="text" class="noclick commentsInput" name="comment" placeholder="Plaats een reactie...">
	</div>
	</div>
	</div>
	</section>

