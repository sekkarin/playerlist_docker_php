<?php

class Config  
{	
	function __construct() {
		$this->host = "mariadb";
		$this->user  = "root";
		$this->pass = "123456";
		$this->db = "players";
	}
}

?>