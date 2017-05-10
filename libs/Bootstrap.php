<?php
/* Controller Index */

class Bootstrap {
	function __construct() {
		
		$url = isset($_GET['url']) ? $_GET['url'] : null;
		$url = rtrim($url, '/');
		$url = explode('/', $url);

		if(empty($url[0])) {
			require 'controllers/login.php';
			$controller = new login();
			$controller->Index();
			return false;
		}

		$file = 'controllers/'.$url[0].'.php';
		
		if(file_exists($file)) {
			require $file;
		} else {
			require 'controllers/error.php';
			$controller = new ErrorController();
			return false;
		}
		
		$controller = new $url[0];
		$controller->loadModel($url[0]);

			// calling methods
		if (isset($url[2])) {
			if (method_exists($controller, $url[1])) {
				$controller->{$url[1]}($url[2]);
			} else {
				$this->error();
			}
		} else {
			if (isset($url[1])) {
				if (method_exists($controller, $url[1])) {
                                    
                                    $controller->{$url[1]}();
                                        
				} elseif($url['0'] === "user"){
                                    
                                    $controller->index($url[1]);
                                    
                                }else{
                                    
                                    $this->error();
                                        
				}
			} else {
				$controller->index();
			}
		}
		
		
	}
	
	function error() {
		require 'controllers/error.php';
		$controller = new ErrorController();
		$controller->index();
		return false;
	}
}
