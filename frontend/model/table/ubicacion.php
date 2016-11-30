<?php
	class ubicacion{
		private $mysql;
		function __construct(){
			$this->mysql = new mysqli(host,user,pw,db);
			if ($mysql->connect_error) {
				die("Problemas con la conexion a la base de datos");
			}
		}
		public function info_al($cod){
			$query = $this->mysql->query("SELECT ccar_ubi,abr_car FROM ubicacion
									INNER JOIN carreras on ccar_car=ccar_ubi
									WHERE calu_ubi = '$_SESSION[codigo]';");
			if ($reg=$query->fetch_array())
      			return $reg;	
		}	
		function __destruct(){
			$this->mysql->close();
		}
	}
?>