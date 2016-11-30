<?php
	class solicitantes{
		private $mysql;
		function __construct(){
			$this->mysql = new mysqli(host,user,pw,db);
			if ($mysql->connect_error) {
				die("Problemas con la conexion a la base de datos");
			}
		}
		public function inf_soli($cod){
			$query = $this->mysql->query("SELECT * FROM solicitantes WHERE codigo = '$cod';");
			if ($reg=$query->fetch_array())
      			return $reg;
		}
		public function catalogo($carr){
			$query = $this->mysql->query("SELECT em,count(*), name, domi FROM solicitantes
				INNER JOIN empresas on code = em
				WHERE carr = '$carr' AND libre = '0'  GROUP BY em");
			while ($reg=$query->fetch_array())
      			$data[] = $reg;
      		return $data;
		}
		public function solici_lista($cod){
			$query = $this->mysql->query("SELECT distinct * FROM solicitantes
				WHERE carr = '$_SESSION[carr]' AND libre = '0' AND em = '$cod'");
			while ($reg=$query->fetch_array())
      			$data[] = $reg;
      		return $data;
		}
		public function save_inf($id){
			$this->mysql->query("UPDATE solicitantes SET libre = '1', codigo='$_SESSION[codigo]' WHERE id = '$id';");
			$this->mysql->query("UPDATE alumnos_datos SET em_codigo = '$id' WHERE codigo_a = '$_SESSION[codigo]';");
			return $this->mysql->query("INSERT INTO citas (codigo_a) VALUES ('$_SESSION[codigo]')");
		}
		function __destruct(){
			$this->mysql->close();
		}
	}
?>