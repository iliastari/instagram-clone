<?php
/* Controller Index */

class feed extends Controller {
        function __construct() {
		parent::__construct();
		Session::init();
		if(Session::get('loggedIn') == false) {
			Session::destroy();
			echo "<script>window.location.href='".SITE_URL."login';</script>";  
			exit;
		}
                $this->view->js = array('feed.js', 'functions.js');
		
	}
	
	function Index() 
	{
            $this->view->userData = $this->userModel->userInfo(Session::get('id'));
            $this->view->render('feed');
	}
        function posts() 
        {
			$offset = $_GET['offset'];
            $limit  = $_GET['limit'];
			
            $this->model->posts(Session::get('id'), Session::get('username'), $offset, $limit);
        }	
        function likePost() {
             $this->model->likePost(Session::get('id'));
        }
        function unlikePost() {
             $this->model->unlikePost(Session::get('id'));
        }
        function addComment() {
             $this->model->addComment(Session::get('id'));
        }
        function removeComment() {
             $this->model->removeComment(Session::get('id'));
        }
        function search() {
             $this->model->search();
        }
        function follow(){
            $this->model->followUser(Session::get('id'));
        }
        function unfollow(){
            $this->model->unfollowUser(Session::get('id'));
        }
        function logout() 
        {
            Session::init();
            if(Session::get('loggedIn') == true) {
                    Session::destroy();
                    header('location: '.SITE_URL);
                    exit;
            }
        }
}
