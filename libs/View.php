<?php

class View {
	function __construct() {
	}
	public function render($name, $loginPages = false) {
		
		if($loginPages == true) {
			require 'views/'.$name.'.php';
		} else {
			require 'views/includes/header.php';
			require 'views/'.$name.'.php';
			require 'views/includes/footer.php';
		}
	}
}
