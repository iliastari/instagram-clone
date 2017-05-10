<?php
/* Controller Index */

class settings extends Controller {
        function __construct() {
		parent::__construct();
		Session::init();
		if(Session::get('loggedIn') == false) {
			Session::destroy();
			echo "<script>window.location.href='".SITE_URL."login';</script>";  
			exit;
		}
		$this->view->css = ['profile.css'];
        $this->view->js = ['settings.js'];
		
	}
	
	function Index() 
	{
            $this->view->userData = $this->userModel->userInfo(Session::get('id'));
			
			$this->view->messages = $this->model->settingsEdit(Session::get('id'));
			
            $this->view->render('settings');
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
