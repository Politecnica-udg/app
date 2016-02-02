<?php
	class cali extends datebase{
		function __construct(){parent::__construct($this->tableName(),$this->rules(),$this->attributeLabels(),$this->getIdDefecto());}
		public static function tableName(){
			return 'cali';
		}
		public function rules(){
			return ['id_cal'];
		}
		public function attributeLabels(){
			return ['id_cal'=>'id'];
		}
		public function getIdDefecto(){
			return 'id_cal';
		}
		public function getClass($sem){
			$query = $this->query("SELECT distinct id_cal, asig_cal, evaluar, nom_pes FROM cali
				INNER JOIN planes on ccar_pes = carr_cal AND gdo_pes = gdo_cal  AND casg_pes =asig_cal
				WHERE cic_cal='$sem' and cod_cal='$_SESSION[codigo]';");
			if($this->numero_de_filas($query) > 0){
				while ( $tsArray = $this->fetch_assoc($query) ) {
					$data[] = $tsArray;			
				}
				return $data;
			}else{	
				return '';
			}
		}
		public function getInfo($mat){
			$query = $this->query("SELECT carr_cal, gdo_cal, gpo_cal, asig_cal,cic_cal FROM cali 
				WHERE id_cal = '$mat' ");
			$sea= $this->fetch_array($query);
				return $sea;
		}
		public function getGrabar($dato,$arr){
			$this->query("INSERT INTO evaluacion_a (carrera, grado, grupo, materia,ciclo,a,b,c,d,e,f,com) values ('$dato[0]','$dato[1]','$dato[2]','$dato[3]','$dato[4]','$arr[0]','$arr[1]','$arr[2]','$arr[3]','$arr[4]','$arr[5]','$arr[6]')");
			$this->query("UPDATE cali SET evaluar ='1' WHERE id_cal = '$_POST[materia]'");
		}
	}
?>