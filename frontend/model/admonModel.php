<?php
	require_once 'frontend/model/table/asig_prof.php';

	class model_admon{
		public function datosMaestros(){
			$consu = new asig_prof();
			return $consu->getMaestros();
		}
		public function datosGrupos($cod){
			$consu =  new asig_prof();
			return $consu->getMaterias($cod);
		}
	}
?>