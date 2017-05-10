<?php
/* Controller Index */

class Database extends PDO {
	
	public function __construct() 
	{
		parent::__construct('mysql:host='.HOST.';dbname='.DB_NAME.'', ''.HOST_NAME.'',''.HOST_PASSWORD.'');
	}
	
}
