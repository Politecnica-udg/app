<?php
	class general_A extends datebase{
		function __construct(){
			parent::__construct();
		}
		public function maestros(){
			global $conf_poli;
			$query = $this->consulta("SELECT cod_prof, nom_pro,cin, COUNT(*) FROM asig_prof INNER JOIN profesores on cod_pro=cod_prof WHERE cal_prof='$conf_poli[cal_prof]' GROUP BY cod_prof, cin ORDER BY nom_pro; ");
			if($this->numero_de_filas($query) > 0){
				while ( $tsArray = $this->fetch_assoc($query) ) {
					$data[] = $tsArray;			
				}
				return $data;
			}else{	
				return '';
			}
		}
		public function materias($cod){
			global $conf_poli;
			$query = $this->consulta("SELECT distinct ccar_prof,abr_car,gdo_prof,tur_prof,gpo_prof,casg_prof,nom_pes,cal_prof,cod_prof,capint_prof, cin FROM `asig_prof`
				INNER JOIN carreras on ccar_car=ccar_prof
				INNER JOIN planes on ccar_pes=ccar_prof AND gdo_pes=gdo_prof AND casg_pes=casg_prof
				WHERE cal_prof='$conf_poli[cal_prof]' and cod_prof='$cod';");
			if($this->numero_de_filas($query) > 0){
				while ( $tsArray = $this->fetch_assoc($query) ) {
					$data[] = $tsArray;
				}
				return $data;
			}else{
				return '';
			}
		}
	}
?>