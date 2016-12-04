<?php
	class empresas{
		private $mysql;
		function __construct(){
			$this->mysql = new mysqli(host,user,pw,db);
			if ($mysql->connect_error) {
				die("Problemas con la conexion a la base de datos");
			}
		}
		public function inf_em($cod){
			$query = $this->mysql->query("SELECT * FROM empresas WHERE id = '$cod' ");
			if ($reg=$query->fetch_array())
      			return $reg;
		}
		public function empInfo(){
			$query = $this->mysql->query("SELECT *,
										 (SELECT COUNT(*) FROM solicitantes WHERE em = empresas.id) AS soli
									FROM empresas");
			while ($reg=$query->fetch_array())
      			$data[] = $reg;
      		return $data;
		}
		public function eSaveEm($dat){
			return $this->mysql->query("UPDATE empresas SET
										name 	= '$dat[name]',
										domi 	= '$dat[domi]',
										cp 		= '$dat[cp]',
										mun 	= '$dat[mun]',
										email 	= '$dat[email]',
										tel 	= '$dat[tel]',
										name_en = '$dat[name_en]',
										cargo 	= '$dat[cargo]',
										email_en= '$dat[email_en]'
									WHERE id = '$dat[id_em]'; ");
		}
		public function deleteEm($id){
			$this->mysql->query("DELETE FROM empresas WHERE id = '$id';");
			return $this->mysql->query("DELETE FROM solicitantes WHERE em = '$id';");
		}
		function __destruct(){
			$this->mysql->close();
		}
	}
?>