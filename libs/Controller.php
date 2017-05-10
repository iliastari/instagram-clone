<?php

class Controller {
	
	function __construct() {	
		$this->view = new View();
	}
	
	public function loadModel($name) {
		$path ='models/'.$name.'Model.php';
		
		if(file_exists($path)) {
			require 'models/'.$name.'Model.php';
			require 'models/userdataModel.php';
			$modelName = $name . 'Model';
			$this->model = new $modelName;
			$this->userModel = new userdataModel;
		}
	}
	
}
