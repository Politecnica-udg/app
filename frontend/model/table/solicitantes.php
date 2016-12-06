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
				INNER JOIN empresas on empresas.id = em
				WHERE carr = '$carr' AND libre = '0'  GROUP BY em");
			while ($reg=$query->fetch_array())
      			$data[] = $reg;
      		return $data;
		}
		public function solici_lista($cod, $sexo){
			$query = $this->mysql->query("SELECT distinct * FROM solicitantes
				WHERE carr = '$_SESSION[carr]' AND libre = '0' AND em = '$cod' AND sexo_em != '$sexo'");
			while ($reg=$query->fetch_array())
      			$data[] = $reg;
      		return $data;
		}
		public function save_inf($id){
			$this->mysql->query("UPDATE solicitantes SET libre = '1', codigo='$_SESSION[codigo]' WHERE id = '$id';");
			$this->mysql->query("UPDATE alumnos_datos SET em_codigo = '$id' WHERE codigo_a = '$_SESSION[codigo]';");
			return $this->mysql->query("INSERT INTO citas (codigo_a) VALUES ('$_SESSION[codigo]')");
		}
		public function soliIn($id){
			$query = $this->mysql->query("SELECT *, solicitantes.id AS id_soli FROM solicitantes
						INNER JOIN alumnos_datos ON codigo_a = codigo
				WHERE em = '$id'");
			while ($reg=$query->fetch_array())
      			$data[] = $reg;
      		return $data;
		}
		public function eSaveSo($dat){
			return $this->mysql->query("UPDATE solicitantes SET
											carr 	= '$dat[carr]',
											act 	= '$dat[act]',
											apoyo 	= '$dat[apoyo]',
											sexo_em = '$dat[sexo_em]'
									WHERE id = '$dat[id_soli]';");
		}
		public function quitAl($cod){
			$this->mysql->query("UPDATE solicitantes SET libre = '0', codigo='0' WHERE codigo = '$cod';");
			$this->mysql->query("UPDATE alumnos_datos SET em_codigo = '0' WHERE codigo_a = '$cod';");
		}
		public function SaveSo($dat){
			return $this->mysql->query("INSERT INTO solicitantes (carr, act, apoyo, sexo_em, em)
										VALUES ('$dat[carr]', '$dat[act]', '$dat[apoyo]', '$dat[sexo_em]', '$dat[emp]')");
		}
		function __destruct(){
			$this->mysql->close();
		}
	}
?>