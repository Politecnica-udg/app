<?php
	class user extends datebase{
		function __construct(){parent::__construct($this->tableName(),$this->rules(),$this->attributeLabels(),$this->getIdDefecto());}
		public static function tableName(){
			return 'user';
		}
		public function rules(){
			return ['codigo','nip','email','nivel','tipo','nombre','grado'];
		}
		public function attributeLabels(){
			return ['codigo'=>'codigo',
					'nip'=>'nip',
					'email'=>'email',
					'nivel'=>'nivel',
					'tipo'=>'tipo',
					'nombre'=>'nombre',
					'grado'=>'grado'];
		}
		public function getIdDefecto(){
			return 'codigo';
		}
	}
?>