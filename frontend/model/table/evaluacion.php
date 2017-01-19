<?php
	class evaluacion{
		private $mysql;
		function __construct(){
			$this->mysql = new mysqli(host,user,pw,db);
			if ($mysql->connect_error) {
				die("Problemas con la conexion a la base de datos");
			}
		}
		public function getDatosAlu(){
			global $conf_poli;
			$query = $this->mysql->query(" SELECT DISTINCT id_ev, cod_ev,nom_ubi,cal_int_ev,tfal_int_ev, tclas_int_ev  FROM evaluacion INNER JOIN ubicacion ON calu_ubi=cod_ev WHERE ciclo = '$conf_poli[cal_prof]' and car_ev = '$_GET[c]' and gdo_ev = '$_GET[g]' and tno_ev='$_GET[t]'  and  gpo_ev = '$_GET[gr]' and asig_ev = '$_GET[m]' ORDER BY nom_ubi ");
			while ($reg=$query->fetch_array())
      			$data[] = $reg;
      		return $data;
		}
		public function getGuardarFal($value){
			$this->mysql->query("UPDATE evaluacion SET tfal_int_ev='$value[fal]', tclas_int_ev = '$value[cTotal]' WHERE id_ev = '$value[id_al]'");
		}
		public function getGuardarCal($value){
			$this->mysql->query("UPDATE evaluacion SET cal_int_ev='$value[cal]' WHERE id_ev = '$value[id_al]'");
		}
		public function getCarrera($con){
			$query = $this->mysql->query("SELECT nom_car FROM carreras WHERE ccar_car = '$con' ");
			if ($reg=$query->fetch_array())
      			return $reg;
		}
		public function getMat($con){
			$query = $this->mysql->query("SELECT nom_pes FROM planes WHERE ccar_pes = '$_GET[c]' AND gdo_pes='$_GET[g]' AND casg_pes='$_GET[m]' ");
			if ($reg=$query->fetch_array())
      			return $reg;
		}
		public function getGrupo(){
			global $conf_poli;
			$query = $this->mysql->query(" SELECT DISTINCT cod_ev,nom_ubi,cal_int_ev,tfal_int_ev, tclas_int_ev  FROM evaluacion INNER JOIN ubicacion ON calu_ubi=cod_ev WHERE ciclo = '$conf_poli[cal_prof]' and car_ev = '$_GET[c]' and gdo_ev = '$_GET[g]' and  tno_ev='$_GET[t]' and gpo_ev = '$_GET[gr]' and asig_ev = '$_GET[m]' and tno_ev='$_GET[t]' ORDER BY nom_ubi ");
			while ($reg=$query->fetch_array())
      			$data[] = $reg;
      		return $data;
		}
		function __destruct(){
			$this->mysql->close();
		}
	}
?>
