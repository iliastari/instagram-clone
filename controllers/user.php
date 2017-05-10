<?php
/* Controller Index */

class user extends Controller {
        function __construct() {
		parent::__construct();
		Session::init();
		if(Session::get('loggedIn') == false) {
			Session::destroy();
			echo "<script>window.location.href='".SITE_URL."login';</script>";  
			exit;
		}
                $this->view->js = ['functions.js', 'popup.js', 'follow.js'];
                $this->view->css = ['profile.css','popup.css'];
               
	}
	
	function Index($username = false) 
	{
            $this->view->userData = $this->userModel->userInfo(Session::get('id'));
            
            if(strtolower($username) == strtolower(Session::get('username')))
            {
               $this->view->myPosts = $this->model->myPosts(Session::get('id'));
               
			   $this->view->verified = $this->model->verified(Session::get('username'));
				
               $this->view->posts = $this->model->myPostsCount(Session::get('id'));
               $this->view->following = $this->model->myFollowingCount(Session::get('id'));
               $this->view->followers = $this->model->myFollowersCount(Session::get('id'));
               
               $this->view->render('myProfile');
            } 
            elseif($username === false)
            {
               redirect("user/".Session::get('username'));
            }
            else
            {
                if($this->model->checkUserExists($username) == false) {
					
					 $this->view->render('noProfile');
					 
				} else {
				
				
                $this->view->userProfileInfo = $this->model->otherProfileUserinfo($username);
                $this->view->myPosts = $this->model->otherPosts($username);
				
                $this->view->posts = $this->model->otherPostsCount($username);
                $this->view->following = $this->model->otherFollowingCount($username);
                $this->view->followers = $this->model->otherFollowersCount($username);
               
                $this->view->followCheck = $this->model->followCheck($username, Session::get('id'));
                         
                $this->view->render('otherProfile');
				}
                
            }
            
            
	}
}
