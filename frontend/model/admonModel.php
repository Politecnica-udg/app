<?php
	require_once 'frontend/model/table/asig_prof.php';
	require_once 'frontend/model/table/evaluacion.php';
	require_once 'frontend/model/table/autM.php';
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
		public function carrera($con){
			$consu = new evaluacion();
			return $consu->getCarrera($con);
		}
		public function mat($con){
			$consu = new evaluacion();
			return $consu->getMat($con);
		}
		public function grupo(){
			$consu = new evaluacion();
			return $consu->getGrupo();
		}
		public function saveFAM($a){
			$consu = new autM();
			return $consu->getSaveFAM($a);
		}
		public function autEMV($cod){
			$consu = new autM();
			return $consu->getAutMM($cod);
		}
	}
?>