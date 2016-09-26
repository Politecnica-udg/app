<?php
	require_once 'frontend/model/table/user.php';
	require_once 'frontend/model/table/ips_poli.php';
	class model_index{
		public function userData($user){
			$consu = new user();
			return $consu->getDatos($user);
		}
		public function pwNew($pw, $cod){
			$consu = new user();
			return $consu->getUpPW($pw, $cod);
		}
	}
?>