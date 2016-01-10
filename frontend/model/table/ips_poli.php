<?php
	class ips_poli extends datebase{
		function __construct(){parent::__construct($this->tableName(),$this->rules(),$this->attributeLabels(),$this->getIdDefecto());}
		public static function tableName(){
			return 'ips_poli';
		}
		public function rules(){
			return ['id_ip',
			'name_ip',
			'mac_ip',
			'sw_ip',
			'puerto_ip',
			'ip1_ip',
			'ip2_ip',
			'ip3_ip',
			'ip4_ip'];
		}
		public function attributeLabels(){
			return ['id_ip'=>'Id ip'];
		}
		public function getIdDefecto(){
			return 'id_ip';
		}
	}
?>