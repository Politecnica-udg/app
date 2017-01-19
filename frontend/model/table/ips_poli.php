<?php
	class ips_poli{
		private $mysql;
		function __construct(){
			$this->mysql = new mysqli(host,user,pw,db);
			if ($mysql->connect_error) {
				die("Problemas con la conexion a la base de datos");
			}
		}		
		function __destruct(){
			$this->mysql->close();
		}
	}
?>