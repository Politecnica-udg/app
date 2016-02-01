<?php
	require_once 'frontend/model/table/asig_prof.php';
	require_once 'frontend/model/table/evaluacion.php';

	class model_admon{
		public function datosMaestros(){
			$consu = new asig_prof();
			return $consu->getMaestros();
		}
		public function datosGrupos($cod){
			$consu =  new asig_prof();
			return $consu->getMaterias($cod);
		}
		public function datosAl(){
			$consu = new evaluacion();
			return $consu->getDatosAlu();
		}
		public function saveFal($arr){
			$consu = new evaluacion();
			return $consu->getGuardarFal($arr);
		}
		public function saveCal($arr){
			$consu = new evaluacion();
			return $consu->getGuardarCal($arr);
		}
		public function grabar($op){
			$consu =  new asig_prof();
			return $consu->getGrabar($op);
		}
	}
?>