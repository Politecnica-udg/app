<?php
	class citas{
		private $mysql;
		function __construct(){
			$this->mysql = new mysqli(host,user,pw,db);
			if ($mysql->connect_error) {
				die("Problemas con la conexion a la base de datos");
			}
		}
		public function cita($cod){
			$query = $this->mysql->query("SELECT * FROM citas WHERE codigo_a = '$cod' ");
			if ($reg=$query->fetch_array())
      			return $reg;
		}
		function __destruct(){
			$this->mysql->close();
		}
	}
?>