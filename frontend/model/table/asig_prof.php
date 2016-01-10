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
			$query = $this->query("SELECT cod_prof, nom_pro, cin, COUNT(*) FROM asig_prof INNER JOIN profesores on cod_pro=cod_prof WHERE cal_prof='$conf_poli[cal_prof]' GROUP BY cod_prof, cin ORDER BY nom_pro; ");
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