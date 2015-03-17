<?php
	class general_M extends datebase
	{
		function __construct()
		{
			parent::__construct();
		}
		public function materias()
		{
			$query = $this->consulta("SELECT ccar_prof,abr_car,gdo_prof,tur_prof,gpo_prof,casg_prof,nom_pes,cal_prof,cod_prof,capint_prof, cin FROM `asig_prof`
				INNER JOIN carreras on ccar_car=ccar_prof
				INNER JOIN planes on ccar_pes=ccar_prof AND gdo_pes=gdo_prof AND casg_pes=casg_prof
				WHERE cal_prof='2014A' and cod_prof='$_SESSION[codigo]';");
			if($this->numero_de_filas($query) > 0){
				while ( $tsArray = $this->fetch_assoc($query) ) {
					$data[] = $tsArray;			
				}
				return $data;
			}else{	
				return '';
			}
		}
		public function datos()
		{
			$query = $this->consulta(" SELECT DISTINCT cod_ev,nom_ubi,cal_int_ev,tfal_int_ev, tclas_int_ev  FROM evaluacion INNER JOIN ubicacion ON calu_ubi=cod_ev WHERE ciclo = '2014A' and car_ev = '$_GET[c]' and gdo_ev = '$_GET[g]' and  gpo_ev = '$_GET[gr]' and asig_ev = '$_GET[m]' ORDER BY nom_ubi ");
			if($this->numero_de_filas($query) > 0){
				while ( $tsArray = $this->fetch_assoc($query) ) {
					$data[] = $tsArray;			
				}
				$_SESSION['class'] = $data[0]['tclas_int_ev'];
				return $data;
			}else{	
				return '';
			}
		}
		public function guardar($value)
		{
			$this->consulta("UPDATE evaluacion SET cal_int_ev ='$value[cal]', tfal_int_ev='$value[fal]', tclas_int_ev='$value[class]' WHERE cod_ev='$value[cod]' and car_ev = '$value[car]' and asig_ev = '$value[mat]'");
		}
		public function bloquear()
		{
			$this->consulta(" UPDATE asig_prof SET cin =2 WHERE cod_prof='$_SESSION[codigo]' and ccar_prof = '$_GET[c]' and casg_prof = '$_GET[m]' and gdo_prof='$_GET[g]' and gpo_prof='$_GET[gr]'");
		}
		public function marcar()
		{
			$this->consulta(" UPDATE asig_prof SET cin =1 WHERE cod_prof='$_SESSION[codigo]' and ccar_prof = '$_GET[c]' and casg_prof = '$_GET[m]' and gdo_prof='$_GET[g]' and gpo_prof='$_GET[gr]'");
		}
		public function carrera($con)
		{
			$query = $this->consulta("SELECT nom_car FROM carreras WHERE ccar_car = '$con' ");
			$sea= $this->fetch_array($query);
			if ($sea) {
				return $sea;
			}else{
				return "";
			}
		}
		public function mat($con)
		{
			$query = $this->consulta("SELECT nom_pes FROM planes WHERE ccar_pes = '$_GET[c]' AND gdo_pes='$_GET[g]' AND casg_pes='$_GET[m]' ");
			$sea= $this->fetch_array($query);
			if ($sea) {
				return $sea;
			}else{
				return "";
			}
		}
		public function grupo()
		{
			$query = $this->consulta(" SELECT DISTINCT cod_ev,nom_ubi,cal_int_ev,tfal_int_ev, tclas_int_ev  FROM evaluacion INNER JOIN ubicacion ON calu_ubi=cod_ev WHERE ciclo = '2014A' and car_ev = '$_GET[c]' and gdo_ev = '$_GET[g]' and  gpo_ev = '$_GET[gr]' and asig_ev = '$_GET[m]' ORDER BY nom_ubi ");
			if($this->numero_de_filas($query) > 0){
				while ( $tsArray = $this->fetch_assoc($query) ) {
					$data[] = $tsArray;			
				}
				return $data;
			}else{	
				return '';
			}
		}
		function __destruct() {
			parent::__destruct();
		}
	}
?>