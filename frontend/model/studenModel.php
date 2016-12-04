<?php
	require_once 'frontend/model/table/cali.php';
	require_once 'frontend/model/table/alumnos_datos.php';
	require_once 'frontend/model/table/solicitantes.php';
	require_once 'frontend/model/table/ubicacion.php';
	require_once 'frontend/model/table/empresas.php';
	require_once 'frontend/model/table/citas.php';

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
		public function inf_Al($cod){
			$consu = new alumnos_datos();
			return $consu->inf_Al($cod);
		}
		public function saveInfo($dat){
			$consu = new alumnos_datos();
			return $consu->saveInfo($dat);
		}
		public function inf_soli($cod){
			$consu = new solicitantes();
			return $consu->inf_soli($cod);
		}
		public function info_al($cod){
			$consu = new ubicacion();
			return $consu->info_al($cod);
		}
		public function catalogo($carr){
			$consu = new solicitantes();
			return $consu->catalogo($carr);
		}
		public function inf_em($em){
			$consu = new empresas();
			return $consu->inf_em($em);
		}
		public function solici_lista($em, $sexo){
			$consu = new solicitantes();
			return $consu->solici_lista($em, $sexo);
		}
		public function cali_al(){
			$consu = new cali();
			return $consu->cali_al();
		}
		public function sexo(){
			$consu = new alumnos_datos();
			return $consu->sexo();
		}
		public function save_inf($id){
			$consu = new solicitantes();
			return $consu->save_inf($id);
		}
		public function cita($cod){
			$consu = new citas();
			return $consu->cita($cod);
		}
	}
?>