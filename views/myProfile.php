<section class="profile-wrap">
<div class="user_profile_information">	
      <div class="container">	
	  <div class="profile_page_1">
						<div id="user_info_box">

								<div class="user_profile_image_pos">
								<img src="<?php echo SITE_URL . "assets/images/profile/".$this->userData['profile_image']; ?>" class="user_profile_image">
								</div>
								</div>
                                                            <div class="user_stats_box">
								<div class="user_box_profile">
								<div class="user_profile_name">
                                                                    <?php
                                                                    echo $this->userData['username'];
																	
																	if($this->userData['verified_user'] == 1) {
																		echo '<span class="user_verified_profile"><span>Geverifieerd account</span></span>'; 
																	} 
                                                                    ?>
								</div>
								
								<div class="user_follow_box">
                                                                    <a href="<?php echo SITE_URL; ?>settings" style="text-decoration:none;"><input type="submit" class="edit_settings" value="Profiel instellingen"></a>
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
                                                                        echo $this->userData['username'];
                                                                    ?>
                                                                    </b> 
                                                                    <?php 
                                                                        echo find_hashtag($this->userData['profile_bio']); 
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
            <img src="<?php echo SITE_URL.'assets/images/profile/'.$this->userData['profile_image']; ?>" alt="" class="userProfileImg">
        </span>
	<span class="userName">
            <?php 
                echo $this->userData['username']; 
            ?>
        </span>
	<div id="userComments" class="noclick">
	
	
	<div class="commentUser">
		<span class="username">Oops</span><span class="comment"> Reageren en liken via profiel pagina is nog niet af.</span>
	</div>
	
	
	<input type="text" class="noclick commentsInput" name="comment" placeholder="Plaats een reactie...">
	</div>
	</div>
	</div>
</section>

