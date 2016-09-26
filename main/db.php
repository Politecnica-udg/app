<?php
	class datebase{
		private $conexion;
		function __construct(){
			$this->conexion = new mysqli(host,user,pw,db);
			if ($this->conexion->connect_error) {
				die("Problemas con la conexion a la base de datos");
			}
		}
		function query($sql){
			return $this->conexion->query($sql) or
			die ($this->conexion->error);
		}
		function fetch_arra($result){
			return $result->fetch_array();
		}
		function __destruct(){$this->conexion->close();}
	}
?>