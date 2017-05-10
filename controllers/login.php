<?php
/* Controller Index */

class login extends Controller {
	function __construct() {
		parent::__construct();
		$this->view->js = array('js/checkUser.js');
		Session::init();
		if(Session::get('loggedIn') == true) {
			header('location: feed');
			exit;
		}
	}
	function Index() 
	{
		$this->view->render('login', 1); // 1 is login page
	}
	function login() 
	{
		$this->model->login(); // Check user for login
	}
	function register() 
	{
		$this->model->register(); // Register user 
	}
	function welcome() 
	{
		$this->model->welcome(Session::get('username')); // add session ID
	}
}
