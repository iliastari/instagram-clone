<?php
/* Controller Index */

class upload extends Controller {
        function __construct() {
		parent::__construct();
		Session::init();
		if(Session::get('loggedIn') == false) {
			Session::destroy();
			echo "<script>window.location.href='".SITE_URL."login';</script>";  
			exit;
		}
               $this->view->js = array('upload.js');
		
	}
	
	function Index() 
	{
            $this->view->userData = $this->userModel->userInfo(Session::get('id'));
			$this->view->msg = $this->model->upload(Session::get('id')); 
            $this->view->render('upload');
	}
}
