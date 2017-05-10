<?php
/* Controller Index */

class ErrorController extends Controller {
	function __construct() {
		
		parent::__construct();

	}
	function Index() {
		$this->view->msg = 'This page doesnt exist';
		$this->view->render('error');
	}
	function test() 
	{
		$this->userProfileInfoModel->test;
	}
}
