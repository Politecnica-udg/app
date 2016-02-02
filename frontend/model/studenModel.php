<?php
	require_once 'frontend/model/table/cali.php';
	class model_studen{
		public function clases($sem){
			$consu = new cali();
			return $consu->getClass($sem);
		}
		public function info($mat){
			$consu = new cali();
			return $consu->getInfo($sem);
		}
		public function grabar($data,$array){
			$consu = new cali();
			return $consu->getGrabar($data,$array);
		}
	}
?>