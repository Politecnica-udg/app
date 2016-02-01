<?php
	class evaluacion extends datebase{
		function __construct(){parent::__construct($this->tableName(),$this->rules(),$this->attributeLabels(),$this->getIdDefecto());}
		public static function tableName(){
			return 'evaluacion';
		}
		public function rules(){
			return ['id_ev','tfal_int_ev','tclas_int_ev'];
		}
		public function attributeLabels(){
			return ['id_ev'=>'id Ev'];
		}
		public function getIdDefecto(){
			return 'id_ev';
		}
		public function getDatosAlu(){
			global $conf_poli;
			$query = $this->query(" SELECT DISTINCT id_ev, cod_ev,nom_ubi,cal_int_ev,tfal_int_ev, tclas_int_ev  FROM evaluacion INNER JOIN ubicacion ON calu_ubi=cod_ev WHERE ciclo = '$conf_poli[cal_prof]' and car_ev = '$_GET[c]' and gdo_ev = '$_GET[g]' and  gpo_ev = '$_GET[gr]' and asig_ev = '$_GET[m]' ORDER BY nom_ubi ");
			if($this->numero_de_filas($query) > 0){
				while ( $tsArray = $this->fetch_assoc($query) ) {
					$data[] = $tsArray;			
				}
				return $data;
			}else{	
				return '';
			}
		}
		public function getGuardarFal($value){
			$this->query("UPDATE evaluacion SET tfal_int_ev='$value[fal]', tclas_int_ev='$value[cTotal]' WHERE id_ev = '$value[id_al]'");
		}
		public function getGuardarCal($value){
			$this->query("UPDATE evaluacion SET cal_int_ev='$value[cal]' WHERE id_ev = '$value[id_al]'");
		}
		public function getCarrera($con){
			$query = $this->query("SELECT nom_car FROM carreras WHERE ccar_car = '$con' ");
			$sea= $this->fetch_array($query);
			if ($sea) {
				return $sea;
			}else{
				return "";
			}
		}
		public function getMat($con){
			$query = $this->query("SELECT nom_pes FROM planes WHERE ccar_pes = '$_GET[c]' AND gdo_pes='$_GET[g]' AND casg_pes='$_GET[m]' ");
			$sea= $this->fetch_array($query);
			if ($sea) {
				return $sea;
			}else{
				return "";
			}
		}
		public function getGrupo(){
			global $conf_poli;
			$query = $this->query(" SELECT DISTINCT cod_ev,nom_ubi,cal_int_ev,tfal_int_ev, tclas_int_ev  FROM evaluacion INNER JOIN ubicacion ON calu_ubi=cod_ev WHERE ciclo = '$conf_poli[cal_prof]' and car_ev = '$_GET[c]' and gdo_ev = '$_GET[g]' and  gpo_ev = '$_GET[gr]' and asig_ev = '$_GET[m]' ORDER BY nom_ubi ");
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