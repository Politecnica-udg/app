<?php
	class asig_prof extends datebase{
		function __construct(){parent::__construct($this->tableName(),$this->rules(),$this->attributeLabels(),$this->getIdDefecto());}
		public static function tableName(){
			return 'asig_prof';
		}
		public function rules(){
			return ['id'];
		}
		public function attributeLabels(){
			return ['id'=>'id'];
		}
		public function getIdDefecto(){
			return 'id';
		}
		public function getMaestros(){
			global $conf_poli;
			$query = $this->query("SELECT cod_prof, nom_pro, cin, COUNT(*) AS total FROM asig_prof INNER JOIN profesores on cod_pro=cod_prof WHERE cal_prof='$conf_poli[cal_prof]' GROUP BY cod_prof, cin ORDER BY nom_pro; ");
			if($this->numero_de_filas($query) > 0){
				while ( $tsArray = $this->fetch_assoc($query) ) {
					if($tsArray['nom_pro']!= "")
						$data[] = $tsArray;			
				}
				return $data;
			}else{	
				return '';
			}
		}
		public function getMaterias($cod){
			global $conf_poli;
			$query = $this->query("SELECT distinct id, ccar_prof,abr_car,gdo_prof,tur_prof,gpo_prof,casg_prof,nom_pes,cal_prof,cod_prof,capint_prof, cin FROM `asig_prof`
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
		public function getGrabar($op){
			$this->query(" UPDATE asig_prof SET cin = '$op' WHERE id='$_GET[id]'");
		}
	}
?>