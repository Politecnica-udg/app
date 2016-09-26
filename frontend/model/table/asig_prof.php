<?php
	class asig_prof{
		private $mysql;
		function __construct(){
			$this->mysql = new mysqli(host,user,pw,db);
			if ($mysql->connect_error) {
				die("Problemas con la conexion a la base de datos");
			}
		}
		public function getMaestros(){
			global $conf_poli;
			$query = $this->mysql->query("SELECT cod_prof, nom_pro, cin, COUNT(*) AS total FROM asig_prof INNER JOIN profesores on cod_pro=cod_prof WHERE cal_prof='$conf_poli[cal_prof]' GROUP BY cod_prof, cin ORDER BY nom_pro; ");
			while ($reg=$query->fetch_array()){
				if ($reg['nom_pro']!= '') {
					$data[] = $reg;
				}
			}
      		return $data;
		}
		public function getMaterias($cod){
			global $conf_poli;
			$query = $this->mysql->query("SELECT distinct id, ccar_prof,abr_car,gdo_prof,tur_prof,gpo_prof,casg_prof,nom_pes,cal_prof,cod_prof,capint_prof, cin FROM `asig_prof`
				INNER JOIN carreras on ccar_car=ccar_prof
				INNER JOIN planes on ccar_pes=ccar_prof AND gdo_pes=gdo_prof AND casg_pes=casg_prof
				WHERE cal_prof='$conf_poli[cal_prof]' and cod_prof='$cod';");
			while ($reg=$query->fetch_array())
      			$data[] = $reg;
      		return $data;
		}
		public function getGrabar($op){
			$this->mysql->query(" UPDATE asig_prof SET cin = '$op' , tclas_int = '$_GET[fal]' WHERE id='$_GET[id]'");
		}	
		function __destruct(){
			$this->mysql->close();
		}
	}
?>